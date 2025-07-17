@extends('dashboard.partials.layout')

@section('content')

    <!-- Header Start -->
    <div class="container-fluid mt-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    {{--                    <h1 class="display-3 text-dark">{{$unit->name}}</h1>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
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
                            <h2 class="my-4">Create New Booklet</h2>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('dashboard.booklets.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="number_of_codes">Number of Codes</label>
                                    <input type="number" name="number_of_codes" id="number_of_codes" class="form-control" value="{{ old('number_of_codes') }}" required>
                                    @error('number_of_codes')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="file_path">PDF File</label>
                                    <input type="file" name="file_path" id="file_path" class="form-control" accept="application/pdf" required>
                                    @error('file_path')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="quiz_id">Select Quiz</label>
                                    <select name="quiz_id" id="quiz_id" class="form-control" required>
                                        <option value="">Select a Quiz</option>
                                        @foreach($quizzes as $quiz)
                                            <option value="{{ $quiz->id }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('quiz_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Create Booklet</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
