<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\StudentLessonAccess;
use App\Models\VideoView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{

    public function __construct()
    {
        $this->middleware('check.lesson.access')->only('show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        dd(auth()->user());
        $accessCodes = StudentLessonAccess::where('student_id', auth()->id())
            ->where('lesson_id', $id)
            ->where('expires_at', '>', Carbon::now())
            ->get()->pluck('access_code')->toArray();
        $lesson = Lesson::find($id);
        return view('lessons.show',compact(['lesson','accessCodes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function viewLesson($lessonId)
    {
        $user = Auth::user();
        $lesson = Lesson::findOrFail($lessonId);

        // Check if the user has already viewed this lesson
        $view = VideoView::where('user_id', $user->id)
            ->where('lesson_id', $lessonId)
            ->first();

        if ($view) {
            // If the user has already viewed this lesson, increment the view count
            $view->increment('views_count');
        } else {
            // If the user has not viewed this lesson, create a new entry
            VideoView::create([
                'user_id' => $user->id,
                'lesson_id' => $lessonId,
                'views_count' => 1
            ]);
        }

        // Return the lesson view or redirect
        return view('lessons.show', compact('lesson'));
    }

    public function incrementViewCount(Request $request, $lessonId)
    {
        $user = Auth::user();

        // Check if the user has already viewed this video
        $existingView = $user->viewedLessons()->where('lesson_id', $lessonId)->first();

        if ($existingView) {
            // Increment the views count for this user and lesson
            $existingView->pivot->views_count += 1;
            $existingView->pivot->save();
        } else {
            // Attach the lesson to the user's viewed lessons with initial view count
            $user->viewedLessons()->attach($lessonId, ['views_count' => 1]);
        }

        return response()->json(['success' => true]);
    }
}
