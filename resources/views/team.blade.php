@extends('partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.our_team')}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">{{__('labels.home')}}</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">{{__('labels.pages')}}</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{__('labels.our_team')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">{{__('labels.instructors')}}</h6>
                <h1 class="mb-5">{{__('labels.expert_instructors')}}</h1>
            </div>
            <div class="row g-4">
                @for($i=0 ; $i<9 ; $i++)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.{{$i+2}}s">
                        <div class="team-item bg-light">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src= {{ asset("img/team-1.jpg")}} alt="">
                            </div>
                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4">
                                <h5 class="mb-0">{{__('labels.instructor_name')}}</h5>
                                <small>Designation</small>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <!-- Team End -->

@endsection

