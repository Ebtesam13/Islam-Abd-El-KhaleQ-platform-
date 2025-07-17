<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <input type="hidden" id="areas_route" value="{{route('areas',['cityId'=>1])}}">
            <div class="form-group">
                <label for="name">{{__('name')}}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" >
            </div>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="email">{{__('email')}}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required  autocomplete="username" >
            </div>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror

        @hasanyrole('teacher|admin')
            <div class="form-group">
                <label for="mobile">{{ __('labels.mobile') }}</label>
                <div class="input-group mb-3">
                    <select name="mobile_country_code" class="form-select">
                        <option value="+20">+20</option>
                        @foreach(config('country_codes') as $codeArray)
                            <option value="{{ $codeArray['dial_code'] }}" {{ $codeArray['dial_code'] ==  $user->mobile_country_code ? "selected" :""}}>
                                {{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control inputmask-number" name="mobile" value="{{$user->mobile}}" placeholder="{{ __('labels.mobile') }}">
                </div>
            </div>
            @error('mobile')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            @endrole

        <div class="mb-3">
            <label for="image_path" class="form-label">Upload Profile Image</label>
            <input type="file" name="image_path" id="image_path" class="form-control">
        </div>
        <!-- Preview Image -->
        <div class="mb-3">
            <img id="profile_image_preview" src="{{ $user->image_path ? asset('storage/' . $user->image_path) : asset('images/default-profile.png') }}"
                 alt="Profile Preview"
                 class="img-thumbnail"
                 width="150">
        </div>

            <div class="form-group">
                <label for="senior_year">{{ __('labels.senior_year') }}</label>
                <select class="form-select" name="senior_year" id="senior_year">
                    <option value="{{ \Carbon\Carbon::parse(date('Y'))->format('Y') }}" {{$user->senior_year== \Carbon\Carbon::parse(date('Y'))->format('Y') ? "selected" : ""}}>
                        {{ \Carbon\Carbon::parse(date('Y'))->format('Y') }}
                    </option>
                    <option value="{{ \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') }}"  {{$user->senior_year== \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') ? "selected" : ""}}>
                        {{ \Carbon\Carbon::parse(date('Y'))->addYear()->format('Y') }}
                    </option>
                </select>
            </div>
            @error('senior_year')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="current_stage">{{ __('labels.current_stage') }}</label>
                <select class="form-select" name="current_stage" id="current_stage">
                    <option disabled selected>{{ __('labels.current_stage') }}</option>
                    @foreach($stages as $currentStage)
                        <option value="{{ $currentStage->id }}"  {{$user->current_stage== $currentStage->id  ? "selected" : ""}}>
                            {{ ucfirst($currentStage->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('current_stage')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="select-city">{{ __('labels.city') }}</label>
                <select class="form-select" id="select-city" name="city_id">
                    <option disabled>{{ __('labels.city') }}</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{$user->city_id == $city->id  ? "selected" : ""}}>
                            {{ ucfirst($city->city_name_ar) . ' - ' . $city->city_name_en }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('city_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="select-area">{{ __('labels.area') }}</label>
                <select class="form-select" id="select-area" name="area_id">
                    <option selected disabled>{{ __('labels.area') }}</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{$user->area_id == $area->id  ? "selected" : ""}}>
                            {{ ucfirst($area->area_name_ar) . ' - ' . $area->area_name_en }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('area_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            @role('student')
                <div class="form-group">
                    <label for="mobile">{{ __('labels.mobile') }}</label>
                    <div class="input-group mb-3">
                        <select name="mobile_country_code" class="form-select">
                            <option value="+20">+20</option>
                            @foreach(config('country_codes') as $codeArray)
                                <option value="{{ $codeArray['dial_code'] }}" {{ $codeArray['dial_code'] ==  $user->mobile_country_code ? "selected" :""}}>
                                    {{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control inputmask-number" name="mobile" value="{{$user->mobile}}" placeholder="{{ __('labels.mobile') }}">
                    </div>
                </div>
                @error('mobile')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="school">{{ __('labels.school') }}</label>
                    <input type="text" class="form-control" name="school" id="school" value="{{$user->school}}" placeholder="{{ __('labels.school') }}">
                </div>
                @error('school')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="mom_whats_app">{{ __('labels.mom_whats_app') }}</label>
                    <input type="text" value="{{$user->mom_whats_app}}" class="form-control inputmask-number" name="mom_whats_app" placeholder="{{ __('labels.mom_whats_app') }}">
                </div>
                @error('mom_whats_app')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="dad_whats_app">{{ __('labels.dad_whats_app') }}</label>
                    <input type="text" value="{{$user->dad_whats_app}}" class="form-control inputmask-number" name="dad_whats_app" placeholder="{{ __('labels.dad_whats_app') }}">
                </div>
                @error('dad_whats_app')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="identity_number">{{ __('labels.identity_number') }}</label>
                    <input type="text" value="{{$user->identity_number}}" class="form-control" name="identity_number" id="identity_number" placeholder="{{ __('labels.identity_number') }}">
                </div>
                @error('identity_number')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="dad_job">{{ __('labels.dad_job') }}</label>
                    <input type="text" class="form-control" name="dad_job" value="{{$user->dad_job}}" id="dad_job" placeholder="{{ __('labels.dad_job') }}">
                </div>
                @error('dad_job')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @endrole

            @role('parent')
                <div class="form-group">
                    <label for="mobile">{{ __('labels.mobile') }}</label>
                    <div class="input-group mb-3">
                        <select name="mobile_country_code" class="form-select">
                            <option value="+20">+20</option>
                            @foreach(config('country_codes') as $codeArray)
                                <option value="{{ $codeArray['dial_code'] }}" {{ $codeArray['dial_code'] ==  $user->mobile_country_code ? "selected" :""}}>
                                    {{ $codeArray['name'] . ' ' . $codeArray['dial_code'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control inputmask-number" name="parent_mobile" value="{{$user->mobile}}" placeholder="{{ __('labels.mobile') }}">
                    </div>
                </div>
                @error('mobile')
                <div class="text-danger">{{ $message }}</div>
                @enderror


                <div class="form-group">
                    <label for="job">{{ __('labels.job') }}</label>
                    <input type="text" class="form-control" value="{{$user->job}}" name="job" id="job" placeholder="{{ __('labels.job') }}">
                </div>
                @error('dad_job')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @endrole
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

@push('page-specific-scripts')
    <script>
        $('#select-city').change(function(){
            let areasRoute = $('#areas_route').val();
            //change the id of the route
            let lastRouteSegment = /[^/]*$/.exec(areasRoute)[0];
            let newRoute =  areasRoute.replace(lastRouteSegment, this.value);
            $('#areas_route').val(newRoute);
            $.ajax({
                url: newRoute,
                data: {
                    "value": $("#artist").val()
                },
                type: "get",
                success: function(response){
                    $('#select-area').find('option').remove();
                    $('#select-area').append('<option selected disabled>choose</option>');
                    $.each(response, function (key, data) {
                        $('#select-area').append('<option value="'+ data.id+'">'+ data.area_name_ar +' - '+ data.area_name_en +'</option>');
                    });
                },
                error: function(error){
                    console.log('-----err---------',error);
                }
            });
        });
    </script>
@endpush
