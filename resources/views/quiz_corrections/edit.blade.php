@extends('dashboard.partials.layout')

@section('content')
    <div class="container">
        <h2>Edit Quiz Correction</h2>@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.quiz_corrections.update', $quizCorrection->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="quiz_id">Select Quiz</label>
                <select class="form-control" id="quiz_id" name="quiz_id" required>
                    @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}" {{ $quizCorrection->quiz_id == $quiz->id ? 'selected' : '' }}>
                            {{ $quiz->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $quizCorrection->name) }}" required>
            </div>

            <div class="form-group">
                <label for="video_path"> Video embed link</label>
                <textarea type="text" class="form-control" id="video_path" name="video_path">{{$quizCorrection->video_path}}</textarea>
                @if($quizCorrection->video_path)
                    <small>Current Video: </small>
                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="{{$quizCorrection->video_path}}"
                         frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
                         style="position:absolute;top:0;left:0;width:20%;height:20%;" title="{{$quizCorrection->name}}"></iframe>
                    </div><script src="https://player.vimeo.com/api/player.js"></script>

                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Correction</button>
            <a href="{{ route('dashboard.quiz_corrections.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
