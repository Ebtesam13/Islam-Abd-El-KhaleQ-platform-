
@extends('partials.layout')
@section('content')
    <!-- Session Status -->
    {{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}
    <!-- Carousel Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.password_reset')}}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="row g-4">
        <div class="col-lg-4  m-auto justify-content-center col-md-12 wow fadeInUp" data-wow-delay="0.5s">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" name="email" class="form-control" id="email" placeholder="{{__('labels.email')}}">
                            <label for="subject">{{__('labels.email')}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">{{__('labels.send_password_email')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

{{--<x-guest-layout>--}}
{{--    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">--}}
{{--        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--    </div>--}}

{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('password.email') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Email Password Reset Link') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
