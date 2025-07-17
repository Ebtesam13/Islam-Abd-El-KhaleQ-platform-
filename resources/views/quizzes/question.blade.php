@extends('dashboard.partials.layout')

@section('content')

    <div class="container-xxl mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $quiz->name }}</h2> <!-- Changed from 'title' to 'name' -->
                        </div>
                        @php
                            $minutes = $attempt->time_left;
                            // Calculate hours and minutes
                            $hours = floor($minutes / 60); // Get the number of hours
                            $remainingMinutes = $minutes % 60; // Get the remaining minutes
                            // Format to HH:MM
                            $timeFormat = sprintf('%02d:%02d', $hours, $remainingMinutes);
                        @endphp
                        <div class="card-body">
                            <div id="timer">Time Left: <span id="time-left">{{ $timeFormat }}</span></div>
                            <!-- Navigation through Question Numbers -->
{{--                            <div class="mb-4">--}}
{{--                                <h4>Navigate through Questions:</h4>--}}
{{--                                <div class="d-flex flex-wrap">--}}
{{--                                    @foreach ($quiz->questions as $index => $q)--}}
{{--                                        <a href="javascript:void(0);"--}}
{{--                                           class="btn btn-sm {{ $index + 1 == $questionNumber ? 'btn-primary' : 'btn-outline-secondary' }} m-1"--}}
{{--                                           onclick="submitAndNavigate('{{ route('quizzes.question', ['quizId' => $quiz->id, 'questionNumber' => $index + 1]) }}')">--}}
{{--                                            {{ $index + 1 }}--}}
{{--                                        </a>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <form id="submit-answer" action="{{ request()->is('*public_quizzes*') ?
                                 route('public_quizzes.submitAnswer', ['quizId' => $quiz->id, 'questionNumber' => $questionNumber])
                                : route('quizzes.submitAnswer', ['quizId' => $quiz->id, 'questionNumber' => $questionNumber]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="time_left" id="time-left-input">

                                <h3>Question {{ $questionNumber }}</h3>
                                <p>{{ $question->question }}</p> <!-- Changed from 'question_text' to 'question' -->

                                @if($question->link)
                                    <a href="{{ $question->link }}" target="_blank">Related Link</a>
                                @endif

                            <!-- Image -->
                                @if ($question->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-fluid">
                                    </div>
                                @endif
                            <!-- Display Answers -->
                                @foreach ($question->answers as $answer)
                                    @php
                                        $isChecked = !empty($attempt) && $attempt->answers ? isset($attempt->answers->where('question_id', $question->id)->first()->id) &&
                                            $attempt->answers->where('question_id', $question->id)->first()->id == $answer->id ? "checked" : "" :"";
                                    @endphp
                                    <div>
                                        <input type="radio" name="answer" value="{{ $answer->id }}" id="answer{{ $answer->id }}" {{$isChecked}}>
                                        <label for="answer{{ $answer->id }}">{{ $answer->answer }}</label>
                                    </div>
                                @endforeach

                                <div class="mt-3">
                                    @if ($questionNumber > 1)
                                        <button type="submit" name="previous" class="btn btn-secondary">Previous</button>
                                    @endif

                                    @if ($questionNumber < $quiz->questions()->count())
                                        <button type="submit" name="next" class="btn btn-primary">Next</button>
                                    @else
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timeLeft = {{ $attempt->time_left }}; // Assuming timeLeft is in seconds
        const timerElement = document.getElementById('time-left');

        function startTimer() {
            console.log('-------------', timeLeft);
            const timerInterval = setInterval(() => {
                timeLeft--;

                // Calculate minutes and seconds
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                // Format the time to "MM:SS" (with leading zeros)
                const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Update the DOM element and hidden input with the formatted time
                timerElement.textContent = formattedTime;
                $('#time-left-input').val(formattedTime);

                // Check if time is up
                if (timeLeft <= 0) {
                    $('#time-left-input').val('00:00'); // Set final value to 00:00
                    clearInterval(timerInterval);
                    alert('Time is up!');

                    // Auto-submit form when time is up
                    $('#submit-answer').submit();
                }
            }, 1000);
        }

        startTimer();

        function submitAndNavigate(route) {
            // Get the form element
            const form = document.getElementById('submit-answer');

            if (form) {
                // Create a hidden input for the navigation route
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'next_route';
                input.value = route;
                form.append(input); // Append the input to the form

                // Attach a listener to handle form submission success and navigate
                // form.addEventListener('submit', function(e) {
                //     e.preventDefault(); // Prevent the default form submission
                // $('#submit-answer').submit(); // Submit the form
                //
                // Once submitted, redirect to the new question
                // window.location.href = route;
                // });
            } else {
                console.error('Form element not found');
            }
        }
    </script>
@endsection
