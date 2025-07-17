@extends('dashboard.partials.layout')

@section('content')
    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Add Question to Quiz: {{ $quiz->name }}</div>

                        <div class="card-body">
                            <form action="{{ request()->is('*public_quizzes*') ? route('public_questions.store', $quiz) : route('questions.store', $quiz) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="quiz_id" value="{{$quiz->id}}">

                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" class="form-control" id="question" name="question" required>
                                </div>

                                <div class="form-group">
                                    <label for="link">Link (optional)</label>
                                    <input type="url" class="form-control" id="link" name="link">
                                </div>

                                <div class="form-group">
                                    <label for="image">Image (optional)</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <!-- Dynamic Answers -->
                                <div id="answers-container">
                                    <div class="form-group answer-item d-flex align-items-center">
                                        <label for="answers[0]" class="me-2">Answer</label>
                                        <input type="text" name="answers[0][answer]" class="form-control me-2" required style="width: auto;">
                                        correct &nbsp;<input type="checkbox" name="answers[0][is_correct]" class="me-2">
                                        <button type="button" class="btn btn-danger remove-answer" style="display:none;">Remove</button>
                                    </div>
                                </div>


                                <button type="button" class="btn btn-primary" id="add-answer">Add Answer</button>
                                <button type="submit" class="btn btn-success">Save Question</button>

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
        document.addEventListener('DOMContentLoaded', function() {
            let answerIndex = 1;

            document.getElementById('add-answer').addEventListener('click', function() {
                let container = document.getElementById('answers-container');
                let newAnswer = document.createElement('div');
                newAnswer.classList.add('form-group', 'answer-item','d-flex','align-items-center');// <div class="form-group answer-item d-flex align-items-center">
                newAnswer.innerHTML = `
                <label for="answers[${answerIndex}]" class="me-2">Answer</label>
                <input type="text" name="answers[${answerIndex}][answer]" class="form-control me-2 " style="width: auto;" required>
                correct &nbsp;<input type="checkbox" name="answers[${answerIndex}][is_correct]">
                <button type="button" class="btn btn-danger remove-answer" style="margin-left: 1%;">Remove</button>
            `;
                container.appendChild(newAnswer);
                answerIndex++;
            });

            document.getElementById('answers-container').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-answer')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
    <script src="{{asset("js/questions.js")}}"></script>
@endpush
