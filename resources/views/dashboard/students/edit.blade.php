@extends('dashboard.partials.layout')

@section('content')
    <!-- About Start -->
    <div class="container">
        <div class="page-inner">
            <div class="row justify-content-center">
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
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Edit Student') }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">{{__('name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required autofocus autocomplete="name" >
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="email">{{__('email')}}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required  autocomplete="username" >
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="mobile">{{ __('labels.mobile') }}</label>
                            <div class="input-group mb-3">
                                <select name="mobile_country_code" class="form-select">
                                    <option value="+20">+20</option>
                                    @foreach(config('country_codes') as $codeArray)
                                        <option value="{{ $codeArray['dial_code'] }}" {{ $codeArray['dial_code'] ==  $student->mobile_country_code ? "selected" :""}}>
                                            {{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control inputmask-number" name="mobile" value="{{$student->mobile}}" placeholder="{{ __('labels.mobile') }}">
                            </div>
                        </div>
                        @error('mobile')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="school">{{ __('labels.school') }}</label>
                            <input type="text" class="form-control" name="school" id="school" value="{{$student->school}}" placeholder="{{ __('labels.school') }}">
                        </div>
                        @error('school')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="senior_year">{{ __('labels.senior_year') }}</label>
                            <select class="form-select" name="senior_year" id="senior_year">
                                <option value="{{ \Carbon\Carbon::parse(date('Y'))->format('Y') }}" {{$student->senior_year== \Carbon\Carbon::parse(date('Y'))->format('Y') ? "selected" : ""}}>
                                    {{ \Carbon\Carbon::parse(date('Y'))->format('Y') }}
                                </option>
                                <option value="{{ \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') }}"  {{$student->senior_year== \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') ? "selected" : ""}}>
                                    {{ \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') }}
                                </option>
                            </select>
                        </div>
                        @error('senior_year')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

        {{--                <div class="form-group">--}}
        {{--                    <label for="current_stage">{{ __('labels.current_stage') }}</label>--}}
        {{--                    <select class="form-select" name="current_stage" id="current_stage">--}}
        {{--                        <option disabled selected>{{ __('labels.current_stage') }}</option>--}}
        {{--                        @foreach($stages as $currentStage)--}}
        {{--                            <option value="{{ $currentStage->id }}"  {{$student->current_stage== $currentStage->id  ? "selected" : ""}}>--}}
        {{--                                {{ ucfirst($currentStage->name) }}--}}
        {{--                            </option>--}}
        {{--                        @endforeach--}}
        {{--                    </select>--}}
        {{--                </div>--}}
        {{--                @error('current_stage')--}}
        {{--                <div class="text-danger">{{ $message }}</div>--}}
        {{--                @enderror--}}
                        <div class="form-group">
                            <label for="mom_whats_app">{{ __('labels.mom_whats_app') }}</label>
                            <input type="text" value="{{$student->mom_whats_app}}" class="form-control inputmask-number" name="mom_whats_app" placeholder="{{ __('labels.mom_whats_app') }}">
                        </div>
                        @error('mom_whats_app')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="dad_whats_app">{{ __('labels.dad_whats_app') }}</label>
                            <input type="text" value="{{$student->dad_whats_app}}" class="form-control inputmask-number" name="dad_whats_app" placeholder="{{ __('labels.dad_whats_app') }}">
                        </div>
                        @error('dad_whats_app')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="identity_number">{{ __('labels.identity_number') }}</label>
                            <input type="text" value="{{$student->identity_number}}" class="form-control" name="identity_number" id="identity_number" placeholder="{{ __('labels.identity_number') }}">
                        </div>
                        @error('identity_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="dad_job">{{ __('labels.dad_job') }}</label>
                            <input type="text" class="form-control" name="dad_job" value="{{$student->dad_job}}" id="dad_job" placeholder="{{ __('labels.dad_job') }}">
                        </div>
                        @error('dad_job')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">{{ __('Update student') }}</button>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
