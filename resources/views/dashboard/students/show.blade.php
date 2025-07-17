@extends('dashboard.partials.layout')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row justify-content-center">
                @if (session('alert-success'))
                    <div class="container alert alert-success" role="alert">
                        {{ session('alert-success') }}
                    </div>
                @endif
                @if (session('alert-danger'))
                    <div class="container alert alert-danger" role="alert">
                        {{ session('alert-danger') }}
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Student Details') }}</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <td>{{ $student->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Code') }}</th>
                            <td>{{ $student->code }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Email') }}</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Image') }}</th>
                            <td>
                                <div class="mb-3">
                                    <img id="profile_image_preview"
                                         src="{{ $student->image_path ? asset('storage/' . $student->image_path) : asset('images/default-profile.png') }}"
                                         alt="Profile Preview"
                                         class="img-thumbnail"
                                         width="150"
                                         style="cursor: pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Mobile') }}</th>
                            <td>{{ $student->mobile_country_code }} {{ $student->mobile }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Area') }}</th>
                            <td>{{ $student->area->area_name_ar  .'/'.  $student->area->area_name_en}}</td>
                        </tr>
                        <tr>
                            <th>{{ __('City') }}</th>
                            <td>{{ $student->city->city_name_ar.'/'.  $student->city->city_name_en }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('School') }}</th>
                            <td>{{ $student->school }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Second Language') }}</th>
                            <td>{{ $student->second_language }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Current stage') }}</th>
                            <td>{{ $student->stage ? $student->stage->name : "-" }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Senior Year') }}</th>
                            <td>{{ $student->senior_year }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Mom WhatsApp') }}</th>
                            <td>{{ $student->mom_whats_app }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Dad WhatsApp') }}</th>
                            <td>{{ $student->dad_whats_app }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Identity Number') }}</th>
                            <td>{{ $student->identity_number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Facebook link') }}</th>
                            <td>{{ $student->facebook_link }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Dad Job') }}</th>
                            <td>{{ $student->dad_job }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Viewed Lessons') }}</th>
                            <td>
                                <ul>
                                @foreach($student->lessons as $lesson)
                                        <li>{{$lesson->name}}
                                            &nbsp; <span class="text-primary"> used code:</span>{{$lesson->pivot['access_code'] }}
                                            &nbsp; <span class="text-primary"> expires at:</span>{{$lesson->pivot['expires_at'] }}
                                        </li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Viewed Homework') }}</th>
                            <td>
                                <ul>
                                @foreach($student->homeworks as $lesson)
                                        <li>{{$lesson->name}}</li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Quiz Attempts') }}</th>
                            <td>
                                <ul>
                                @foreach($student->quizAttempts as $attempt)
                                        <li>
                                            <span class="text-primary"> quiz name:</span>{{$attempt->quiz ? $attempt->quiz->name : ""}} &nbsp;
                                            <span class="text-primary"> quiz score:</span>{{$attempt->score .'/'. $attempt->full_mark}}&nbsp;
                                            <span class="text-primary"> current question:</span>{{$attempt->current_question}}&nbsp;
                                        </li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">{{ __('Back to Students') }}</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">{{ __('Edit Student') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ __('Image Preview') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Student Image">
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page-specific-scripts')
    <script>
        $(document).ready(function () {
            $('#profile_image_preview').on('click', function () {
                const src = $(this).attr('src');
                $('#modalImage').attr('src', src);
            });
        });
    </script>
@endpush
