@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 mb-5 page-header">
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <input type="hidden" id="locale" value="{{app()->getLocale()}}">
            <div class="col-md-12">
                @role('teacher')
                    <div class="card card-post card-round">
                        @if($lesson->video || $lesson->drive_video)
                            <div style="position:relative;padding-top:56.25%;">
                                <iframe src="{{ empty($lesson->drive_video) ? $lesson->video : $lesson->drive_video }}"
                                        loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;"
                                        allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true">
                                </iframe>
                            </div>
{{--                            <div style="position:relative; width:100%; padding:56.25% 0 0 0;">--}}
{{--                                <iframe src="{{ empty($lesson->drive_video) ? $lesson->video : str_replace('/view', '/preview', $lesson->drive_video) }}"--}}
{{--                                        frameborder="0"--}}
{{--                                        allow="autoplay; fullscreen; picture-in-picture"--}}
{{--                                        style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;"--}}
{{--                                        title=""></iframe>--}}
{{--                                <!-- Transparent overlay -->--}}
{{--                                <div style="position:absolute;top:0;right:0;width:50px;height:50px;z-index:2;"></div>--}}
{{--                            </div>--}}
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
                            <p class="card-text">
                                All codes: {{$lesson->number_of_codes}}
                                <a href="{{route('dashboard.codes.download',['lesson'=>$lesson->id])}}" class="btn btn-success btn-rounded btn-sm">download</a>
                                <br>
                                Used codes: {{$usedCodes}}
                            </p>
                            <a href="{{route('dashboard.lessons.edit',['lesson'=>$lesson->id])}}" class="btn btn-primary btn-rounded btn-sm">Edit</a>
                            <form action="{{ route('dashboard.lessons.destroy', $lesson) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-danger btn-rounded btn-sm" onclick="return confirm('Are you sure you want to delete this lesson?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endrole
                @role('student')
                    <div class="card card-post card-round">
                        @if($lesson->video || $lesson->drive_video)
                            <input type="hidden" id="myVideo" value="{{$lesson->id}}" data-lesson-id="{{$lesson->id}}">
                        @if($lesson->is_expired)
                            <div style="position: relative; width: 100%; height: 400px;">
                                <video width="100%" height="400">
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
{{--                                <p class="date text-muted">Uploaded: {{$lesson->created_at}}</p>--}}
                            </div>
                        </div>
                        <div class="separator-solid"></div>
                        <p class="card-category text-info mb-1">
                            details
                        </p>
{{--                        <h3 class="card-title">--}}
{{--                            Price: {{$lesson->price}} --}}
{{--                        </h3>--}}
                        <p class="card-text">
                            Description: {{$lesson->description}}
                        </p>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
    <!-- About End -->


@endsection

@push('page-specific-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videoElement = $('#myVideo');
            let lessonId= $('#myVideo').val(); // Pass the lesson ID
            var locale = $('#locale').val();
            if (videoElement) {
                // videoElement.addEventListener('play', function () {
                //     console.log('-------------',lessonId);
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
