@extends('dashboard.partials.layout')

@section('content')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Students' scores
                </div>

                <div class="card-body">
                    <!-- Success Alert -->
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
                    <!-- Quiz Cards -->
                    <div class="row">
                        @foreach($students as $student)
                            @if(!empty($student->quizAttempts))
                                @foreach($student->quizAttempts as $quizAttempt)
                                    <div class="col-md-4">
                                        <div class="card card-primary card-round">
                                            <div class="card-header">
                                                <div class="card-head-row">
                                                    <div class="card-title">{{$student->name}}</div>
                                                    <div class="card-tools">

                                                    </div>
                                                </div>
                                                <div class="card-category">Completed at: {{$quizAttempt->completed_at}}</div>
                                            </div>
                                            <div class="card-body pb-0">
                                                <div class="mb-4 mt-2">
                                                    <h1>{{$quizAttempt->score .'/'.$quizAttempt->full_mark}}</h1>
                                                </div>
                                                <div class="pull-in">
                                                    <canvas id="dailySalesChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                <div class="card card-round">--}}
                                        {{--                                    <div class="card-body pb-0">--}}
                                        {{--                                        <div class="h1 fw-bold float-end text-primary">+5%</div>--}}
                                        {{--                                        <h2 class="mb-2">17</h2>--}}
                                        {{--                                        <p class="text-muted">Users online</p>--}}
                                        {{--                                        <div class="pull-in sparkline-fix">--}}
                                        {{--                                            <div id="lineChart"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

       </div>
@endsection
