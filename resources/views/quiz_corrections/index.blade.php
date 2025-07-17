@extends('dashboard.partials.layout')

@section('content')
    <div class="container-fluid mt-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    {{-- <h1 class="display-3 text-dark">{{$unit->name}}</h1> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                            <div class="row">
                                <div class="col">
                                    <h1>Quiz Corrections</h1>
                                </div>
                                <div class="col">
                                    @role('teacher')
                                    <a href="{{ route('dashboard.quiz_corrections.create') }}" class="btn btn-primary mb-3">Add New Correction</a>
                                    @endrole
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($corrections as $correction)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $correction->name }}</h5>
                                            <p class="card-text"><strong>Quiz:</strong> {{ $correction->quiz ? $correction->quiz->name : "" }}</p>
                                            <p class="card-text">
                                                <strong>Video:</strong><br>
                                            @if($correction->video_path)
                                                <div style="padding:56.25% 0 0 0;position:relative;">
                                                    <iframe src="{{ $correction->video_path }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="{{ $correction->name }}"></iframe>
                                                </div>
                                                <script src="https://player.vimeo.com/api/player.js"></script>
                                            @else
                                                No video available
                                                @endif
                                                </p>

                                                @role('teacher')
                                                <div class="card-footer">
                                                    <a href="{{ route('dashboard.quiz_corrections.edit', $correction) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('dashboard.quiz_corrections.destroy', $correction) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                                @endrole
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
