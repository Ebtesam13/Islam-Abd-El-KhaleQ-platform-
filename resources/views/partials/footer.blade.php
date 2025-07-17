<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Educational stages</h4>
                @foreach(config('app.current_stage') as $index=>$stage)
                    <a class="btn btn-link" href="{{route('courses.show',['course'=>$index +1])}}">{{ucfirst($stage)}}</a>
{{--                    <a class="btn btn-link" href="{{route('about')}}">{{__('labels.about_us')}}</a>--}}
                @endforeach
{{--                <a class="btn btn-link" href="{{route('contact')}}">{{__('labels.contact')}}</a>--}}
{{--                <a class="btn btn-link" href="{{route('policy')}}">{{__('labels.privacy_policy')}}</a>--}}
{{--                <a class="btn btn-link" href="{{route('terms')}}">{{__('labels.terms_conditions')}}</a>--}}
{{--                <a class="btn btn-link" href="{{route('faq')}}">{{__('labels.faq')}}</a>--}}
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">{{__('labels.quick_link')}}</h4>
                <a class="btn btn-link" href="{{route('about')}}">{{__('labels.about_us')}}</a>
                <a class="btn btn-link" href="{{route('contact')}}">{{__('labels.contact')}}</a>
                <a class="btn btn-link" href="{{route('policy')}}">{{__('labels.privacy_policy')}}</a>
                <a class="btn btn-link" href="{{route('terms')}}">{{__('labels.terms_conditions')}}</a>
                <a class="btn btn-link" href="{{route('faq')}}">{{__('labels.faq')}}</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">{{__('labels.contact')}}</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{config('app.office')}}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{config('app.mobile')}}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{config('app.email')}}</p>
                <div class="d-flex pt-2">
{{--                    <a class="btn btn-outline-light btn-social" target="_blank" href="{{config('app.x')}}"><i class="fab fa-twitter"></i></a>--}}
                    <a class="btn btn-outline-light btn-social" target="_blank" href="{{config('app.facebook')}}"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" target="_blank" href="{{config('app.youtube')}}"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" target="_blank" href="{{config('app.whatsapp')}}"><i class="fab fa-whatsapp"></i></a>
{{--                    <a class="btn btn-outline-light btn-social" target="_blank" href="{{config('app.linkedin')}}"><i class="fab fa-linkedin-in"></i></a>--}}
                </div>
            </div>
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <h4 class="text-white mb-3">{{__('labels.gallery')}}</h4>--}}
{{--                <div class="row g-2 pt-2">--}}
{{--                    <div class="col-4">--}}
{{--                        <img class="img-fluid bg-light p-1" src="{{asset("img/carousel-1.jpeg")}}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <img class="img-fluid bg-light p-1" src="{{asset("img/carousel-2.jpeg")}}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <img class="img-fluid bg-light p-1" src="{{asset("img/carousel-3.jpeg")}}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <img class="img-fluid bg-light p-1" src="{{asset("img/carousel-4.jpeg")}}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <img class="img-fluid bg-light p-1" src="{{asset("img/carousel-5.jpeg")}}" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <img class="img-fluid bg-light p-1" src="{{asset("img/carousel-1.jpeg")}}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">{{__('labels.newsletter')}}</h4>
                <p>{{__('labels.newsletter_description')}}</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="{{__('labels.your_email')}}">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">{{__('labels.signup')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="{{route('home')}}">{{config('app.name')}}</a>, {{__('labels.rights_reserved')}}

                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        @php
                            $languages = ['ar','en'];
                            auth()->check() ? array_splice($languages,array_search(auth()->user()->language,$languages),1) :
                            array_splice($languages,array_search(app()->getLocale(),$languages),1);
                        @endphp
                        <a href="{{route('localization.set-locale',['lang'=>$languages[0]])}}">
                            <i class="fa-light fa fa-globe"></i> &nbsp;{{$languages[0]}}
                        </a>
                        <a href="{{route('home')}}">{{__('labels.home')}}</a> &nbsp;
                        <a href="{{route('faq')}}">{{__('labels.faq')}}</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
