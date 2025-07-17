<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\PublicQuiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $courses = Course::with(['category','rates','author','users','units'])->limit(4)->get();
        $categories = Category::withCount('courses')->limit(4)->inRandomOrder()->get();
        $publicQuiz = PublicQuiz::query()->where('active',1)->first();
        return view('welcome',compact('courses','categories','publicQuiz'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function team()
    {
        return view('team');
    }

    public function testimonial()
    {
        return view('testimonial');
    }

    public function get404()
    {
        return view('404');
    }

    public function policy()
    {
        return view('policy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function faq()
    {
        return view('faq');
    }
}
