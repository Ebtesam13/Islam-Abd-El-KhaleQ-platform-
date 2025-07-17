@extends('dashboard.partials.layout')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <!-- <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">{{__('labels.welcome_to') .' '. __('labels.dashboard')}} </h6>
                </div> -->
            </div>
            <!-- Courses Start -->
            <div class="container-xxl bg-white rounded-24 mb-2 pb-4">
                <div class="container">
                    <div class="d-flex justify-content-end p-4">
                        <!-- {{ route('dashboard.courses.create') }} -->
                        <a href="" class="btn btn-outline-main rounded-pill">
                            <i class="fa fa-plus"></i> {{ __('labels.add_new_course') }}
                        </a>
                    </div>

                    <div class="row gx-4 g-20 gy-4 justify-content-center">
                        @foreach($courses as $index=>$course)
                        <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                                    <div class="course-item" style="box-sizing: border-box; border: 1px solid gray; border-radius:10px;overflow: hidden;">
                                        <!-- image -->
                                        <div class="position-relative overflow-hidden">
                                            <img class="img-fluid rounded-top" style="max-height: 180px; object-fit: cover; width: 100%;" src="{{ asset($course->image_path) }}" alt="">
                                            <!-- <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                                <a href="{{route('dashboard.courses.show',['course'=>$course->id])}}" class="flex-shrink-0 btn  btn-primary px-3"
                                                style="border-radius: 30px;">{{__('labels.show')}}</a>
                                            </div> -->
                                        </div>
                                        <!-- text -->
                                        <div class="text-start p-4 pb-0">
                                            <h3 class="mb-0" style="color: var(--primary-600);">{{ $course->name }}</h3>
                                            <p class="mb-4">{{ substr($course->description, 0, 90) }}</p>
                                        </div>
                                        <hr>
                                        <!-- data -->
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie me-2"  style="color: var(--primary-600);"></i>{{ config('app.app_author') }}</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock  me-2"  style="color: var(--primary-600);"></i>{{ __('labels.hrs') }} {{ $course->hours }}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-th-list me-2"  style="color: var(--primary-600);"></i>{{ count($course->units) }} {{ __('labels.units') }}</small>
                                        </div>
                                        <hr>
                                        <!-- action -->
                                        <div class="d-flex justify-content-around py-3 px-2">
                                            <a href="{{ route('dashboard.courses.show', ['course' => $course->id]) }}" class="btn btn-outline-main rounded-pill py-9">
                                                <i class="fa fa-eye"></i> 
                                                {{ __('labels.show') }}
                                            </a>
                                            <!-- {{ route('dashboard.courses.edit', ['course' => $course->id]) }} -->
                                            <a href="" class="btn  btn-outline-warning rounded-pill py-9">
                                                <i class="fa fa-edit"></i> 
                                                {{ __('labels.edit') }}
                                            </a>
                                            <!-- {{ route('dashboard.courses.destroy', ['course' => $course->id]) }} -->
                                            <!-- return confirm('{{ __('labels.confirm_delete') }}'); -->
                                            <form action="" method="POST" onsubmit="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn  btn-outline-danger rounded-pill py-9">
                                                    <i class="fa fa-trash"></i> 
                                                    {{ __('labels.delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
            <!-- Courses End -->

        </div>
    </div>
@endsection
