@extends('dashboard.partials.layout')

@section('content')
    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ $quiz->name }}</div>

                        <div class="card-body">
                            <h1>Edit Question</h1>

                            <form action="{{ route('questions.update', [$quiz->id, $question->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $question->question) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $question->link) }}">
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @if($question->image)
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-thumbnail mt-2" width="100">
                                    @endif
                                </div>
                                <div class="form-group" id="answers-container">
                                    <label for="answers">Answers</label>
                                    @foreach($question->answers as $index => $answer)
                                        <div class="input-group mb-2">
                                            <input type="text" name="answers[{{ $index }}][answer]" class="form-control" value="{{ old('answers.'.$index.'.answer', $answer->answer) }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <input type="radio" name="correct_answer" value="{{ $index }}" {{ old('correct_answer', $answer->is_correct) ? 'checked' : '' }}>
                                                    <!-- Mark the correct answer -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" onclick="addAnswerField()">Add Answer</button>
                                <button type="submit" class="btn btn-primary">Update Question</button>
                            </form>

                            <form action="{{ route('questions.destroy', [$quiz->id, $question->id]) }}" method="POST" class="mt-3" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Question</button>
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
        function addAnswerField() {
            // Create a new div element to contain the answer input field
            const newAnswer = document.createElement('div');
            newAnswer.classList.add('form-group', 'mt-2');

            // Create the input field for the new answer
            newAnswer.innerHTML = '<input type="text" name="answers[]" class="form-control" placeholder="Enter answer" required>';

            // Append the new answer input field to the answers container
            document.getElementById('answers-container').appendChild(newAnswer);
        }
        // $(document).ready(function() {
        //
        //     function addAnswerField() {
        //         console.log('ssssssssssss');
        //         let container = document.createElement('div');
        //         container.classList.add('form-group');
        //         container.innerHTML = '<input type="text" name="answers[]" class="form-control mt-2" required>';
        //         document.querySelector('form').insertBefore(container, document.querySelector('form').lastElementChild);
        //     }
        // });
    </script>
@endpush
