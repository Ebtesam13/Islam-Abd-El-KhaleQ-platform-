@extends('dashboard.partials.layout')

@section('content')
    <div class="container">
        <h2>Quiz Correction Details</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $quizCorrection->name }}</h5>
                <p class="card-text">
                    <strong>Quiz:</strong> {{ $quizCorrection->quiz->name }} <br>
                    <strong>Video:</strong>
                    @if($quizCorrection->video_path)
                        <iframe width="560" height="315" src="{{$quizCorrection->video_path}}"
                                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    @else
                        No video uploaded.
                    @endif
                </p>
                <a href="{{ route('dashboard.quiz_corrections.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
