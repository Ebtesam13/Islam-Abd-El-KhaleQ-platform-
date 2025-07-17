@extends('dashboard.partials.layout')

@section('content')
    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Quiz</div>

                        <div class="card-body">
                            <form action="{{ request()->is('*public_quizzes*') ? route('public_quizzes.store') : route('quizzes.store') }}" method="POST">
                                @csrf
                                @if(!request()->is('*public_quizzes*'))
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="select-stage" name="stage" data-select-hidden="0" aria-label="Default select example" data-tail-select="tail-1" >
                                                    <option disabled selected>{{__('labels.stage')}}</option>
                                                    @foreach($stages as $stage)
                                                        <option value="{{$stage->id}}">{{$stage->name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="units_route" value="{{route('dashboard.dashboard_units_from_course',['courseId'=>1])}}">
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="select-unit" name="unit" data-select-hidden="0" aria-label="Default select example" data-tail-select="tail-1" >
                                                    <option disabled selected>{{__('labels.unit')}}</option>
                                                </select>
                                                <input type="hidden" id="lessons_route" value="{{route('dashboard.dashboard_lessons_from_unit',['unitId'=>1])}}">
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="select-lesson" data-select-hidden="0" aria-label="Default select example" data-tail-select="tail-1" >
                                                    <option disabled selected>{{__('labels.lesson')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><br><br>
                                @endif
                                <input type="hidden" id="lesson_id"  name="lesson_id">

                                <div class="form-group">
                                    <label for="name">Quiz Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="time">Time (minutes)</label>
                                    <input type="number" class="form-control" id="time" name="time" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Quiz</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-specific-scripts')
    <script>
        $('#select-stage').change(function(){
            let units_route = $('#units_route').val();
            //change the id of the route
            let lastRouteSegment = /[^/]*$/.exec(units_route)[0];
            let newRoute =  units_route.replace(lastRouteSegment, this.value);
            $('#units_route').val(newRoute);
            $.ajax({
                url: newRoute,
                type: "get",
                success: function(response){
                    $('#select-unit').find('option').remove();
                    $('#select-unit').append('<option selected disabled>choose</option>');
                    $.each(response, function (key, data) {
                        $('#select-unit').append('<option value="'+ data.id+'">'+ data.name +'</option>');
                    });
                },
                error: function(error){
                    console.log('-----err---------',error);
                }
            });
        });
        $('#select-unit').change(function(){
            let lessons_route = $('#lessons_route').val();
            //change the id of the route
            let lastRouteSegment = /[^/]*$/.exec(lessons_route)[0];
            let newRoute =  lessons_route.replace(lastRouteSegment, this.value);
            $('#lessons_route').val(newRoute);
            $.ajax({
                url: newRoute,
                type: "get",
                success: function(response){
                    $('#select-lesson').find('option').remove();
                    $('#select-lesson').append('<option selected disabled>choose</option>');
                    $.each(response, function (key, data) {
                        $('#select-lesson').append('<option value="'+ data.id+'">'+ data.name +'</option>');
                    });
                },
                error: function(error){
                    console.log('-----err---------',error);
                }
            });
        });
        $('#select-lesson').change(function(){
            console.log($('#select-lesson').find(":selected").val());
            let valu = $('#select-lesson').find(":selected").val();
            $("#lesson_id").val(valu)

        });
    </script>
@endpush
