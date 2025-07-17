@extends('dashboard.partials.layout')

@section('content')
    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container mt-5">
                        <h1>Quiz Results: {{ $quiz->name }}</h1>
                        <div class="card">
                            <div class="card-body">
                                @foreach($quiz->questions as $question)
                                    <div class="mb-4">
                                        <h4>{{ $loop->iteration }}. {{ $question->question }}</h4>
                                        @if ($question->image)
                                            <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-fluid" style="max-height: 300px; width: auto;">
                                        @endif
                                        <br>

                                        @if ($question->link)
                                            <a href="{{ $question->link }}" target="_blank">Related Link</a>
                                        @endif
                                        @php
                                            $correctAnswer = $question->answers ? $question->answers->where('is_correct', 1)->first() : null;
                                            $userAnswer =!empty( $attempt->answers) ? $attempt->answers->where('question_id', $question->id)->first(): null;
                                        @endphp

                                        <div class="mt-2">
                                            <strong>Correct Answer:</strong>
                                            <span class="text-success">{{ $correctAnswer->answer }}</span>
                                        </div>

                                        <div class="mt-2">
                                            <strong>Your Answer:</strong>
                                            @if($userAnswer)
                                                @if($userAnswer->id == $correctAnswer->id)
                                                    <span class="text-success">{{ $userAnswer->answer }} (Correct)</span>
                                                @else
                                                    <span class="text-danger">{{ $userAnswer->answer }} (Incorrect)</span>
                                                @endif
                                            @else
                                                <span class="text-danger">No Answer</span>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
