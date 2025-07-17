@extends('partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.privacy_policy')}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">{{__('labels.home')}}</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">{{__('labels.pages')}}</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{__('labels.privacy_policy')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src={{asset("img/about.jpg")}} alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">{{__('labels.privacy_policy')}}</h6>
                    <h1 class="mb-4">{{__('labels.welcome_to')}}</h1>
                    <p class="mb-4">
                        {{__('labels.privacy.effective_date')}}<br>
                        {{__('labels.privacy.intro')}}<br>

                    </p>
                    <p class="mb-4">
                        {!! __('labels.privacy.line1') !!}
                    </p>
                </div>
            </div><br>
            <div class="row wow fadeInUp">
                <p class="mb-4">
                    {!! __('labels.privacy.line2') !!}
                 </p>
                <p class="mb-4">
                    {!! __('labels.privacy.line3') !!}
                </p>
                <p class="mb-4">
                    {!! __('labels.privacy.line4') !!}
                </p>
                <p class="mb-4">
                    {!! __('labels.privacy.line5') !!}
                </p>
                <p class="mb-4">
                    {!! __('labels.privacy.line6') !!}
                </p>
                <p class="mb-4">
                    {!! __('labels.privacy.line7') !!}
                </p>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
