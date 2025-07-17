<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserFormRequest;
use App\Models\City;
use App\Models\Course;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $stages = Course::all();
        $cities = City::query()->with('areas')->get();
        return view('auth.register',compact(['cities','stages']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateUserFormRequest $request): RedirectResponse
    {
        $data= $request->validated();
        $data['mobile']= isset($data['parent_mobile']) ? $data['parent_mobile'] : $data['mobile'];
        $data['whats_app']= $data['mobile'];
        $data['code']= Str::random(6);
        $user = User::create($data);
        $user->assignRole($data['user_type']);
        if(isset($data['parent_mobile'])){
            $student = User::where('mom_whats_app', $data['parent_mobile'])
                ->orWhere('dad_whats_app', $data['parent_mobile'])->first();
            if($student){
                $student->parents()->attach($user->id);
            }
        }
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard.');
    }
}
