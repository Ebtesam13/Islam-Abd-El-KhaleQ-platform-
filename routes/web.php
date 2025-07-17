<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\BookletController;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Dashboard\DashboardCourseController;
use App\Http\Controllers\Dashboard\DashboardLessonsController;
use App\Http\Controllers\Dashboard\DashboardHomeworkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LecturesController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicQuestionController;
use App\Http\Controllers\PublicQuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizCorrectionController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    if ($request->user()) {
        return redirect($request->user()->language.'/');
    }

    // Get from browser language settings on first arrive
    $language = substr($request->getPreferredLanguage(), 0, 2);

    if (in_array($language, array_keys(config('app.released_locales')))) {
        return redirect($language.'/');
    }

    return redirect(app()->getFallbackLocale().'/');
})->name('init');

Route::group([
    'prefix' => '{locale}',
    'middleware' => ['locale'],
], function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
    Route::get('/team', [HomeController::class, 'team'])->name('team');
    Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
    Route::get('/404', [HomeController::class, 'get404'])->name('404');
    Route::get('/policy', [HomeController::class, 'policy'])->name('policy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');


    Route::resource('courses',CourseController::class);
    Route::get('set-locale/{lang}', [LocalizationController::class, 'setLocale'])->name('localization.set-locale');
    Route::post('/validate-code}', [DashboardLessonsController::class, 'validateCode'])->name('validate.code');

    Route::group([
        'prefix' => 'dashboard',
        'middleware' => ['auth','verified'],
        'as' => 'dashboard.',
    ], function () {
        Route::get('/', [DashboardController::class,'index']);
        Route::resource('courses',DashboardCourseController::class);
        Route::get('courses/create/{id}', [DashboardCourseController::class,'create'])->name('dashboard_courses.create');

        Route::resource('units',UnitController::class)->except(['create']);
        Route::get('units/create/{id}', [UnitController::class,'create'])->name('dashboard_units.create');
        Route::get('units/getById/{courseId}', [UnitController::class,'getUnitsByCourseId'])->name('dashboard_units_from_course');

//        Route::resource('lessons',DashboardLessonsController::class)->except(['create']);
        Route::get('/lessons', [DashboardLessonsController::class,'index'])->name('dashboard_lessons.index');
        Route::post('/lessons', [DashboardLessonsController::class,'store'])->name('lessons.store');
        Route::get('lessons/create/{id}', [DashboardLessonsController::class,'create'])->name('dashboard_lessons.create');
        Route::get('/lessons/{lesson}/edit', [DashboardLessonsController::class, 'edit'])->name('lessons.edit');
        Route::put('/lessons/{lesson}', [DashboardLessonsController::class, 'update'])->name('lessons.update');
        Route::get('/lessons/{lesson}', [DashboardLessonsController::class, 'show'])->name('lessons.show');
        Route::delete('/lessons/{lesson}', [DashboardLessonsController::class, 'destroy'])->name('lessons.destroy');
        Route::get('lessons/getById/{unitId}', [DashboardLessonsController::class,'getLessonsByUnitId'])->name('dashboard_lessons_from_unit');

        Route::resource('homework',DashboardHomeworkController::class)->except(['create']);
        Route::get('homework/create/{id}', [DashboardHomeworkController::class,'create'])->name('dashboard_homework.create');
        Route::get('homework/getById/{lessonId}', [DashboardHomeworkController::class,'getHomeworkByLessonId'])->name('dashboard_homework_from_lesson');
        Route::post('/homework/{homeworkId}/mark-as-viewed', [DashboardHomeworkController::class, 'markHomeworkAsViewed'])
            ->name('homework.markAsViewed');

        Route::resource('quiz_corrections', QuizCorrectionController::class);
        Route::get('/quiz/{quiz}/students', [QuizController::class, 'getQuizStudents'])->name('quiz.students');
        Route::get('/public_quizzes/quiz/{quiz}/students', [PublicQuizController::class, 'getQuizStudents'])->name('public_quizzes.quiz.students');
        Route::delete('/quiz-attempts/{attempt}', [QuizController::class, 'destroyAttempt'])->name('quiz-attempts.destroy');
        Route::resource('booklets', BookletController::class);
        Route::post('/validate-booklet-code', [BookletController::class, 'validateCode'])->name('validate.code');

        Route::get('codes/download/{lesson}', [DashboardLessonsController::class,'downloadCodes'])->name('codes.download');


        //student routes
        Route::get('lectures', [LecturesController::class,'index'])->name('lectures.index');
        Route::resource('codes', CodesController::class)->middleware(['role:teacher|admin']);

    });
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('quizzes', QuizController::class);
        Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
        Route::resource('lessons',LessonsController::class);
        Route::get('/quizzes/{quizId}/start', [QuizController::class, 'startQuiz'])->name('quizzes.start');
        Route::get('/quizzes/{quizId}/question/{questionNumber}', [QuizController::class, 'showQuestion'])->name('quizzes.question');
        Route::post('/quizzes/{quizId}/submit-answer/{questionNumber}', [QuizController::class, 'submitAnswer'])->name('quizzes.submitAnswer');
        Route::get('/quizzes/{quizId}/results', [QuizController::class, 'showQuizResults'])->name('quiz.results');

        Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuizController::class, 'editQuestion'])->name('questions.edit');
        Route::put('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'updateQuestion'])->name('questions.update');
        Route::delete('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'destroyQuestion'])->name('questions.destroy');


        Route::resource('public_quizzes', PublicQuizController::class);
        Route::post('/public_quizzes/{quiz}/submit', [PublicQuizController::class, 'submit'])->name('public_quizzes.submit');
        Route::get('/public_quizzes/{quizId}/start', [PublicQuizController::class, 'startQuiz'])->name('public_quizzes.start');
        Route::get('/public_quizzes/{quizId}/question/{questionNumber}', [PublicQuizController::class, 'showQuestion'])->name('public_quizzes.question');
        Route::post('/public_quizzes/{quizId}/submit-answer/{questionNumber}', [PublicQuizController::class, 'submitAnswer'])->name('public_quizzes.submitAnswer');
        Route::get('/public_quizzes/{quizId}/results', [PublicQuizController::class, 'showQuizResults'])->name('public_quiz.results');
        Route::get('/public_quizzes/{quiz}/questions/create', [PublicQuestionController::class, 'create'])->name('public_questions.create');
        Route::post('/public_quizzes/{quiz}/questions', [PublicQuestionController::class, 'store'])->name('public_questions.store');
        Route::get('/public_quizzes/{quiz}/questions/{question}/edit', [PublicQuizController::class, 'editQuestion'])->name('public_questions.edit');
        Route::put('/public_quizzes/{quiz}/questions/{question}', [PublicQuizController::class, 'updateQuestion'])->name('public_questions.update');
        Route::delete('/public_quizzes/{quiz}/questions/{question}', [PublicQuizController::class, 'destroyQuestion'])->name('public_questions.destroy');

        Route::resource('students', StudentController::class)->middleware(['role:teacher|admin']);
    });
    Route::group(['middleware' => ['auth','verified','role:parent']], function () {
        Route::get('/scores', [ScoresController::class, 'index'])->name('scores.index');
    });
    Route::group(['middleware' => ['auth','verified','role:teacher']], function () {
        Route::get('/export-students-scores/{stage}', [ScoresController::class, 'exportScores'])->name('export.students.scores');
    });
    require __DIR__.'/auth.php';
    Route::get('/areas/{cityId}', [AreasController::class, 'getAreasByCityId'])->name('areas');
    Route::get('/mark-video-viewed/{lessonId}', [LessonsController::class, 'viewLesson'])->name('mark-video-viewed');
});
Route::get('students/data', [StudentController::class, 'data'])->middleware(['role:teacher|admin'])->name('students.data');
Route::get('codes/data', [CodesController::class, 'data'])->middleware(['role:teacher|admin'])->name('codes.data');
