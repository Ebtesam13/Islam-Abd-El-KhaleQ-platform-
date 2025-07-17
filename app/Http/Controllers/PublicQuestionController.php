<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PublicAnswer;
use App\Models\PublicQuestion;
use App\Models\PublicQuiz;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class PublicQuestionController extends Controller
{
    public function create(PublicQuiz $quiz)
    {
//        dd($quiz);
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, PublicQuiz $quiz)
    {
        $request->validate([
            'question' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'answers.*.answer' => 'required|string',
        ]);

        $question = new PublicQuestion();
        $question->quiz_id = $quiz->id;
        $question->question = $request->input('question');
        $question->link = $request->input('link');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('questions', 'public');
            $question->image = $imagePath;
        }

        $question->save();

        foreach ($request->input('answers') as $answerData) {
            PublicAnswer::create([
                'question_id' => $question->id,
                'answer' => $answerData['answer'],
                'is_correct' => isset($answerData['is_correct']) ? 1 : 0,
            ]);
        }

        return redirect()->route('public_quizzes.show', $quiz)->with('success', 'Question added successfully.');
    }
}
