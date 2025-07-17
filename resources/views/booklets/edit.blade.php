@extends('dashboard.partials.layout')

@section('content')
    <div class="container">
        <h2 class="my-4">Edit Booklet</h2>

        <form action="{{ route('dashboard.booklets.update', $booklet) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $booklet->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="number_of_codes">Number of Codes</label>
                <input type="number" name="number_of_codes" id="number_of_codes" class="form-control" value="{{ old('number_of_codes', $booklet->number_of_codes) }}" required>
                @error('number_of_codes')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="file_path">PDF File</label>
                <input type="file" name="file_path" id="file_path" class="form-control" accept="application/pdf">
                <small>Current File: <a href="{{ Storage::url($booklet->file_path) }}" target="_blank">View PDF</a></small>
                @error('file_path')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quiz_id">Select Quiz</label>
                <select name="quiz_id" id="quiz_id" class="form-control" required>
                    @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}" {{ old('quiz_id', $booklet->quiz_id) == $quiz->id ? 'selected' : '' }}>{{ $quiz->name }}</option>
                    @endforeach
                </select>
                @error('quiz_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Booklet</button>
        </form>
    </div>
@endsection
