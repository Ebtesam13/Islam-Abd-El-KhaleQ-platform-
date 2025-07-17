@extends('partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{$course->name}}</h1>
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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
{{--                    <nav aria-label="breadcrumb">--}}
{{--                        <ol class="breadcrumb justify-content-center">--}}
{{--                            <li class="breadcrumb-item"><a class="text-white" href="#">Courses</a></li>--}}
{{--                            <li class="breadcrumb-item"><a class="text-white" href="#">{{$course->category->name}}</a></li>--}}
{{--                            <li class="breadcrumb-item text-white active" aria-current="page">{{$course->name}}</li>--}}
{{--                        </ol>--}}
{{--                    </nav>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
                <input type="hidden" id="locale" value="{{app()->getLocale()}}">
                <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src=" {{ asset($course->image_path)}} " alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About The Course</h6>
                    <h1 class="mb-4">{{$course->name}}</h1>
                    <p class="mb-4">
                        {{$course->description}}
                    </p>
                    <div class="course-item bg-light">
                        <div class="text-center p-4 pb-0">
{{--                            <h3 class="mb-0">${{$course->price}}</h3>--}}
{{--                            <div class="mb-3">--}}
{{--                                @for($i = 0 ; $i <$course->total_rate ; $i++)--}}
{{--                                    <small class="fa fa-star text-primary"></small>--}}
{{--                                @endfor--}}
{{--                                @for($i = 4 - $course->total_rate ; $i >0 ; $i--)--}}
{{--                                    <small class="fa fa-star text-muted"></small>--}}
{{--                                @endfor--}}
{{--                                <small>({{count($course->rates)}})</small>--}}
{{--                            </div>--}}
                            <h5 class="mb-4">{{$course->description}}</h5>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">
{{--                                </i>{{$course->author->name}}</small>--}}
                                </i>{{config('app.app_author')}}</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>
                                {{$course->hours}} Hrs
                            </small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>
                                {{count($course->units)}} {{__('labels.units')}}
                            </small>
                        </div>
                    </div>
                    <h2 class="my-4">Units and Lessons</h2>

                    @if($course->units->isEmpty())
                        <p class="text-muted">No lessons available for this unit.</p>
                    @endif
                    <div class="accordion" id="unitsAccordion">
                        @foreach($units as $unit)
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="heading{{ $unit->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $unit->id }}" aria-expanded="false" aria-controls="collapse{{ $unit->id }}">
                                        {{ $unit->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $unit->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $unit->id }}" data-bs-parent="#unitsAccordion">
                                    <div class="accordion-body">
                                        <p class="text-muted">{{ $unit->description }}</p>

                                        @if($unit->lessons->isEmpty())
                                            <p class="text-muted">No lessons available for this unit.</p>
                                        @else
                                            <ul class="list-group list-group-flush">
                                                @foreach($unit->lessons as $lesson)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6>{{ $lesson->name }}</h6>
                                                            <p class="mb-1">{{ $lesson->description }}</p>
                                                            <small class="text-muted">Duration: {{ $lesson->duration }} minutes</small>
                                                            <p class="mb-1 text-danger">Price: {{ $lesson->price }}</p>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#accessLessonModal"
                                                            data-lesson-id="{{ $lesson->id }}">
                                                            View Lesson
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row g-5">
            </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Modal -->
    <div class="modal fade" id="accessLessonModal" tabindex="-1" aria-labelledby="accessLessonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessLessonModalLabel">Enter Code to Access Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="accessLessonForm" method="POST" action="{{route('validate.code')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="codeInput" class="form-label">Enter Code</label>
                            <input type="text" name="code" class="form-control" id="codeInput" required>
                            <input type="hidden" id="lessonId" name="lesson_id">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div id="error-message" class="text-danger mt-3" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page-specific-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var accessLessonModal = document.getElementById('accessLessonModal');
            var codeInput = document.getElementById('codeInput');
            var lessonIdInput = document.getElementById('lessonId');
            var errorMessage = document.getElementById('error-message');

            accessLessonModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var lessonId = button.getAttribute('data-lesson-id');
                lessonIdInput.value = lessonId;
            });
        });
    </script>
@endpush
