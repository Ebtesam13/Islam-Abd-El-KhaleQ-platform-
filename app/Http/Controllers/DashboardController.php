<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\QuizAttempt;
use App\Models\StudentHomeworkAccess;
use App\Models\StudentLessonAccess;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // Paginate students with the "student" role
        $students = User::role('student')->paginate(5); // Paginate with 10 students per page
        $totalStudents = User::role('student')->count(); // Get total number of students
        // Fetch parents and teachers
        $parents = User::role('parent')->with('students')->paginate(5);
        $totalParents = User::role('parent')->count(); // Get total number of students
        $teachers = User::role('teacher')->paginate(5);
        $totalTeachers = User::role('teacher')->count(); // Get total number of students

        // Fetch recent users
        $recentUsers = User::has('roles')->orderBy('created_at', 'desc')->take(6)->get();

        // Calculate the count and percentage for each stage
        $currentStageCounts = User::role('student')
            ->join('courses', 'users.current_stage', '=', 'courses.id')
            ->select('courses.name as stage_name', DB::raw('count(users.id) as student_count'))
            ->groupBy('courses.name')
            ->get();

        // Calculate percentage for each stage
        $currentStageCounts = $currentStageCounts->map(function ($stage) {
            $totalStudents = User::role('student')->count(); // Total number of students
            $stage->percentage = $totalStudents > 0 ? ($stage->student_count / $totalStudents) * 100 : 0;
            return $stage;
        });

        $stages = Course::all();

        $cityNames=array_column(config('cities'),'city_name_en');

        $studentsPerCity = City::select('cities.city_name_en as city_name', DB::raw('COUNT(users.id) as total_students'))
            ->leftJoin('users', 'users.city_id', '=', 'cities.id')  // Use LEFT JOIN to include cities with 0 students
            ->groupBy('cities.city_name_en')
            ->get();

        $cityNames = $studentsPerCity->pluck('city_name')->toArray();
        $totalStudentsCount = $studentsPerCity->pluck('total_students')->toArray();
        $allLessons = 0;
        $allViewedLessons = 0;
        $allHomework = 0;
        $viewedHomework = 0;
        $children = [];
        if(auth()->user()->hasRole('student')){
            $courseId = auth()->user()->current_stage;
            $lessons = Lesson::with('homework')->whereHas('unit', function($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })->get();
            $allLessons=count($lessons);
            $allViewedLessons = StudentLessonAccess::where('student_id',auth()->id())->count();

            foreach ($lessons as $lesson) {
                $allHomework += $lesson->homework->count(); // Count homeworks for each lesson
            }
            $viewedHomework = StudentHomeworkAccess::where('student_id',auth()->id())->count();
        }else if(auth()->user()->hasRole('teacher')){
            $lessons =  Lesson::with('homework')->whereHas('unit.course', function($query) {
                $query->where('author_id', auth()->id());
            })->get();
            $allLessons= count($lessons);
            foreach ($lessons as $lesson) {
                $allHomework += $lesson->homework->count(); // Count homeworks for each lesson
            }
        }else if(auth()->user()->hasRole('parent')){
            $children = auth()->user()->students;
            if(count($children)){
                foreach ($children as $child){
                    $lessons =  Lesson::with('homework')->whereHas('unit.course', function($query) use ($child) {
                        $query->where('id', $child->current_stage);
                    })->get();
                    $allStudentLessons= count($lessons);
                    $allStudentViewedLessons = StudentLessonAccess::where('student_id',$child->id)->count();
                    $allHomework = 0;
                    foreach ($lessons as $lesson) {
                        $allHomework += $lesson->homework->count(); // Count homeworks for each lesson
                    }
                    $studentViewedHomework = StudentHomeworkAccess::where('student_id',$child->id)->count();
                    $child['all_lessons'] = $allStudentLessons;
                    $child['viewed_lessons'] = $allStudentViewedLessons;
                    $child['all_homework'] = $allHomework;
                    $child['viewed_homework'] = $studentViewedHomework;
                }
            }
        }
        $userId = auth()->id(); // Assuming you're fetching data for the authenticated user

        // Get quiz scores for each month of the current year
        $scores = QuizAttempt::where('user_id', $userId)
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, AVG(score) as avg_score')
            ->groupBy('month')
            ->pluck('avg_score', 'month');

        // Prepare scores for each month (1 to 12)
        $monthlyScores = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyScores[] = $scores->get($month, 0); // Use 0 if no scores for that month
        }
        return view('dashboard.index', compact(['students', 'parents', 'teachers', 'recentUsers', 'totalTeachers', 'currentStageCounts',
            'totalStudents','totalParents','stages','cityNames','totalStudentsCount','allLessons','allViewedLessons','allHomework','viewedHomework',
            'monthlyScores','children']));
    }
}
