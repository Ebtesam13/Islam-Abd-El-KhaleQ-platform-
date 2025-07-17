@extends('partials.layout')
@push('page-specific-styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href= {{ asset("css/msform.css")}} rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{__('labels.register')}}</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- msform Start -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">{{__("labels.signup_account")}}</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" id="msform">
                        @csrf
                        <input type="hidden" id="areas_route" value="{{route('areas',['cityId'=>1])}}">
                        <!-- Account Information -->
                        <div class="form-card mb-4">
                            <div class="row mb-3">
                                <div class="col-7">
                                    <h2 class="fs-title">{{ __('labels.account_information') }}</h2>
                                </div>
                                <div class="col-5 text-end">
                                    <h2 class="steps">Step 1 - 2</h2>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="user_type" class="form-label">{{ __('labels.user_type') }} *</label>
                                <select class="form-select" name="user_type" id="user_type" aria-label="Default select example" required>
                                    <option value="" disabled selected>{{ __('labels.select') }}</option>
                                    @foreach(config('app.user_types') as $userType)
                                        <option value="{{ $userType }}">
                                            {{ ucfirst(__('labels.' . $userType)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('labels.name') }} *</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('labels.name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('labels.email') }} *</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('labels.email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('labels.password') }} *</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('labels.password') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('labels.password_confirmation') }} *</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('labels.password_confirmation') }}" required>
                            </div>
                        </div>

                        <div class="user_type_info" id="student_info">
                            <!-- Personal Information -->
                            <div class="form-card mb-4">
                                <div class="row mb-3">
                                    <div class="col-7">
                                        <h2 class="fs-title">{{ __('labels.personal_information') }}:</h2>
                                    </div>
                                    <div class="col-5 text-end">
                                        <h2 class="steps">Step 2 - 2</h2>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="senior_year" id="senior_year">
                                                <option disabled selected>{{ __('labels.senior_year') }}</option>
                                                <option value="{{ \Carbon\Carbon::parse(date('Y'))->format('Y') }}">
                                                    {{ \Carbon\Carbon::parse(date('Y'))->format('Y') }}
                                                </option>
                                                <option value="{{ \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') }}">
                                                    {{ \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') }}
                                                </option>
                                            </select>
                                            <label for="senior_year">{{ __('labels.senior_year') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="current_stage" id="current_stage">
                                                <option disabled selected>{{ __('labels.current_stage') }}</option>
                                                @foreach($stages as $currentStage)
                                                    <option value="{{ $currentStage->id }}">{{ ucfirst($currentStage->name) }}</option>
                                                @endforeach
                                            </select>
                                            <label for="current_stage">{{ __('labels.current_stage') }}</label>
                                        </div>
                                    </div>

{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select class="form-select" name="department" id="department">--}}
{{--                                                <option disabled selected>{{ __('labels.department') }}</option>--}}
{{--                                                @foreach(config('app.departments') as $department)--}}
{{--                                                    <option value="{{ $department }}">{{ ucfirst(__('labels.departments.' . $department)) }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="department">{{ __('labels.department') }}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="select-city" name="city_id">
                                                <option disabled selected>{{ __('labels.city') }}</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ ucfirst($city->city_name_ar) . ' - ' . $city->city_name_en }}</option>
                                                @endforeach
                                            </select>
                                            <label for="select-city">{{ __('labels.city') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="select-area" name="area_id">
                                                <option selected disabled>{{ __('labels.area') }}</option>
                                            </select>
                                            <label for="select-area">{{ __('labels.area') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="school" id="school" placeholder="{{ __('labels.school') }}">
                                            <label for="school">{{ __('labels.school') }}</label>
                                        </div>
                                    </div>

{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select class="form-select" name="school_type">--}}
{{--                                                <option disabled selected>{{ __('labels.school_type') }}</option>--}}
{{--                                                @foreach(config('app.school_types') as $schoolType)--}}
{{--                                                    <option value="{{ $schoolType }}">{{ ucfirst(__('labels.school_types.' . $schoolType)) }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="school_type">{{ __('labels.school_type') }}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select class="form-select" name="second_language">--}}
{{--                                                <option disabled selected>{{ __('labels.second_language') }}</option>--}}
{{--                                                @foreach(config('app.second_language') as $lang)--}}
{{--                                                    <option value="{{ $lang }}">{{ ucfirst(__('labels.second_languages.' . $lang)) }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="second_language">{{ __('labels.second_language') }}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <div class="input-group mb-3">
                                                <select name="mobile_country_code" class="form-select">
                                                    <option value="+20">+20</option>
                                                    @foreach(config('country_codes') as $codeArray)
                                                        <option value="{{ $codeArray['dial_code'] }}">{{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control inputmask-number" name="mobile" placeholder="{{ __('labels.mobile') }}">
                                            </div>
                                            <label for="mobile">{{ __('labels.mobile') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <div class="input-group mb-3">
                                                <select name="mom_whats_app" class="form-select">
                                                    <option value="+20">+20</option>
                                                    @foreach(config('country_codes') as $codeArray)
                                                        <option value="{{ $codeArray['dial_code'] }}">{{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control inputmask-number" name="mom_whats_app" placeholder="{{ __('labels.mom_whats_app') }}">
                                            </div>
                                            <label for="mom_whats_app">{{ __('labels.mom_whats_app') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <div class="input-group mb-3">
                                                <select name="dad_whats_app" class="form-select">
                                                    <option value="+20">+20</option>
                                                    @foreach(config('country_codes') as $codeArray)
                                                        <option value="{{ $codeArray['dial_code'] }}">{{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control inputmask-number" name="dad_whats_app" placeholder="{{ __('labels.dad_whats_app') }}">
                                            </div>
                                            <label for="dad_whats_app">{{ __('labels.dad_whats_app') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="dad_job" id="dad_job" placeholder="{{ __('labels.dad_job') }}">
                                            <label for="dad_job">{{ __('labels.dad_job') }}</label>
                                        </div>
                                    </div>

{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <input type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="{{ __('labels.facebook_link') }}">--}}
{{--                                            <label for="facebook_link">{{ __('labels.facebook_link') }}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="identity_number" id="identity_number" placeholder="{{ __('labels.identity_number') }}">
                                            <label for="identity_number">{{ __('labels.identity_number') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Parent Information -->
                        <div class="user_type_info" id="parent_info">
                            <div class="form-card mb-4">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h2 class="fs-title">{{ __('labels.parent_information') }}:</h2>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <div class="input-group mb-3">
                                            <select name="mobile_country_code" class="form-select">
                                                <option value="+20">+20</option>
                                                @foreach(config('country_codes') as $codeArray)
                                                    <option value="{{ $codeArray['dial_code'] }}">{{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control inputmask-number" name="parent_mobile" placeholder="{{ __('labels.mobile') }}">
                                        </div>
                                        <label for="parent_mobile">{{ __('labels.mobile') }}</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="job" id="job" placeholder="{{ __('labels.job') }}">
                                        <label for="job">{{ __('labels.job') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="float-lg-start">{{__('labels.already_registered')}}<a href="{{route('login')}}">{{ __('labels.login') }}</a></p>
                            </div><br>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center mb-3">
                                <button type="submit" class="btn btn-primary">{{ __('labels.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script src="{{asset("js/msform.js")}}"></script>
@endpush
