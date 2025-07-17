<?php

namespace App\Http\Middleware;

use App\Models\StudentLessonAccess;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLessonAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lessonId = $request->route('lesson');
        $hasAccess = StudentLessonAccess::where('student_id', auth()->id())
            ->where('lesson_id', $lessonId)
            ->where('expires_at', '>', Carbon::now())
            ->exists();
        if ($hasAccess) {
            return $next($request);
        }
        if(isset($lessonId['id'])){
            $hasAccess = StudentLessonAccess::where('student_id', auth()->id())
                ->where('lesson_id', $lessonId['id'])
                ->where('expires_at', '>', Carbon::now())
                ->exists();
        }
        if ($hasAccess) {
            return $next($request);
        }
        return redirect()->back()->with('error', 'You do not have access to this lesson.');
    }
}
