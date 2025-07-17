@extends('partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <input type="hidden" id="locale" value="{{app()->getLocale()}}">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{$lesson->name}}</h1>
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
                <div class="col-md-12">
                    <div class="card card-post card-round">
                        @if($lesson->video || $lesson->drive_video)
                            <input type="hidden" id="myVideo" value="{{$lesson->id}}" data-lesson-id="{{$lesson->id}}" >
                            @if($lesson->is_expired)
                                <div style="position: relative; width: 100%; height: 400px;">
                                    <video width="100%"  data-lesson-id="{{$lesson->id}}"  height="400">
                                        <source src="" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <!-- Transparent overlay to block interactions -->
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: transparent; cursor: not-allowed;"></div>
                                </div>
                            @else
                                <div style="position:relative; width:100%; padding:56.25% 0 0 0;">
                                    <iframe src="{{ empty($lesson->drive_video) ? $lesson->video : $lesson->drive_video }}"
                                            frameborder="0"
                                            allow="autoplay; fullscreen; picture-in-picture"
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;"
                                            title="Google Drive Video"></iframe>
                                    <!-- Transparent overlay -->
                                    <div style="position:absolute;top:0;right:0;width:50px;height:50px;z-index:2;"></div>
                                </div>
                            @endif
                        @endif
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="info-post ms-2">
                                    <p class="username">name: {{$lesson->name}}</p>
                                    <span class="text-danger">{{$lesson->is_expired ? "Lesson is expired" : ""}}</span>
                                    <p class="date text-muted">Uploaded: {{$lesson->created_at}}</p>
                                </div>
                            </div>
                            <div class="separator-solid"></div>
                            <p class="card-category text-info mb-1">
                                details
                            </p>
                            <h3 class="card-title">
                                Price: {{$lesson->price}}
                            </h3>
                            <p class="card-text">
                                Description: {{$lesson->description}}
                            </p>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- About End -->
@endsection
@push('page-specific-scripts')
    <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        }, false);
        document.addEventListener('DOMContentLoaded', function () {
            const videoElement = document.querySelector('#myVideo');
            let lessonId= videoElement.getAttribute('data-lesson-id'); // Pass the lesson ID
            var locale = $('#locale').val();
            if (videoElement) {
                // videoElement.addEventListener('play', function () {
                    // Make an AJAX request to mark the video as viewed
                    fetch('/${locale}/mark-video-viewed/'+lessonId, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                // });
            }
        });

    </script>
@endpush
