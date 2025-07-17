<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\HttpKernel\Bundle\load;

class LocalizationController extends Controller
{
    public function setLocale($lang): RedirectResponse
    {
        if (!in_array($lang, config('app.released_locales'))) {
            $lang = app()->getFallbackLocale();
        }

        if (auth()->check()) {
            $this->updateUserPreferredLanguage($lang);
        }

        app()->setLocale($lang);
        session(['language' => $lang]);

        return redirect()->back();
    }

    private function updateUserPreferredLanguage($lang)
    {
        $user = User::query()->find(auth()->user()->id);
        $user->update([
            'language'=>$lang
        ]);
    }
}
