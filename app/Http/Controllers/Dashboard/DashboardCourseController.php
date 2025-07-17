<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardCourseController extends Controller
{

    public function __construct()
    {
        // Only allow users with 'create lesson' permission to access the create method
        $this->middleware('role:teacher')->only('create','index','show');
    }
    public function index()
    {
        $courses = Course::with(['category','rates','author','users'])->limit(4)->get();
        return view('dashboard.courses.index',compact('courses'));
    }

    public function create($id)
    {
        $course = Course::query()->where('id',$id)->with(['category','rates','author','users'])->first();

        return view('dashboard.courses.create',compact('course'));
    }

    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        $course = Course::with(['category','rates','author','users','units'])->find($id);
        return view('dashboard.courses.course_details',compact('course'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
