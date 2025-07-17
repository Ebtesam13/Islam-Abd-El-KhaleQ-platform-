@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid mt-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h5 class="display-3 text-dark">lesson name: {{$homework->lesson->name}}</h5>
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
                        <div class="card-header">{{__('labels.edit_homework')}}</div>
                        @if($homework->video)
{{--                            <video width="100%" height="400" controls>--}}
{{--                                <source src="{{ asset('storage/' . $homework->video) }}" type="video/mp4">--}}
{{--                                Your browser does not support the video tag.--}}
{{--                            </video>--}}
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="{{$homework->video}}" frameborder="0"
                                 allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
                                 style="position:absolute;top:0;left:0;width:100%;height:100%;" title="quantum numbers lesson 3 senior 2"></iframe>
                            </div><script src="https://player.vimeo.com/api/player.js"></script>
                        @endif
                        <div class="card-body">
                            <form action="{{route('dashboard.homework.update',['homework'=>$homework->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $homework->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $homework->name}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <textarea class="form-control" id="video" name="video" rows="3" required>{{ $homework->video }}</textarea>
                                </div>

                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="image_path">Image</label>--}}
                                {{--                                    <input type="file" class="form-control-file" id="image_path" name="image_path">--}}
                                {{--                                </div>--}}

                                <button type="submit" class="btn btn-primary">{{__('labels.save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


@endsection
