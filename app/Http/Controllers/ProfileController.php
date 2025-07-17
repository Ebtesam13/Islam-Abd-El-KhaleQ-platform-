<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Area;
use App\Models\City;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'stages' => Course::all(),
            'cities' => City::query()->with('areas')->get(),
            'areas' => Area::query()->where('city_id',$request->user()->city_id)->get()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['mobile']= isset($data['parent_mobile']) ? $data['parent_mobile'] : $data['mobile'];
        $data['whats_app']= $data['mobile'];
        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if ($request->hasFile('image_path')) {
            $filePath = $request->file('image_path')->store('profile_images', 'public');
            $request->user()->image_path = $filePath;
        }
        $request->user()->save();
        if(isset($data['parent_mobile'])){
            $students = User::where('mom_whats_app', $data['parent_mobile'])
                ->orWhere('dad_whats_app', $data['parent_mobile'])->get();
            if($students){
                foreach ($students as $student) {
                    $student->parents()->syncWithoutDetaching($request->user()->id);
                }
            }
        }
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
