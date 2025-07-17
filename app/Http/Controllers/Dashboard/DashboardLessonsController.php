<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ItemsExport;
use App\Http\Controllers\Controller;
use App\Models\Booklet;
use App\Models\Code;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\StudentLessonAccess;
use App\Models\Unit;
use Carbon\Carbon;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class DashboardLessonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher')->only('create','store','downloadCodes','edit','update','destroy');
    }

    public function index()
    {
        //
    }

    public function create($id)
    {
        if (!auth()->user()->can('create lesson')) {
            abort(403, 'Unauthorized action.');
        }
        $unit = Unit::query()->where('id',$id)->with(['lessons'])->first();

        return view('dashboard.lessons.create',compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_id' => 'required|exists:units,id', // Ensure the unit_id exists in the units table
            'price' => 'required|numeric',
            'expiry_days' => 'required|numeric',
            'number_of_codes' => 'required|integer',
            'video' => 'nullable|string', // Adjust validation if video is a file
            'drive_video' => 'nullable|string', // Adjust validation if video is a file
        ]);
//        $videoPath = null;
//        if ($request->hasFile('video')) {
//            $videoPath = $request->file('video')->store('videos');
//        }
//        dd($this->getVideoDuration($videoPath));
        $lesson = Lesson::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'unit_id' => $validated['unit_id'],
            'price' => $validated['price'],
            'expiry_days' => $validated['expiry_days'],
            'number_of_codes' => $validated['number_of_codes'],
            'video' => $validated['video'], // Or handle file upload if necessary
            'drive_video' => $validated['drive_video'], // Or handle file upload if necessary
//            'duration' =>  $this->getVideoDuration($videoPath)
        ]);
        if ($lesson){
            for ($i=0 ; $i<$lesson->number_of_codes ; $i++) {
                $randomString = Str::random(8);
                $lesson->codes()->create([
                    'combination'=>substr($randomString, 0, 6),
                    'expiry_days' => $validated['expiry_days'],
                    'lesson_id'=>$lesson->id
                ]);
            }
            return redirect()->route('dashboard.units.show',['unit'=>$validated['unit_id']])->with('success', __('labels.data_saved_success'));
        }
        return redirect()->route('dashboard.units.show',['unit'=>$validated['unit_id']])->with('danger', __('labels.data_saved_fail'));
    }

    public function show(Lesson $lesson)
    {
        $usedCodes = $lesson->codes()->where('status','valid')->count();
        return view('dashboard.lessons.lesson_details',compact(['lesson','usedCodes']));
    }

    public function edit(Lesson $lesson)
    {
        return view('dashboard.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_id' => 'required|exists:units,id', // Ensure the unit_id exists in the units table
            'price' => 'required|numeric',
            'expiry_days' => 'required|numeric',
            'number_of_codes' => 'required|integer',
            'video' => 'nullable|string', // Adjust validation if video is a file
            'drive_video' => 'nullable|string', // Adjust validation if video is a file
        ]);
//        $videoPath = $lesson->video;
//        if ($request->hasFile('video')) {
//            $videoPath = $request->file('video')->store('videos');
//        }

        $lesson->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'unit_id' => $validated['unit_id'],
            'price' => $validated['price'],
            'expiry_days' => $validated['expiry_days'],
            'number_of_codes' => $validated['number_of_codes'],
            'video' => $validated['video'],
            'drive_video' => $validated['drive_video'],
        ]);
        return redirect()->route('dashboard.units.show',['unit'=>$validated['unit_id']])->with('success', __('labels.data_saved_success'));
    }


    public function destroy(Lesson $lesson)
    {
        Storage::disk('public')->delete($lesson->video); // Delete file
        $lesson->delete();
        return redirect()->route('dashboard.units.show',['unit'=>$lesson->unit_id])->with('success', 'Lesson deleted successfully.');
    }

    public function downloadCodes(Lesson $lesson)
    {
        $items[] =  ['Lesson', 'Code'];
        foreach ($lesson->codes as $code) {
            array_push($items,[$lesson->name,$code->combination]);
        }

        $fileName = 'codes.xlsx';
        return Excel::download(new ItemsExport($items), $fileName);
    }

    public function getLessonsByUnitId(string $unitId)
    {
        $lessons = Lesson::query()->where('unit_id',$unitId)->get();
        return response()->json($lessons);
    }

    public function getVideoDuration($filePath)
    {
        // Create the FFmpeg instance with the correct FFProbe path
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => 'C:\ffmpeg\bin\ffmpeg.exe',
            'ffprobe.binaries' => 'C:\ffmpeg\bin\ffprobe.exe',
        ]);

        // Open the video file
        $video = $ffmpeg->open($filePath);

        // Get the duration of the video
        $duration = $video->getFormat()->get('duration');

        return gmdate("H:i:s", $duration);
        // Create an instance of FFProbe
//        $ffprobe = FFProbe::create();
//
//        // Get the duration of the video in seconds
//        $durationInSeconds = $ffprobe
//            ->format($filePath) // Path to the video file
//            ->get('duration');
//
//        // Convert duration to minutes and seconds if needed
//        $minutes = floor($durationInSeconds / 60);
//        $seconds = $durationInSeconds % 60;
//
//        return [
//            'seconds' => $durationInSeconds,
//            'formatted' => sprintf('%02d:%02d', $minutes, $seconds)
//        ];
    }

    public function validateCode(Request $request)
    {
        if(!auth()->check()){
            return redirect(route('login'));
        }
        $validated = $request->validate([
            'code' => 'required|string|exists:codes,combination',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $lesson = Lesson::find($validated['lesson_id']);

        if (!$lesson) {
            return redirect()->back()->with('error', 'Lesson not found.');
        }

        //check if this code belongs to another user
        $existingUserAccess = StudentLessonAccess::whereNot('student_id', auth()->id())
            ->where('lesson_id', $validated['lesson_id'])
            ->where('access_code', $validated['code'])
            ->first();
        if($existingUserAccess){
            return redirect()->back()->with('error', 'This code belongs to another user');
        }


        //revoke access for duplicate code owners
        $duplicateUserAccess = StudentLessonAccess::where('lesson_id', $validated['lesson_id'])
            ->where('access_code', $validated['code'])
            ->get();
        if(count($duplicateUserAccess)>1){
            return redirect()->back()->with('error', 'Access revoked');
        }

        $existingAccess = StudentLessonAccess::where('student_id', auth()->id())
            ->where('lesson_id', $validated['lesson_id'])
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if ($existingAccess) {
            // Student already has access, no need to provide code again
            return redirect(route('lessons.show',['lesson'=>$validated['lesson_id']]));
        }

        $lessonCodes = $lesson->codes->pluck('combination')->toArray();
        if(empty($lessonCodes)){
            return redirect()->back()->with('error', 'Invalid access code.');
        }
        if (in_array($validated['code'],$lessonCodes)) {
            $code = Code::with(['lesson'])->where('combination',$validated['code'])->first();
            $code->update([
                'status'=> Code::$status['VALID']
            ]);
            $existingAccess = $lesson->StudentLessonAccess()->where([
                'student_id'=>auth()->id(),
                'lesson_id'=>$lesson->id,
                'access_code'=>$request->code,
            ])->first();
            //saving this code for this user
            if(!$existingAccess){
                StudentLessonAccess::query()->create([
                    'student_id'=>auth()->id(),
                    'lesson_id'=>$validated['lesson_id'],
                    'access_code'=>$request->code,
                    'expires_at'=>Carbon::now()->addDays($code->expiry_days),
                ]);
            }
            return redirect(route('lessons.show',['lesson'=>$validated['lesson_id']]));
        } else {
            return redirect()->back()->with('error', 'Invalid code for this lesson');
        }
        return redirect()->back()->with('error', 'Access denied');
    }
}
