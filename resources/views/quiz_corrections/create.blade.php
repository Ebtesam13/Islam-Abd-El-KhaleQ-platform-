@extends('dashboard.partials.layout')

@section('content')
    <div class="container-fluid mt-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    {{--                    <h1 class="display-3 text-dark">{{$name}}</h1>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
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
                    <div class="card">
                    <div class="card-header">
                        <h2>Create Quiz Correction</h2>
                    </div>
                    <form action="{{ route('dashboard.quiz_corrections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="quiz_id">Select Quiz</label>
                <select class="form-control" id="quiz_id" name="quiz_id" required>
                    <option value="">Choose a quiz...</option>
                    @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="video_path">Video embed link</label>
                <textarea type="text" class="form-control" id="video_path" name="video_path"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Correction</button>
            <a href="{{ route('dashboard.quiz_corrections.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
