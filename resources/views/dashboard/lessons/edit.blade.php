@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid mt-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-dark">{{$lesson->unit->name}}</h1>
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
                    <div class="card">
                        <div class="card-header">{{__('labels.edit_lesson')}}</div>

                        <div class="card-body">
                            <form action="{{route('dashboard.lessons.update',['lesson'=>$lesson])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $lesson->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $lesson->description }}</textarea>
                                </div>

                                <input type="hidden"  name="unit_id" value="{{ $lesson->unit->id }}">

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $lesson->price }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <textarea class="form-control" id="video" name="video" rows="3" required>{{ $lesson->video }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="drive_video">Drive Video</label>
                                    <textarea class="form-control" id="drive_video" name="drive_video" rows="3" required>{{ $lesson->drive_video }}</textarea>
                                </div>
                                @if($lesson->video || $lesson->drive_video)
                                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="{{ empty($lesson->drive_video) ? $lesson->video :
                                        str_replace('/view', '/preview', $lesson->drive_video) }}" frameborder="0"
                                                                                                 allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="quantum numbers lesson 3 senior 2"></iframe>
                                    </div><script src="https://player.vimeo.com/api/player.js"></script>
                                @endif
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="image_path">Image</label>--}}
                                {{--                                    <input type="file" class="form-control-file" id="image_path" name="image_path">--}}
                                {{--                                </div>--}}

                                <div class="form-group">
                                    <label for="expiry_days">Expiry Date</label>
                                    <input type="number" class="form-control" id="expiry_days" name="expiry_days" value="{{ $lesson->expiry_days }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="number_of_codes">Number of codes</label>
                                    <input type="number" class="form-control" id="number_of_codes" value="{{ $lesson->number_of_codes }}" name="number_of_codes" required>
                                </div>

                                <button type="submit" class="btn btn-primary">{{__('labels.save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row g-5">--}}
{{--                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">--}}
{{--                    <div class="position-relative h-100">--}}
{{--                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset("img/about.jpg")}}" alt="" style="object-fit: cover;">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">--}}
{{--                    <h6 class="section-title bg-white text-start text-primary pe-3">About The Course</h6>--}}
{{--                    <h1 class="mb-4">{{$unit->name}}</h1>--}}
{{--                    <p class="mb-4">--}}
{{--                        {{$unit->description}}--}}
{{--                    </p>--}}
{{--                    <div class="course-item bg-light">--}}
{{--                        <div class="text-center p-4 pb-0">--}}
{{--                            <h5 class="mb-4">{{$unit->description}}</h5>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex border-top">--}}
{{--                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">--}}
{{--                                </i>{{$unit->author->name}}</small>--}}
{{--                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>--}}
{{--                                {{$unit->hours}} Hrs--}}
{{--                            </small>--}}
{{--                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>--}}
{{--                                {{count($unit->users)}} Students--}}
{{--                            </small>--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                        <a class="btn btn-primary w-100 py-3" href="#" type="button">{{__('labels.add_new_lesson')}}</a>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <!-- About End -->


@endsection
