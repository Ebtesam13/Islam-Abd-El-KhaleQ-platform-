@extends('partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.about_us')}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">{{__('labels.home')}}</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{__('labels.about_us')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
{{--                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">--}}
{{--                    <div class="service-item text-center pt-3">--}}
{{--                        <div class="p-4">--}}
{{--                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>--}}
{{--                            <h5 class="mb-3">{{__('labels.skilled_instructors')}}</h5>--}}
{{--                            <p>{{__('labels.headlines.line6')}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">{{__('labels.online_classes')}}</h5>
                            <p>{{__('labels.headlines.line7')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-home text-primary mb-4"></i>
                            <h5 class="mb-3">{{__('labels.home_exams')}}</h5>
                            <p>{{__('labels.headlines.line8')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">{{__('labels.book_library')}}</h5>
                            <p>{{__('labels.headlines.line9')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset("img/about.jpg")}}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">{{__('labels.about_us')}}</h6>
                    <h1 class="mb-4">{{__('labels.welcome_to')}}</h1>
                    <p class="mb-4">
                        {{__('labels.welcome_message')}}  {{__('labels.welcome_to')}}
                    </p>
                    <p class="mb-4">
                        {{__('labels.headlines.line10')}}
                    </p>
                    <div class="row gy-2 gx-4 mb-4">
{{--                        <div class="col-sm-6">--}}
{{--                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>{{__('labels.skilled_instructors')}}</p>--}}
{{--                        </div>--}}
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>{{__('labels.online_classes')}}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>{{__('labels.home_exams')}}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>{{__('labels.book_library')}}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>{{__('labels.unique_experience')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Team Start -->
{{--    <div class="container-xxl py-5">--}}
{{--        <div class="container">--}}
{{--            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">--}}
{{--                <h6 class="section-title bg-white text-center text-primary px-3">{{__('labels.instructors')}}</h6>--}}
{{--                <h1 class="mb-5">{{__('labels.expert_instructors')}}</h1>--}}
{{--            </div>--}}
{{--            <div class="row g-4">--}}
{{--                @for($i=0 ; $i<4 ; $i++)--}}
{{--                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.{{$i+2}}s">--}}
{{--                        <div class="team-item bg-light">--}}
{{--                            <div class="overflow-hidden">--}}
{{--                                <img class="img-fluid" src= {{ asset("img/team-1.jpg")}} alt="">--}}
{{--                            </div>--}}
{{--                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">--}}
{{--                                <div class="bg-light d-flex justify-content-center pt-2 px-1">--}}
{{--                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>--}}
{{--                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>--}}
{{--                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="text-center p-4">--}}
{{--                                <h5 class="mb-0">{{__('labels.instructor_name')}}</h5>--}}
{{--                                <small>Designation</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endfor--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Team End -->

@endsection
