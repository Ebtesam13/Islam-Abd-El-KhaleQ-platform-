@extends('partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.courses')}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">{{__('labels.home')}}</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{__('labels.courses')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">{{__('labels.stages')}}</h6>
                <h1 class="mb-5">{{__('labels.popular_stages')}}</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($courses as $index=>$course)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{$index+1}}s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src= {{ asset($course->image_path)}} alt="">
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="{{route('courses.show',['course'=>$course->id])}}" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                       style="border-radius: 30px 30px 30px 30px;">{{__('labels.join_now')}}</a>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">{{$course->name}}</h3>
                                <h5 class="mb-4">{{substr($course->description, 0, 90)}}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">
                                    </i>{{config('app.app_author')}}</small>
{{--                                </i>{{$course->author && !empty($course->author->name) ? $course->author->name : ""}}</small>--}}
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>
                                    {{__('labels.hrs')}} {{$course->hours}}
                                </small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>
                                    {{count($course->units)}} {{__('labels.units')}}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Testimonial Start -->
    <!--<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">-->
    <!--    <div class="container">-->
    <!--        <div class="text-center">-->
    <!--            <h6 class="section-title bg-white text-center text-primary px-3">{{__('labels.testimonial')}}</h6>-->
    <!--            <h1 class="mb-5">{{__('labels.testimonial_description')}}</h1>-->
    <!--        </div>-->
    <!--        <div class="owl-carousel testimonial-carousel position-relative">-->
    <!--            <div class="testimonial-item text-center">-->
    <!--                <img class="border rounded-circle p-2 mx-auto mb-3" src={{asset("img/testimonial-1.jpg")}} style="width: 80px; height: 80px;">-->
    <!--                <h5 class="mb-0">Client Name</h5>-->
    <!--                <p>Profession</p>-->
    <!--                <div class="testimonial-text bg-light text-center p-4">-->
    <!--                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="testimonial-item text-center">-->
    <!--                <img class="border rounded-circle p-2 mx-auto mb-3" src={{asset("img/testimonial-2.jpg")}} style="width: 80px; height: 80px;">-->
    <!--                <h5 class="mb-0">Client Name</h5>-->
    <!--                <p>Profession</p>-->
    <!--                <div class="testimonial-text bg-light text-center p-4">-->
    <!--                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="testimonial-item text-center">-->
    <!--                <img class="border rounded-circle p-2 mx-auto mb-3" src={{asset("img/testimonial-3.jpg")}} style="width: 80px; height: 80px;">-->
    <!--                <h5 class="mb-0">Client Name</h5>-->
    <!--                <p>Profession</p>-->
    <!--                <div class="testimonial-text bg-light text-center p-4">-->
    <!--                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="testimonial-item text-center">-->
    <!--                <img class="border rounded-circle p-2 mx-auto mb-3" src={{asset("img/testimonial-4.jpg")}} style="width: 80px; height: 80px;">-->
    <!--                <h5 class="mb-0">Client Name</h5>-->
    <!--                <p>Profession</p>-->
    <!--                <div class="testimonial-text bg-light text-center p-4">-->
    <!--                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- Testimonial End -->
@endsection
