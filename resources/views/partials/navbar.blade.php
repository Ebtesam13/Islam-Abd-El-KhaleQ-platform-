<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
{{--    <a href="{{route('home')}}" class="navbar-brand d-flex flex-column align-items-center px-4 px-lg-5">--}}
{{--        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>{{config('app.name')}}</h2>--}}
{{--        <span class="text-muted" style="font-size: 14px;">The official sponsor of simplifying chemistry</span>--}}
{{--    </a>--}}
    <a href="{{route('home')}}" class="navbar-brand d-flex flex-column align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">
            <img src="{{asset("img/logo-icon.jpeg")}}" alt="Logo" style="width: 40px; height: 40px;" class="me-3">
            {{ config('app.name') }}
        </h2>
        <span class="text-muted" style="font-size: 14px;">The official sponsor of simplifying chemistry</span>
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{route('home')}}" class="nav-item nav-link @if(Route::currentRouteName() == 'home') active @endif">{{__('labels.home')}}</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Stages</a>
                <div class="dropdown-menu fade-down m-0">
                    @foreach(config('app.current_stage') as $index=>$stage)
                        <a class="dropdown-item" href="{{route('courses.show',['course'=>$index +1])}}">{{ucfirst($stage)}}</a>
                    @endforeach
                </div>
            </div>
{{--            <div class="nav-item dropdown">--}}
                <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">Centers</a>
{{--                <div class="dropdown-menu fade-down m-0">--}}
{{--                    <a class="dropdown-item" href="{{route('center')}}">6 October &amp; Zayed City</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <a href="{{route('about')}}" class="nav-item nav-link  @if(Route::currentRouteName() == 'about') active @endif">{{__('labels.about_us')}}</a>
{{--            <a href="{{route('courses.index')}}" class="nav-item nav-link  @if(Route::currentRouteName() == 'courses.index') active @endif">{{__('labels.courses')}}</a>--}}
{{--            <div class="nav-item dropdown">--}}
{{--                <a href="#" class="nav-link dropdown-toggle @if(in_array(Route::currentRouteName(),['team','testimonial','404','policy','terms','faq'])) active @endif" data-bs-toggle="dropdown">{{__('labels.pages')}}</a>--}}
{{--                <div class="dropdown-menu fade-down m-0">--}}
{{--                    <a href="{{route('testimonial')}}" class="dropdown-item @if(Route::currentRouteName() == 'testimonial') active @endif">{{__('labels.testimonial')}}</a>--}}
{{--                    <a href="{{route('policy')}}" class="dropdown-item @if(Route::currentRouteName() == 'policy') active @endif">{{__('labels.privacy_policy')}}</a>--}}
{{--                    <a href="{{route('terms')}}" class="dropdown-item @if(Route::currentRouteName() == 'terms') active @endif">{{__('labels.terms_conditions')}}</a>--}}
{{--                    <a href="{{route('faq')}}" class="dropdown-item @if(Route::currentRouteName() == 'faq') active @endif">{{__('labels.faq')}}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <a href="{{route('faq')}}" class="nav-item nav-link">FAQ</a>
            {{--            <a href="{{route('contact')}}" class="nav-item nav-link  @if(Route::currentRouteName() == 'contact') active @endif">{{__('labels.contact')}}</a>--}}

{{--            <div class="nav-item dropdown">--}}
{{--                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{__('labels.language')}}</a>--}}
{{--                <div class="dropdown-menu fade-down m-0">--}}
{{--                    @foreach(config('app.released_locales') as $locale)--}}
{{--                        <a href="{{route('localization.set-locale',['lang'=>$locale])}}" class="dropdown-item  @if(app()->getLocale() == $locale) active @endif">{{$locale}}</a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <a class="btn-social m-2" target="_blank" href="{{config('app.facebook')}}"><i class="fab fa-facebook-f"></i></a>
        <a class="btn-social m-2" target="_blank" href="{{config('app.youtube')}}"><i class="fab fa-youtube"></i></a>
        <a class="btn-social m-2" target="_blank" href="{{config('app.whatsapp')}}"><i class="fab fa-whatsapp"></i></a>
    @if(auth()->check())
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">{{auth()->user()->name}}</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="{{route('profile.edit')}}" class="dropdown-item">{{__('labels.profile')}}</a>
                    <a href="{{route('dashboard.')}}" class="dropdown-item">{{__('labels.dashboard')}}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            {{ __('labels.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="d-flex align-items-center">
                <a href="{{route('login')}}" class="nav-link btn btn-outline-primary mx-2" style="height: auto !important;" onmouseover="this.style.color='white'" onmouseout="this.style.color=''">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{route('register')}}" class="nav-link btn btn-outline-success mx-2" style="height:auto !important;" onmouseover="this.style.color='white'" onmouseout="this.style.color=''">
                    <i class="fas fa-user-plus"></i> Join for Free
                </a>
            </div>
{{--            <a href="{{route('register')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">{{__('labels.join_now')}}<i class="fa fa-arrow-right ms-3"></i></a>--}}
        @endif
    </div>
</nav>
