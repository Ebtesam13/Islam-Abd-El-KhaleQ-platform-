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
                            <h2 class="my-4">Booklet Details</h2>
                        </div>

                        <div class="card-body">
                            <h4 class="card-title">{{ $booklet->name }}</h4>
                            <p><strong>Number of Codes:</strong> {{ $booklet->number_of_codes }}</p>
                            <p><strong>Quiz:</strong> {{ $booklet->quiz->name ?? 'N/A' }}</p>
                            <p><strong>PDF File:</strong> <a href="{{ Storage::url($booklet->file_path) }}" target="_blank">View PDF</a></p>

                            <h5>Codes:</h5>
                            <ul>
                                @foreach($booklet->bookletCodes as $code)
                                    <li>{{ $code->code }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
