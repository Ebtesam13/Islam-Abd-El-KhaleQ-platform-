@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white">{{$course->name}}</h1>
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
                    <div class="card">
                        <div class="card-header">{{__('labels.add_new_lesson')}}</div>

                        <div class="card-body">
                            <form action="{{route('dashboard.lessons.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($course))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $course->name ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $course->description ?? '') }}</textarea>
                                </div>

                                <input type="hidden"  name="course_id" value="{{ $course->id }}">

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $course->price ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <input type="file" class="form-control-file" id="video" name="video">
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="image_path">Image</label>--}}
{{--                                    <input type="file" class="form-control-file" id="image_path" name="image_path">--}}
{{--                                </div>--}}

                                <div class="form-group">
                                    <label for="expiry_days">Expiry Date</label>
                                    <input type="number" class="form-control" id="expiry_days" name="expiry_days" value="{{ old('expiry_days', $course->expiry_days ?? '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="number_of_codes">Number of codes</label>
                                    <input type="number" class="form-control" id="number_of_codes" name="number_of_codes" required>
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
{{--                    <h1 class="mb-4">{{$course->name}}</h1>--}}
{{--                    <p class="mb-4">--}}
{{--                        {{$course->description}}--}}
{{--                    </p>--}}
{{--                    <div class="course-item bg-light">--}}
{{--                        <div class="text-center p-4 pb-0">--}}
{{--                            <h5 class="mb-4">{{$course->description}}</h5>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex border-top">--}}
{{--                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2">--}}
{{--                                </i>{{$course->author->name}}</small>--}}
{{--                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>--}}
{{--                                {{$course->hours}} Hrs--}}
{{--                            </small>--}}
{{--                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>--}}
{{--                                {{count($course->users)}} Students--}}
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
