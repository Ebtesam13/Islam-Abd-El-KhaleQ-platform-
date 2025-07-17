@extends('dashboard.partials.layout')

@section('content')
    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ $quiz->name }}</div>

                        <div class="card-body">
                            <p>Time allowed: {{ $quiz->time }} minutes</p>

                            @if ($quiz->questions->count() > 0)
                                <h3>Questions:</h3>
                                @foreach ($quiz->questions as $question)
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <!-- Question -->
                                            <h5 class="card-title">Question</h5>
                                            <p class="card-text">{{ $question->question }}</p>

                                            <!-- Image -->
                                            @if ($question->image)
                                                <div class="mb-3">
                                                    <h6>Image:</h6>
                                                    <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-fluid">
                                                </div>
                                            @endif

                                        <!-- Link -->
                                            @if ($question->link)
                                                <div class="mb-3">
                                                    <h6>Related Link:</h6>
                                                    <a href="{{ $question->link }}" target="_blank" class="btn btn-info">Open Link</a>
                                                </div>
                                            @endif

                                        <!-- Answers -->
                                            <div>
                                                <h6>Answers:</h6>
                                                <ul class="list-group">
{{--                                                    {{dd($question)}}--}}
                                                    @foreach ($question->answers as $answer)
                                                        <li class="list-group-item">
                                                            {{ $answer->answer }}
                                                            @if($answer->is_correct)
                                                                <span class="badge bg-success float-end">Correct</span>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <a href="{{ route('questions.edit', [$quiz->id, $question->id]) }}" class="btn btn-primary mt-2">Edit Question</a>
                                            <form action="{{ route('questions.destroy', [$quiz->id, $question->id]) }}" method="POST" class="mt-2" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Question</button>
                                            </form>

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No questions available for this quiz.</p>
                            @endif

                            <a href="{{ request()->is('*public_quizzes*') ? route('public_questions.create', ['quiz'=>$quiz])  : route('questions.create', $quiz) }}" class="btn btn-primary mt-3">Add Question</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
