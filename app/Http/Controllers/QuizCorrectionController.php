<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizCorrection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizCorrectionController extends Controller
{
    public function __construct()
    {
        // Only allow users with 'role:teacher' to access the methods
        $this->middleware('role:teacher')->only('create','store','edit','update','destroy');
    }
    public function index()
    {
        $corrections = QuizCorrection::with('quiz')->get();
        if(auth()->user()->hasRole('student')){
            $corrections = QuizCorrection::whereHas('quiz', function ($query) {
                $query->whereHas('quizAttempts', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })->get();
        }

        return view('quiz_corrections.index', compact(['corrections']));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $quizzes = Quiz::all();
        return view('quiz_corrections.create', compact('quizzes'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
//        dd($request->all());
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'name' => 'required|string|max:255',
            'video_path' => 'nullable|string', // Adjust file types and size as needed
        ]);

//        if ($request->hasFile('video_path')) {
//            $validated['video_path'] = $request->file('video_path')->store('videos', 'public');
//        }

        QuizCorrection::create($validated);


        return redirect()->route('dashboard.quiz_corrections.index')->with('success', 'Quiz correction created successfully.');
    }

    // Display the specified resource
    public function show(QuizCorrection $quizCorrection)
    {
        return view('quiz_corrections.show', compact('quizCorrection'));
    }

    // Show the form for editing the specified resource
    public function edit(QuizCorrection $quizCorrection)
    {
        $quizzes = Quiz::all();
        return view('quiz_corrections.edit', compact('quizCorrection', 'quizzes'));
    }

    // Update the specified resource in storage
    public function update(Request $request, QuizCorrection $quizCorrection)
    {
        // Validate the request
        $validatedData = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'name' => 'required|string|max:255',
            'video_path' => 'nullable|string', // Update file validation rules
        ]);

        // Check if a new video file has been uploaded
//        if ($request->hasFile('video_path')) {
//            // Delete the old video if it exists
//            if ($quizCorrection->video_path && Storage::disk('public')->exists($quizCorrection->video_path)) {
//                Storage::disk('public')->delete($quizCorrection->video_path);
//            }
//
//            // Store the new video file
//            $path = $request->file('video_path')->store('videos', 'public');
//            $validatedData['video_path'] = $path;
//        }

        // Update the QuizCorrection record
        $quizCorrection->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('dashboard.quiz_corrections.index')->with('success', 'Quiz Correction updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(QuizCorrection $quizCorrection)
    {
        $quizCorrection->delete();
        return redirect()->route('dashboard.quiz_corrections.index')->with('success', 'Quiz correction deleted successfully.');
    }
}
