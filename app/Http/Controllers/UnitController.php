<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher')->only('create','store','show');
    }

    public function index()
    {

    }

    public function create($id)
    {

        $course = Course::query()->where('id',$id)->with(['category','rates','author','users'])->first();

        return view('dashboard.units.create',compact('course'));
    }

    public function store(Request $request)
    {
        $unit = Unit::query()->create([
            'name'=>$request->name,
            'course_id'=>$request->course_id
        ]);
        if ($unit){
            session()->flash('success', __('labels.data_saved_success'));
        }
        return redirect()->route('dashboard.units.show',['unit'=>$unit->id]);
    }

    public function show(string $id)
    {
        $unit = Unit::find($id);
        $course = Course::with(['category','rates','author','users','units'])->find($unit->course_id);
        return view('dashboard.units.unit_details',compact('course','unit'));
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

    public function getUnitsByCourseId(string $courseId)
    {
        $units = Unit::query()->where('course_id',$courseId)->get();
        return response()->json($units);
    }
}
