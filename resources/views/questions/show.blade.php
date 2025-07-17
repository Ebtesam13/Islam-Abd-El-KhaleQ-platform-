@extends('dashboard.partials.layout')

@section('content')
    <div class="container">
        <h1>{{ $quiz->name }}</h1>
        <p>Time allowed: {{ $quiz->time }} minutes</p>

        @foreach ($quiz->questions as $question)
            <div class="question">
                <p>{{ $question->question }}</p>
                @if ($question->image)
                    <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image">
                @endif
                @if ($question->link)
                    <a href="{{ $question->link }}" target="_blank">Related Link</a>
                @endif
                <ul>
                    @foreach ($question->answers as $answer)
                        <li>{{ $answer->answer }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <a href="{{ route('questions.create', $quiz) }}" class="btn btn-primary">Add Question</a>

    </div>
@endsection
