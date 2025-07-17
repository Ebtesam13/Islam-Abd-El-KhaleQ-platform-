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
                        <div class="card-header">{{__('labels.add_new_homework')}}</div>

                        <div class="card-body">
                            <form action="{{route('dashboard.homework.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="lesson_id" value="{{$lesson_id}}">
                                {{--                                @if(isset($unit))--}}
{{--                                    @method('PUT')--}}
{{--                                @endif--}}
{{--                                <div class="col-12">--}}
{{--                                    <div class="user-type">--}}
{{--                                        <label for="lesson">{{__('labels.lesson')}} *</label><br>--}}
{{--                                        <select class="form-select" name="lesson" id="lesson" aria-label="Default select example" required>--}}
{{--                                            <option value="" disabled selected>{{__('labels.select')}}</option>--}}
{{--                                            @foreach($lessons as $lesson)--}}
{{--                                                <option value="{{$lesson->id}}" {{ old('lesson') === $lesson ? 'selected' : ''}}>{{ucfirst($lesson->name)}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="video">Video</label>
                                    <textarea class="form-control" id="video" name="video" rows="3" required>{{ old('video') }}</textarea>
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
