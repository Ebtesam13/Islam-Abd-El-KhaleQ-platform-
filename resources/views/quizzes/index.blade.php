@extends('dashboard.partials.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Available quizzes
                <!-- Add New Quiz Button -->
                @role('teacher')
                <a href="{{ route('quizzes.create') }}" class="btn btn-primary float-right">Create New Quiz</a>
                @endrole
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
                    @foreach($quizzes as $quiz)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if($quiz->image)
                                    <img src="{{ asset('storage/' . $quiz->image) }}" class="card-img-top" alt="{{ $quiz->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $quiz->name }}</h5>
                                    <p class="card-text"><strong>Time:</strong> {{ $quiz->time }} minutes</p>
                                    @role('student')
                                        @php
                                            $score =0;
                                            if(!empty($quiz->quizAttempts)){
                                                foreach ($quiz->quizAttempts as $attempt){
                                                    if ($attempt['quiz_id'] == $quiz->id && $attempt['user_id'] == auth()->id()){
                                                        $score = $attempt->score;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <p class="card-text"><strong class="text-danger">Your Score:</strong> {{ $score }} / {{count($quiz->questions)}}</p>
                                    @endrole
                                    @role('teacher')
                                        <p class="card-text"><strong class="text-danger">number of students who took this quiz:</strong>
                                            {{ count($quiz->quizAttempts) }}
                                        </p>
                                    <button type="button" class="btn btn-dark" onclick="showCodeModal({{ $quiz->id }})">View students</button>
                                    @endrole
                                </div>
                                <div class="card-footer text-muted">
                                    @role('teacher')
                                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-success">Edit</a>
                                        <button type="submit" class="btn btn-danger ">Delete</button>
                                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary">View</a>
                                    </form>
                                    @endrole
                                    @role('student')
                                    <a href="{{ route('quizzes.start', $quiz->id) }}" class="btn btn-primary">Start quiz</a>
                                    @if(!empty($quiz->quizAttempts) && $quiz->quizAttempts->where('user_id',auth()->id())->first())
                                        <a href="{{ route('quiz.results',[ 'quizId'=>$quiz->id]) }}" class="btn btn-primary">Check Results</a>
                                    @endif
                                    @endrole
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Public quizzes
                <!-- Add New Quiz Button -->
                @role('teacher')
                <a href="{{ route('public_quizzes.create') }}" class="btn btn-primary float-right">Create Public Quiz</a>
                @endrole
            </div>

            <div class="card-body">
            <!-- Quiz Cards -->
                <div class="row">
                    @foreach($publicQuizzes as $quiz)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if($quiz->image)
                                    <img src="{{ asset('storage/' . $quiz->image) }}" class="card-img-top" alt="{{ $quiz->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $quiz->name }}</h5>
                                    <p class="card-text"><strong>Time:</strong> {{ $quiz->time }} minutes</p>
                                    @role('student')
                                        @php
                                            $score =0;
                                            if(!empty($quiz->quizAttempts)){
                                                foreach ($quiz->quizAttempts as $attempt){
                                                    if ($attempt['quiz_id'] == $quiz->id && $attempt['user_id'] == auth()->id()){
                                                        $score = $attempt->score;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <p class="card-text"><strong class="text-danger">Your Score:</strong> {{ $score }} / {{count($quiz->questions)}}</p>
                                    @endrole
                                    @role('teacher')
                                        <p class="card-text"><strong class="text-danger">number of students who took this quiz:</strong>
                                            {{ count($quiz->quizAttempts) }}
                                        </p>
                                    <button type="button" class="btn btn-dark" onclick="showCodeModal({{ $quiz->id }},1)">View students</button>
                                    @endrole
                                </div>
                                <div class="card-footer text-muted">
                                    @role('teacher')
                                    <form action="{{ route('public_quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('public_quizzes.edit', $quiz->id) }}" class="btn btn-success">Edit</a>
                                        <button type="submit" class="btn btn-danger ">Delete</button>
                                        <a href="{{ route('public_quizzes.show', $quiz->id) }}" class="btn btn-primary">View</a>
                                    </form>
                                    @endrole
                                    @role('student')
                                    <a href="{{ route('public_quizzes.start', $quiz->id) }}" class="btn btn-primary">Start quiz</a>
                                    @if(!empty($quiz->quizAttempts) && $quiz->quizAttempts->where('user_id',auth()->id())->first())
                                        <a href="{{ route('public_quiz.results',[ 'quizId'=>$quiz->id]) }}" class="btn btn-primary">Check Results</a>
                                    @endif
                                    @endrole
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <input type="hidden" id="delete-attempt-route" value="{{ route('dashboard.quiz-attempts.destroy', ['attempt' => ':id']) }}">
    <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
        <input type="hidden" id="validate-route" value="{{request()->is('*public_quizzes*') ? route('dashboard.public_quizzes.quiz.students',['quiz'=>0]) :
            route('dashboard.quiz.students',['quiz'=>0])}}">
        <input type="hidden" id="public-validate-route" value="{{ route('dashboard.public_quizzes.quiz.students',['quiz'=>0])}}">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="codeModalLabel">List of students who took this quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="text" id="search-students" class="form-control" placeholder="Search for students...">
                    </div>

                    <div id="students-list">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page-specific-scripts')
    <script>
        function showCodeModal(quizId, public=false) {
            // Fetch the route URL from the input
            let route = document.getElementById('validate-route').value;
            if(public){
                route = document.getElementById('public-validate-route').value;
            }
            // Replace '0' in the URL with the actual quizId
            let updatedRoute = route.replace('/0', '/' + quizId);
            // Make an AJAX request to fetch students
            $.ajax({
                url: updatedRoute,
                method: 'GET',
                success: function(response) {
                    console.log('-------',response);
                    // Clear the modal body first
                    let modalBody = document.querySelector('#codeModal #students-list');
                    modalBody.innerHTML = '';

                    // Check if there are students
                    if (response.length > 0) {
                        response.forEach(function(student) {
                            // modalBody.innerHTML += `<p>${student.user.name} &nbsp; &nbsp; <strong class="text-primary"> ${student.user.email}<strong></p>`;
                            if (student.user && student.user.name && student.user.email) {
                                modalBody.innerHTML += `
                                   <div class="student-item">
                                    <p>${student.user.name} &nbsp; &nbsp;
                                    <strong class="text-primary">${student.user.email}</strong></p>
                                    <strong class="text-danger">Score: ${student.score}</strong>
                                    <a href="javascript:void(0);" onclick="deleteAttempt(${student.id},${quizId})">
                                        <span class="badge bg-danger float-end">Delete attempt</span>
                                    </a>
                                    <hr>
                                   </div>`;
                            } else {
                                console.log('Missing user data for student:', student);
                                modalBody.innerHTML += `<p><em>Student data unavailable</em></p>`;
                            }
                        });
                    } else {
                        modalBody.innerHTML = '<p>No students have taken this quiz yet.</p>';
                    }

                    // Show the modal
                    $('#codeModal').modal('show');
                },
                error: function(error) {
                    console.log('Error fetching students:', error);
                }
            });
        }
        function deleteAttempt(attemptId, quizId) {
            const deleteRoute = $('#delete-attempt-route').val().replace(':id', attemptId);
            if (!confirm("Are you sure you want to delete this attempt?")) return;

            $.ajax({
                url: deleteRoute, // Define the deletion route in your routes file
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    alert("Attempt deleted successfully!");
                    showCodeModal(quizId); // Refresh the modal to reflect changes
                },
                error: function(error) {
                    console.log('Error deleting attempt:', error);
                    alert("Failed to delete attempt.");
                }
            });
        }
        document.getElementById('search-students').addEventListener('keyup', function () {
            const query = this.value.toLowerCase();
            const studentItems = document.querySelectorAll('#students-list .student-item'); // Assuming each student is wrapped in a container with class "student-item"

            studentItems.forEach((item) => {
                const studentText = item.textContent.toLowerCase();
                if (studentText.includes(query)) {
                    item.style.display = 'block'; // Show the item if it matches the query
                } else {
                    item.style.display = 'none'; // Hide the item if it doesn't match the query
                }
            });
        });
    </script>
@endpush
