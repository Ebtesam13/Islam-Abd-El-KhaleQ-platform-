@extends('partials.layout')
@section('content')
    <!-- Session Status -->
    {{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}
    <!-- Carousel Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.reset_password')}}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="row g-4">
        <div class="col-lg-4  m-auto justify-content-center col-md-12 wow fadeInUp" data-wow-delay="0.5s">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" name="email" class="form-control" id="email" placeholder="{{__('labels.email')}}">
                            <label for="subject">{{__('labels.email')}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" name="password" class="form-control" id="password" placeholder="{{__('labels.password')}}">
                            <label for="subject">{{__('labels.password')}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="{{__('labels.password_confirmation')}}">
                            <label for="subject">{{__('labels.password_confirmation')}}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">{{__('labels.reset_password')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('password.store') }}">--}}
{{--        @csrf--}}

{{--        <!-- Password Reset Token -->--}}
{{--        <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}
{{--            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Reset Password') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
