<?php

namespace App\Http\Controllers;

use App\Mail\ParentNotificationMail;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Homework;
use App\Models\PublicQuiz;
use App\Models\Question;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\StudentHomeworkAccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class QuizController extends Controller
{
    public function __construct()
    {
        // Only allow users with 'role teacher' permission to access these methods
        $this->middleware('role:teacher')->only(['create','show','store','destroy','editQuestion','updateQuestion','destroyQuestion']);
    }

    public function index()
    {
        if(auth()->user()->hasRole('teacher')){
            $quizzes = Quiz::with(['questions','quizAttempts'])->get();
            $publicQuizzes = PublicQuiz::with(['questions','quizAttempts'])->get();
        }else{
            $courseId = auth()->user()->current_stage;
            $quizzes = Quiz::with(['questions','quizAttempts'])->whereHas('lesson.unit.course', function ($query) use ($courseId) {
                $query->where('id', $courseId);
            })->get();
            $publicQuizzes = PublicQuiz::with(['questions','quizAttempts'])->whereHas('quizAttempts', function ($query) use ($courseId) {
                $query->where('user_id', auth()->id());
            })->get();
        }
        return view('quizzes.index', compact('quizzes','publicQuizzes'));
    }

    public function create()
    {
        $stages = Course::all();
        return view('quizzes.create',compact(['stages']));
    }

    public function show(Quiz $quiz)
    {
        // Eager load questions to avoid N+1 query problem
        $quiz->load('questions');

        return view('quizzes.show', compact('quiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'time' => 'required|integer',
            'lesson_id' => 'required|integer',
        ]);

        $quiz = Quiz::create($request->only('name', 'time','lesson_id'));

        return redirect()->route('quizzes.show', $quiz);
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $responses = $request->except('_token');

        $quizUserResponse = new QuizUserResponse();
        $quizUserResponse->user_id = auth()->id();
        $quizUserResponse->quiz_id = $quiz->id;
        $quizUserResponse->responses = $responses;
        $quizUserResponse->save();

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Quiz submitted successfully.');
    }

    public function destroy($id)
    {
        // Find the quiz by ID
        $quiz = Quiz::findOrFail($id);

        // Delete the quiz from the database
        $quiz->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        return view('quizzes.edit-question', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'answers' => 'required|array',
            'answers.*.answer' => 'required|string|max:255',
            'correct_answer' => 'required|integer'
        ]);


        $question->question = $request->input('question');
        $question->link = $request->input('link');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($question->image && Storage::exists('public/' . $question->image)) {
                Storage::delete('public/' . $question->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('images', 'public');
            $question->image = $imagePath;
        }

        // Save question
        $question->save();


        // Update answers if provided
        $question->answers()->delete();
        foreach ($request->input('answers') as $index => $answerData) {
            $isCorrect = ($index == $request->input('correct_answer')); // Check if this is the correct answer
            $question->answers()->create([
                'answer' => $answerData['answer'],
                'is_correct' => $isCorrect
            ]);
        }

        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Question updated successfully.');
    }

    public function destroyQuestion(Quiz $quiz, Question $question)
    {
        $question->delete();

        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Question deleted successfully.');
    }

    public function startQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $user = Auth::user();
        // Get the associated lesson for the quiz
        $lesson = $quiz->lesson;

        // Check if the lesson associated with this quiz has been viewed by the user
        $hasViewedLesson = $user->lessons()
            ->where('lesson_id', $lesson->id)
            ->exists();
        if (!$hasViewedLesson) {
            return redirect()->back()->with('error', 'You need to view the lesson');
        }
        // Check if all homeworks associated with this lesson have been completed by the user
        $homeworks = $lesson->homework;
        $hasCompletedAllHomeworks = false;
        foreach ($homeworks as $homework) {
//            $hasCompletedAllHomeworks = StudentHomeworkAccess::where('homework_id', $homework->id)->where('student_id',$user->id)->exists();
            if(StudentHomeworkAccess::where('homework_id', $homework->id)->where('student_id',$user->id)->exists()){
                $hasCompletedAllHomeworks = true;
                continue;
            }
        }
//        $hasCompletedAllHomeworks = $homeworks->where(function ($homework) use ($user) {
//            return $user->homeworks()->where('homework_id', $homework->id)->exists();
//        });
        // If the user has not viewed the lesson or not completed all homeworks, redirect back with a message
        if (!$hasCompletedAllHomeworks) {
            return redirect()->back()->with('error', 'You need to complete all associated homework before taking the quiz.');
        }

        // Check if the user has already taken this quiz
        if ($this->checkQuizTaken($quizId)) {
            return redirect()->route('quizzes.index')->with('error', 'You have already taken this quiz.');
        }
        // Check if the user has already started this quiz
        $attempt = QuizAttempt::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'quiz_id' => $quiz->id,
            ],
            [
                'time_left' => $quiz->time * 60, // Convert 'time' to seconds
                'current_question' => 1, // Initialize with the first question
                'full_mark' => count($quiz->questions) ,
            ]
        );

        // Ensure 'current_question' is set and not null
        $currentQuestionNumber = $attempt->current_question ?? 1; // Default to 1 if null

        return redirect()->route('quizzes.question', ['quizId' => $quiz->id, 'questionNumber' => $currentQuestionNumber]);
    }

    public function checkQuizTaken($quizId)
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        // Check if there is already an attempt for this quiz and user
        $attempt = QuizAttempt::where('quiz_id', $quizId)->where('user_id', $userId)->first();

        return $attempt ? true : false;
    }

    public function showQuestion($quizId, $questionNumber)
    {
//        dd(\request()->all());
//        dd('sss');
        $quiz = Quiz::findOrFail($quizId);
        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('user_id', Auth::id())
            ->with('answers')
            ->firstOrFail();

        $question = Question::where('quiz_id', $quiz->id)
            ->skip($questionNumber - 1)
            ->firstOrFail();

        return view('quizzes.question', compact('quiz', 'attempt', 'question', 'questionNumber'));
    }

    public function submitAnswer(Request $request, $quizId, $questionNumber)
    {

        $quiz = Quiz::findOrFail($quizId);
        $attempt = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $question = Question::where('quiz_id', $quiz->id)
            ->skip($questionNumber - 1)
            ->firstOrFail();
        $oldAttemptAnswer =QuizAttemptAnswer::where('question_id' , $question->id)
            ->where('quiz_attempt_id',$attempt->id)
            ->first();
        if($oldAttemptAnswer){
            QuizAttemptAnswer::where('question_id' , $question->id)
                ->where('quiz_attempt_id',$attempt->id)
                ->delete();
        }
        $attempt->answers()->attach($request->input('answer'), ['question_id' => $question->id]);
        if (strpos($request->time_left, ':') !== false) {
            list($minutes, $seconds) = explode(':', $request->time_left);
            $totalSeconds = ($minutes * 60) + $seconds;
        } else {
            // Handle invalid format case (default to 0 seconds or throw an error)
            $totalSeconds = $attempt->time_left; // or throw an exception if needed
        }
        if ($request->has('next')) {
            $nextQuestion = $questionNumber + 1;
            $attempt->update([
                'current_question' => $nextQuestion,
                'time_left'=>$totalSeconds
            ]);
            return redirect()->route('quizzes.question', ['quizId' => $quiz->id, 'questionNumber' => $nextQuestion]);
        } elseif ($request->has('previous')) {
            $prevQuestion = max($questionNumber - 1, 1);
            $attempt->update([
                'current_question' => $prevQuestion,
                'time_left'=>$totalSeconds
            ]);
            return redirect()->route('quizzes.question', ['quizId' => $quiz->id, 'questionNumber' => $prevQuestion]);
        }
        $score = $this->calculateAndSaveScore($quizId);
        $attempt->update([
            'score'=>$score,
            'time_left'=>$totalSeconds,
            'completed_at'=>Carbon::now(),
        ]);
        foreach (auth()->user()->parents as $parent){
            Mail::to($parent->email)->send(new ParentNotificationMail(route('scores.index'),$score,$quiz->name,$parent->name,count($quiz->questions),auth()->user()->name));
        }
        if ($request->has('next_route')) {
            return redirect($request->input('next_route'));
        }

        return redirect()->route('quizzes.index')->with('success',  "Quiz completed! Your score is: $score" . "/".count($quiz->questions));
    }

    public function calculateAndSaveScore($quizId)
    {
        $userId = Auth::id();

        // Get the user's attempt for the quiz
        $attempt = QuizAttempt::where('quiz_id', $quizId)->where('user_id', $userId)->firstOrFail();

        // Initialize the score
        $score = 0;

        // Retrieve all questions for the quiz
        $quizQuestions = $attempt->quiz->questions;
        foreach ($quizQuestions as $question) {
            // Get the user's answer to this question
            $userAnswer = $attempt->answers->where('question_id', $question->id)->first(); //3

            if ($userAnswer) {
                // Check if the answer is correct
                $correctAnswer = $question->answers()->where('is_correct', 1)->first();//exists
                if ($correctAnswer && $userAnswer->pivot->answer_id == $correctAnswer->id) {
                    $score++; // Increment score for each correct answer
                }
            }
        }

        // Save the score in the database
        $attempt->score = $score;
        $attempt->save();

        return $score;
    }
    public function showQuizResults($quizId)
    {
        $user = Auth::user();

        if ($user->hasRole('student')) {
            // Get the quiz and the related questions
            $quiz = Quiz::with(['questions.answers', 'quizAttempts' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])->findOrFail($quizId);
            // Get the user's quiz attempt
            $attempt = $quiz->quizAttempts->first();
            // Pass data to the view
            return view('quizzes.quiz_results', compact('quiz', 'attempt'));
        }

        return redirect()->back()->with('error', 'Unauthorized');
    }
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id); // Retrieve the quiz by ID
        return view('quizzes.edit', compact('quiz')); // Return the edit view with quiz data
    }

    // Update the quiz in the database
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id); // Retrieve the quiz by ID

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required',
        ]);

        // Update the quiz data
        $quiz->update($validatedData);

        return redirect()->route('quizzes.index', $quiz->id)
            ->with('success', 'Quiz updated successfully');
    }

    public function getQuizStudents($quizId)
    {
        // Retrieve students who have quiz attempts for the specified quiz
        $students = QuizAttempt::where('quiz_id', $quizId)
            ->with('user') // Assuming you have a `student` relationship in QuizAttempt model
            ->get();

        return response()->json($students);
    }
    public function destroyAttempt($attemptId)
    {
        $attempt = QuizAttempt::findOrFail($attemptId);
        $attempt->delete();

        return response()->json(['success' => 'Attempt deleted successfully']);
    }

}
