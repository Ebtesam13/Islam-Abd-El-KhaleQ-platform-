@extends('partials.layout')
@section('content')
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.login')}}</h1>
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
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" name="email" class="form-control" id="email" placeholder="{{__('labels.email')}}">
                        <label for="subject">{{__('labels.email')}}</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="{{__('labels.password')}}">
                        <label for="subject">{{__('labels.password')}}</label>
                    </div>
                </div>
                <div class="col-6">
                    <input type="checkbox" name="remember_me" id="remember_me">
                    <label for="remember_me">{{__('labels.remember_me')}}</label>
                </div>
                <div class="col-6 text-end">
                    <p>{{__('labels.new_account')}} <a href="{{route('register')}}">{{__('labels.register')}}</a></p>
                </div>
                <div class="col-12">
                    <p>{{__('labels.forgot_password')}} <a href="{{route('password.request')}}">{{__('labels.reset_password')}}</a></p>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100 py-3" type="submit">{{__('labels.login')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
