@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 mb-5 page-header">
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset("img/about.jpg")}}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="mb-4">{{$unit->name}}</h1>
                    <br>
                    <div class="border-top">
                        <div class="text-center p-4 pb-0">
                            <h5 class="mb-4">{{__('labels.lessons_list')}}</h5>
                        </div>
                        @foreach($unit->lessons as $lesson)
                            <a class="btn btn-primary py-3 px-5 mt-2" href="{{route('dashboard.lessons.show',['lesson'=>$lesson->id])}}">{{$lesson->name}}</a>
                            <br><br>
                        @endforeach
                    </div>

                    <div class="course-item bg-light">
                        <a class="btn btn-primary w-100 py-3" href="{{route('dashboard.dashboard_lessons.create',['id'=>$unit->id])}}" type="button">{{__('labels.add_new_lesson')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
