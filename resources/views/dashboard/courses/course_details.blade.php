@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 mb-5 page-header">
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                @if (session('alert-success'))
                    <div class="container alert alert-success" role="alert">
                        {{ session('alert-success') }}
                    </div>
                @endif
                @if (session('alert-danger'))
                    <div class="container alert alert-danger" role="alert">
                        {{ session('alert-danger') }}
                    </div>
                @endif
                @if(Session::has('message'))
                    @foreach(Session::get('message') as $class => $message)
                        <p class="alert {{ $class}}">{{$message}}</p>
                    @endforeach
                @endif
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100" src="{{asset("img/about.jpg")}}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="mb-4">{{$course->name}}</h1>
                    <p class="mb-4">
                        {{$course->description}}
                    </p>
                    <div class="course-item bg-light">
                        <div class="text-center p-4 pb-0">
                            <h5 class="mb-4">{{$course->description}}</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">
                                </i>{{config('app.app_author')}}</small>
{{--                            </i>{{$course && $course->author ? $course->author->name : ""}}</small>--}}
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>
                                {{$course->hours}} Hrs
                            </small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>
                                {{count($course->users)}} Students
                            </small>
                        </div>
                        <br>
                        <div class="border-top">
                            <div class="text-center p-4 pb-0">
                                <h5 class="mb-4">{{__('labels.units_list')}}</h5>
                            </div>
                            @foreach($course->units as $unit)
                                <a class="btn btn-primary py-3 px-5 mt-2" href="{{route('dashboard.units.show',['unit'=>$unit->id])}}">{{$unit->name}}</a>
                                <br><br>
                            @endforeach
                        </div>

                        <a class="btn btn-primary w-100 py-3" href="{{route('dashboard.dashboard_units.create',['id'=>$course->id])}}" type="button">{{__('labels.add_new_unit')}}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


@endsection
