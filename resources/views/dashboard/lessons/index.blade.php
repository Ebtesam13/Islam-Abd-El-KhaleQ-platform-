@extends('dashboard.partials.layout')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
              {{--  <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">{{__('labels.welcome_to') .' '. __('labels.dashboard')}} </h6>
                </div>--}}
                 <div class="breadcrumb mb-24 custom-breadcrumb">
    <ul class="flex-align gap-4">
        <li><a href="{{route('dashboard.')}}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
        <li><span class="text-gray-500 fw-normal d-flex"><i class="fas fa-chevron-right"></i></span></li>
        <li><span class="text-main-600 fw-normal text-15">Lectures</span></li>
    </ul>
</div>


            </div>
            @role('teacher')
                <!-- Courses Start -->
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="row g-4 justify-content-center">
                            @foreach($courses as $index=>$course)
                                <div class="col-lg-4 col-md-6 wow fadeInUp"
                                     style="border:1px solid gray;">
                                    <div class="course-item bg-light">
                                        <div class="position-relative overflow-hidden">
                                            <img class="img-fluid" src= {{ asset("img/course-1.jpg")}} alt="">
                                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                                <a href="{{route('dashboard.courses.show',['course'=>$course->id])}}" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                                   style="border-radius: 30px 30px 30px 30px;">{{__('labels.show')}}</a>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 pb-0">
                                            <h3 class="mb-0">{{$course->name}}</h3>
                                            <h5 class="mb-4">{{substr($course->description, 0, 90)}}</h5>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">
                                                </i>{{$course->author && !empty($course->author->name) ? $course->author->name : ""}}</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>
                                                {{__('labels.hrs')}} {{$course->hours}}
                                            </small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>
                                                {{count($course->lessons)}} {{__('labels.lessons')}}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Courses End -->
            @endrole
          {{--  @role('student')
            <!-- Courses Start -->
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="row g-4 justify-content-center">
                        @foreach($lectures as $index=>$lecture)
                            <div class="col-lg-4 col-md-6 wow fadeInUp"
                                 style="border:1px solid gray;">
                                <div class="course-item bg-light">
                                    <div class="position-relative overflow-hidden">
                                        <img class="img-fluid" src= {{ asset("img/course-1.jpg")}} alt="">
                                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                            <a href="{{route('dashboard.lessons.show',['lesson'=>$lecture->id])}}" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                               style="border-radius: 30px 30px 30px 30px;">{{__('labels.show')}}</a>
                                        </div>
                                    </div>
                                    <div class="text-center p-4 pb-0">
                                        <h3 class="mb-0">{{$lecture->name}}</h3>
                                        <h5 class="mb-4">{{substr($lecture->description, 0, 90)}}</h5>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">
                                            </i>{{isset($lecture->author) && !empty($lecture->author->name) ? $lecture->author->name : config('app.app_author')}}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Courses End -->
            @endrole--}}
            
           @role('student')
<!-- Courses Start -->
<div class="container-xxl py-2">
    
 <div class="py-4" style="background-color: #fff; border-radius: 10px;">
<div class="container  p-4 rounded-4 ">
        <h4 class="fw-bold mb-4">Second Secondary: Lectures</h4>

        <div class="row g-4 justify-content-start">
            @foreach($lectures as $index=>$lecture)
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ ($index + 1) * 0.2 }}s">
    <div class="card h-100 shadow-sm border border-gray-800 rounded-4 d-flex flex-column">
        <div class="bg-white rounded-4 border shadow-sm p-3">
            <img class="img-fluid w-100" src="{{ asset('img/course-1.jpg') }}" alt="" style="height: 200px; object-fit: cover;">
        </div>

        <div class="px-3 pt-2 flex-grow-1 d-flex flex-column">
            <h5 class="fw-semibold">{{ $lecture->name }}</h5>
            <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($lecture->description, 90) }}</p>

            <div class="d-flex text-muted small mb-2">
                <div class="me-3"><i class="fas fa-book-open me-1 text-info"></i> {{ $lecture->lessons_count ?? 'Lessons' }}</div>
                <div><i class="fas fa-clock me-1 text-info"></i> {{ $lecture->duration ?? '2 Hours' }}</div>
            </div>

            <div class="mt-auto my-2"> 
                <a href="{{ route('dashboard.lessons.show', ['lesson' => $lecture->id]) }}"
                   class="btn btn-outline-info btn-lg rounded-pill py-1">
                    {{ __('labels.show') }}
                </a>
            </div>
        </div>
    </div>
</div>

            @endforeach
        </div>
    </div>
    </div>
</div>
<!-- Courses End -->
@endrole



        </div>
    </div>
@endsection
