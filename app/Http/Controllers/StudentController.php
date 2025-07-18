<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::role('student')->get();
        return view('dashboard.students.index', compact('students'));
    }

    public function data(Request $request)
    {
        $students = User::role('student')
            ->select(['id', 'name', 'email'])
            ->get();
        return DataTables::of($students)
  ->addColumn('actions', function ($student) {
    return '
        <div class="d-flex gap-2">
            
            <a href="' . route('students.show', ['student', $student->id]) . '" class="btn btn-outline-main rounded-pill px-3 py-1">
                Show
            </a>
            <a href="' . route('students.edit', ['student', $student->id]) . '" class="btn btn-outline-warning rounded-pill px-3 py-1">
                Edit
            </a>
            <form action="' . route('students.destroy', ['student', $student->id]) . '" method="POST" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-outline-danger rounded-pill px-3 py-1">
                    Delete
                </button>
            </form>
        </div>
    ';
})



            ->rawColumns(['actions']) // Allow HTML for actions column
            ->make(true);
    }

    public function show($id)
    {
        $student = User::findOrFail($id); // Find the student by ID
        return view('dashboard.students.show', compact('student')); // Pass the student data to the view
    }


    // Store a new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'grade_level' => 'nullable|string',
            'enrollment_date' => 'nullable|date',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'grade_level' => $validated['grade_level'],
            'enrollment_date' => $validated['enrollment_date'],
        ]);

        $user->assignRole('student');

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    // Show the form for editing a student
    public function edit(User $student)
    {
        return view('dashboard.students.edit', compact('student'));
    }

    // Update the specified student
    public function update(Request $request, User $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'senior_year' => ['string', 'nullable'],
            'current_stage' => ['string', 'nullable'],
//            'area_id' => ['integer', 'nullable'],
//            'city_id' => ['integer', 'nullable'],
            'school' => ['string', 'nullable'],
            'school_type' => ['string', 'nullable'],
            'second_language' => ['string', 'nullable'],
            'mobile' => ['string', 'nullable'],
            'parent_mobile' => ['string', 'nullable'],
            'mobile_country_code' => ['string', 'nullable'],
            'mom_whats_app' => ['string', 'nullable'],
            'dad_whats_app' => ['string', 'nullable'],
            'dad_job' => ['string', 'nullable'],
//            'job' => ['string', 'nullable'],
            'facebook_link' => ['string', 'nullable'],
            'identity_number' => ['string', 'nullable'],
//            'specialty_id' => ['integer', 'nullable'],
//            'bio' => ['string', 'nullable'],
        ]);

        $student->update($validated);

        return redirect()->route('students.edit',['student'=>$student->id])->with('success', 'Student updated successfully.');
    }

    // Delete the specified student
    public function destroy(User $student)
    {
        try {
            $student->delete();
            return response()->json(['success' => 'Student deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}

