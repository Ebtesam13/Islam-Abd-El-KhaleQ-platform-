<?php
namespace App\Http\Controllers;

use App\Models\Booklet;
use App\Models\BookletCode;
use App\Models\Code;
use App\Models\Quiz;
use App\Models\StudentLessonAccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookletController extends Controller
{
    public function __construct()
    {
        // Only allow users with 'role:teacher' to access the methods
        $this->middleware('role:teacher')->only('create','store','edit','update','destroy','show');
    }
    public function index()
    {
        $booklets = Booklet::with('quiz')->get();
        return view('booklets.index', compact('booklets'));
    }

    public function create()
    {
        $quizzes = Quiz::all();
        return view('booklets.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_codes' => 'required|integer',
            'file_path' => 'required|mimes:pdf', // Validate file is a PDF
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        $filePath = $request->file('file_path')->store('booklets', 'public');

        $booklet = Booklet::create([
            'name' => $request->name,
            'number_of_codes' => $request->number_of_codes,
            'file_path' => $filePath,
            'quiz_id' => $request->quiz_id,
        ]);

        // Generate booklet codes
        for ($i = 0; $i < $booklet->number_of_codes; $i++) {
            BookletCode::create([
                'code' => strtoupper(uniqid()), // Unique code generation
                'booklet_id' => $booklet->id,
            ]);
        }

        return redirect()->route('dashboard.booklets.index')->with('success', 'Booklet created successfully.');
    }

    public function show(Booklet $booklet)
    {
        return view('booklets.show', compact('booklet'));
    }

    public function edit(Booklet $booklet)
    {
        $quizzes = Quiz::all();
        return view('booklets.edit', compact('booklet', 'quizzes'));
    }

    public function update(Request $request, Booklet $booklet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_codes' => 'required|integer',
            'file_path' => 'nullable|mimes:pdf',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        $filePath = $booklet->file_path;

        if ($request->hasFile('file_path')) {
            Storage::disk('public')->delete($booklet->file_path); // Delete old file
            $filePath = $request->file('file_path')->store('booklets', 'public');
        }

        $booklet->update([
            'name' => $request->name,
            'number_of_codes' => $request->number_of_codes,
            'file_path' => $filePath,
            'quiz_id' => $request->quiz_id,
        ]);

        return redirect()->route('dashboard.booklets.index')->with('success', 'Booklet updated successfully.');
    }

    public function destroy(Booklet $booklet)
    {
        Storage::disk('public')->delete($booklet->file_path); // Delete file
        $booklet->delete();
        return redirect()->route('dashboard.booklets.index')->with('success', 'Booklet deleted successfully.');
    }

    public function validateCode(Request $request)
    {
        $code = $request->input('code');
        $booklet = Booklet::find($request->booklet_id);

        if (!$booklet) {
            return response()->json(['valid' => false]);
        }

        $bookletCodes = $booklet->bookletCodes->pluck('code')->toArray();
        if(empty($bookletCodes)){
            return response()->json(['valid' => false]);
        }
        if (in_array($request->code,$bookletCodes)) {
            $code = BookletCode::where('code',$request->code)->first();
            $code->update([
                'status'=> Code::$status['VALID']
            ]);
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }

}
