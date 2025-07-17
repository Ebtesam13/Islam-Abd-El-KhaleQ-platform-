<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category','rates','author','users','units'])->limit(4)->get();
        return view('courses',compact('courses'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
//        dd($id);
        $course = Course::with(['category','rates','author','users','units'])->find($id);
        $units = Unit::where('course_id',$id)->with('lessons')->get();
        return view('course_details',compact(['course','units']));
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
