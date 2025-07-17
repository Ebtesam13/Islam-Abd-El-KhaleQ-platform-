@extends('dashboard.partials.layout')

@section('content')
    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit quiz: {{ $quiz->name }}</div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ request()->is('*public_quizzes*') ? route('public_quizzes.update', $quiz->id) : route('quizzes.update', $quiz->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Quiz Name</label>
                                    <input type="text" name="name" id="title" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $quiz->name) }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="time">Time (minutes)</label>
                                    <input type="number" class="form-control" value="{{ old('time', $quiz->time) }}" id="time" name="time" @error('time') "is-invalid" @enderror required>
                                    @error('time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update Quiz</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
