@extends('dashboard.partials.layout')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">{{__('labels.welcome_to') .' '. __('labels.dashboard')}} </h6>
                </div>
            </div>
            <!-- Courses Start -->
            <div class="container-xxl py-5">
                <div class="container">
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
                    @role('teacher')
                        <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="form-floating">
                                <select class="form-select" id="select-stage" name="stage" data-select-hidden="0" aria-label="Default select example" data-tail-select="tail-1" >
                                    <option disabled selected>{{__('labels.stage')}}</option>
                                    @foreach($stages as $stage)
                                        <option value="{{$stage->id}}">{{$stage->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="units_route" value="{{route('dashboard.dashboard_units_from_course',['courseId'=>1])}}">
                            </div>
                        </div>
                        </div><br><br>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select" id="select-unit" name="unit" data-select-hidden="0" aria-label="Default select example" data-tail-select="tail-1" >
                                        <option disabled selected>{{__('labels.unit')}}</option>
                                    </select>
                                    <input type="hidden" id="lessons_route" value="{{route('dashboard.dashboard_lessons_from_unit',['unitId'=>1])}}">
                                </div>
                            </div>
                        </div><br><br>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select" id="select-lesson" name="lesson" data-select-hidden="0" aria-label="Default select example" data-tail-select="tail-1" >
                                        <option disabled selected>{{__('labels.lesson')}}</option>
                                    </select>
                                    <input type="hidden" id="homework_route" value="{{route('dashboard.dashboard_homework_from_lesson',['lessonId'=>1])}}">
                                    <input type="hidden" id="homework_show_route" value="{{route('dashboard.homework.show',['homework'=>1])}}">
                                </div>
                            </div>
                        </div><br><br>
                    @endrole
                    <div class="cred-header">{{__('labels.homework_list')}}</div>
                    <div class="card-body homework-list">
                        @role('student')
                            @if(isset($lessons))
                            @foreach($lessons as $lesson)
                                @if(!empty($lesson->homework))
                                    @foreach($lesson->homework as $homework)
                                        <div class="card card-post card-round">
                                        @if($homework->video)
{{--                                            <video width="100%" height="400" id="homework-{{$homework->id}}" controls>--}}
{{--                                                <source src="{{ asset('storage/' . $homework->video) }}" type="video/mp4">--}}
{{--                                                Your browser does not support the video tag.--}}
{{--                                            </video>--}}
                                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="{{$homework->video}}" frameborder="0"
                                                 allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
                                                 style="position:absolute;top:0;left:0;width:100%;height:100%;" title="quantum numbers lesson 3 senior 2"></iframe>
                                            </div><script src="https://player.vimeo.com/api/player.js"></script>
                                        @endif
                                            <input type="hidden" class="homework-route" value="{{ route('dashboard.homework.markAsViewed', ['homeworkId' => $homework->id])}}">

                                            <div class="card-body">
                                            <div class="d-flex">
                                                <div class="info-post ms-2">
                                                    <p class="username">name: {{$homework->name}}</p>
                                                    <p class="date text-muted">Uploaded: {{$homework->created_at}}</p>
                                                </div>
                                            </div>
                                            <div class="separator-solid"></div>
                                            <p class="card-category text-info mb-1">
                                                details
                                            </p>
                                            <p class="card-text">
                                                Description: {{$homework->description}}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        @endrole
                    </div><br><br>

                    <div class="course-item bg-light">
                        <input type="hidden" id="new_homework_input" value="{{route('dashboard.dashboard_homework.create',['id'=>0])}}">
                        <a class="btn btn-primary w-100 py-3 d-none" id="new_homework"
                           href="{{route('dashboard.dashboard_homework.create',['id'=>0])}}" type="button">
                            {{__('labels.add_new_homework')}}
                        </a>
                    </div>
                </div>
            </div>
            <!-- Courses End -->

        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script>
        $(document).ready(function(){

            // Loop through each element with the class 'homework-route'
            document.querySelectorAll('.homework-route').forEach((element) => {
                // element.addEventListener('play', function () {
                    let route = element.value;  // Get the value of the current element

                    // Send an AJAX request to mark the homework as viewed
                    fetch(route, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({})
                    }).then(response => response.json()).then(data => {
                        console.log(data);
                    }).catch(error => {
                        console.error('Error marking homework as viewed:', error);
                    });
                // });
            });

            // });
            $('#select-stage').change(function(){
                let units_route = $('#units_route').val();
                //change the id of the route
                let lastRouteSegment = /[^/]*$/.exec(units_route)[0];
                let newRoute =  units_route.replace(lastRouteSegment, this.value);
                $('#units_route').val(newRoute);
                $.ajax({
                    url: newRoute,
                    type: "get",
                    success: function(response){
                        $('#select-unit').find('option').remove();
                        $('#select-unit').append('<option selected disabled>choose</option>');
                        $.each(response, function (key, data) {
                            $('#select-unit').append('<option value="'+ data.id+'">'+ data.name +'</option>');
                        });
                    },
                    error: function(error){
                        console.log('-----err---------',error);
                    }
                });
            });
            $('#select-unit').change(function(){
                let lessons_route = $('#lessons_route').val();
                //change the id of the route
                let lastRouteSegment = /[^/]*$/.exec(lessons_route)[0];
                let newRoute =  lessons_route.replace(lastRouteSegment, this.value);
                $('#lessons_route').val(newRoute);
                $.ajax({
                    url: newRoute,
                    type: "get",
                    success: function(response){
                        $('#select-lesson').find('option').remove();
                        $('#select-lesson').append('<option selected disabled>choose</option>');
                        $.each(response, function (key, data) {
                            $('#select-lesson').append('<option value="'+ data.id+'">'+ data.name +'</option>');
                        });
                    },
                    error: function(error){
                        console.log('-----err---------',error);
                    }
                });
            });
            $('#select-lesson').change(function(){
                let homework_route = $('#homework_route').val();
                //change the id of the route
                let lastRouteSegment = /[^/]*$/.exec(homework_route)[0];
                let newRoute =  homework_route.replace(lastRouteSegment, this.value);

                let old_homework_route = $('#new_homework_input').val();
                console.log('-==-=-=-',old_homework_route);
                //change the id of the route
                let lastNewRouteSegment = /[^/]*$/.exec(old_homework_route)[0];
                console.log('-==-lastNewRouteSegment=-=-',lastNewRouteSegment);
                let new_homeworkRoute =  old_homework_route.replace(lastNewRouteSegment, this.value);
                console.log('-==-new_homeworkRoute=-=-',new_homeworkRoute);
                $('#new_homework').removeClass('d-none');
                $('#new_homework').attr('href', new_homeworkRoute);
                $.ajax({
                    url: newRoute,
                    type: "get",
                    success: function(response){
                        $.each(response, function (key, data) {
                            let homework_show_route = $('#homework_show_route').val();
                            //change the id of the route
                            let lastRouteSegment = /[^/]*$/.exec(homework_show_route)[0];
                            let newRoute =  homework_show_route.replace(lastRouteSegment, data.id);
                            $('.homework-list').append('<a class="btn btn-primary py-3 px-5 mt-2" href="' +newRoute+ '">'+ data.name + '</a><br><br>');
                        });
                    },
                    error: function(error){
                        console.log('-----err---------',error);
                    }
                });
            });

        });
    </script>
    <script src="{{asset("js/homework.js")}}"></script>
@endpush
