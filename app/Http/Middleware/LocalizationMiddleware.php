<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get recommended locale
        $locale = $this->getRecommendedLocale($request);

        // Redirect page to correct language
        if ($request->segment(1) !== $locale) {
            return $this->redirectToLocale($request, $locale);
        }

        // Fix locale in app
        app()->setLocale($locale);

        // Set routes default locale (Avoiding to set the locale in every route() calls)
        URL::defaults(['locale' => $locale]);

        // Set controller methods default locale (Avoiding to add a locale parameter in every method signatures)
        $request->route()->forgetParameter('locale');

        return $next($request);
    }

    protected function getRecommendedLocale(Request $request): string
    {
        // Get from user if authenticated
        if ($request->user() && $request->user()->language) {
            return $request->user()->language;
        }

        //Get from session if unauthenticated and has changed locale via footer setLang
        if (session()->has('language')) {
            return session('language');
        }

        return app()->getFallbackLocale();
    }

    protected function redirectToLocale(Request $request, $locale)
    {
        $url = $request->fullUrl();

        $tab = explode("/", $url);
        $tab[3] = $locale;

        return redirect(implode('/', $tab));
    }
}
