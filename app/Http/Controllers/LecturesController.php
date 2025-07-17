<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectures =  DB::table('lessons')
            ->join('student_lesson_access', 'lessons.id', '=', 'student_lesson_access.lesson_id')
            ->where('student_lesson_access.student_id', auth()->id())
            ->select('lessons.*')
            ->distinct()
            ->get();
//        dd($lectures);
        return view('dashboard.lessons.index',compact('lectures'));
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
        //
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
}
