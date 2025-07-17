<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Homework;
use App\Models\Lesson;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardHomeworkController extends Controller
{
    public function __construct()
    {
        // Only allow users with 'role:teacher' to access the methods
        $this->middleware('role:teacher')->only('create','store','edit','update','destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Course::all();
        $units = Unit::all();
        $homework = Homework::with(['lesson'])->get();
        $lessons = Lesson::with(['homework','codes'])->get();
        if(auth()->user()->hasRole('student')){
            $lessons = auth()->user()->viewedLessons()->with('homework')->get();
        }
//        dd($lessons);
        return view('dashboard.homework.index',compact(['lessons','homework','stages','units']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('dashboard.homework.create')->with(['lesson_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lesson_id' => 'required|exists:lessons,id',
            'video' => 'required|string',
        ]);
//        $videoPath = null;
//        if ($request->hasFile('video')) {
//            $videoPath = $request->file('video')->store('videos', 'public');
//        }
        $homework = Homework::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'lesson_id' => $request->input('lesson_id'),
            'video' => $request->input('video'), // Or handle file upload if necessary
        ]);
        if ($homework){
            return redirect()->route('dashboard.homework.show',['homework'=>$homework->id])->with('success', __('labels.data_saved_success'));
        }
        return redirect()->route('dashboard.homework.index')->with('danger', __('labels.data_saved_fail'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $homework = Homework::find($id);
        return view('dashboard.homework.homework_details',compact('homework'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $homework = Homework::with(['lesson'])->where('id',$id)->first();
        return view('dashboard.homework.edit',compact('homework'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'nullable|string',
        ]);
//        $videoPath = null;
//        if ($request->hasFile('video')) {
//            $videoPath = $request->file('video')->store('videos', 'public');
//        }
        $homework = Homework::findOrFail($id);
        $homework->name = $request->input('name');
        $homework->description = $request->input('description');
        $homework->video = $request->input('video');
//        if(null !== $videoPath){
//            $homework->video = $videoPath;
//        }
        $homework->save();

        return redirect()->route('dashboard.homework.index')->with('success', 'Homework updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $homework = Homework::find($id);

        // Check if the lesson exists
        if (!$homework) {
            return redirect()->route('dashboard.homework.index')->with('error', 'Homework not found.');
        }

        // Delete the lesson
        $homework->delete();

        // Redirect back with a success message
        return redirect()->route('dashboard.homework.index')->with('success', 'Homework deleted successfully.');

    }

    public function getHomeworkByLessonId(string $lessonId)
    {
        $homework = Homework::query()->where('lesson_id',$lessonId)->get();
        return response()->json($homework);
    }

    public function markHomeworkAsViewed($homeworkId)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $homework = Homework::findOrFail($homeworkId); // Find the homework by ID

        // Check if a record exists in the student_homework_access table for this user and homework
        $existingRecord = $user->homeworks()->where('homework_id', $homeworkId)->exists();

        if (!$existingRecord) {
            // Create a new record in the student_homework_access table with 'is_viewed' set to true
            $user->homeworks()->attach($homeworkId);
        }

        return response()->json(['message' => 'Homework marked as viewed successfully']);
    }
}
