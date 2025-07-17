<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Lesson;
use App\Models\StudentLessonAccess;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use function Illuminate\Database\Eloquent\Casts\get;

class CodesController extends Controller
{
    public function index()
    {
        $codes = Code::with('lesson')->get(); // Fetch all codes
        return view('dashboard.codes.index', compact('codes'));
    }

    public function data(Request $request)
    {
        $codes = Code::with('lesson') // Eager load the lesson relationship
        ->select(['id', 'combination', 'status', 'expiry_days', 'lesson_id'])
            ->get();
        return DataTables::of($codes)
            ->addColumn('lesson_name', function ($code) {
                return $code->lesson ? $code->lesson->name : 'N/A'; // Fallback if no lesson is associated
            })
            ->addColumn('actions', function ($code) {
                return '
                <a href="' . route('dashboard.codes.edit',['code', $code->id]) . '" class="btn btn-sm btn-primary">Edit</a>
                <a href="' . route('dashboard.codes.show', ['code', $code->id]) . '" class="btn btn-sm btn-success">Show</a>
                <form action="' . route('dashboard.codes.destroy', ['code', $code->id]) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button class="btn btn-sm btn-danger delete-button" data-id="' . $code->id . '">Delete</button>
                </form>
                ';
            })
            ->rawColumns(['actions']) // Allow HTML for actions column
            ->make(true);
    }

    public function show($id)
    {
        $code = Code::with('lesson')->findOrFail($id); // Find the code by ID
        $studentsUsedThisCode = StudentLessonAccess::query()->where('access_code',$code->combination)->get();
        return view('dashboard.codes.show', compact('code','studentsUsedThisCode')); // Pass the code data to the view
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'combination' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'expiry_days' => 'nullable|integer|min:0',
            'lesson_id' => 'required|integer|exists:lessons,id',
        ]);

        Code::create($validated);

        return redirect()->route('dashboard.codes.index')->with('success', 'Code created successfully.');
    }

    public function edit($id)
    {
        $code = Code::with('lesson')->findOrFail($id);
        $studentsUsedThisCode = StudentLessonAccess::query()->where('access_code',$code->combination)->get();
        $lessons = Lesson::all();
        $maxExpiryDays = config('app.code_expiry_max', 15); // Default to 15 if not set

        return view('dashboard.codes.edit', compact('code', 'lessons', 'maxExpiryDays','studentsUsedThisCode'));
    }


    public function update(Request $request, Code $code)
    {
        $validated = $request->validate([
//            'combination' => 'required|string|max:255',
//            'status' => 'required|string|in:created,valid',
            'expiry_days' => ['required', 'min:1', 'integer', 'max:' . config('app.code_expiry_max', 15)],
//            'lesson_id' => 'required|integer|exists:lessons,id',
        ]);

        $code->update($validated);

        return redirect()->route('dashboard.codes.edit', $code->id)->with('success', 'Code updated successfully.');
    }

    public function destroy(Code $code)
    {
        try {
            $code->delete();
            return response()->json(['success' => 'Code deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
