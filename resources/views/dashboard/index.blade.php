@extends('dashboard.partials.layout')
@section('content')

    <div class="container">
        <div class="page-inner">
            <!-- Grettings Box Start -->
            <div class="greetings-box position-relative rounded-16 bg-main-600 overflow-hidden gap-16 flex-wrap z-1" style="margin-bottom:25px;">
                <img src="{{ asset('dashboard/assets/img/grettings-pattern.png') }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100 opacity-6" />
                <div class="row gy-4">
                    <div class="col-sm-7">
                        <div class="grettings-box__content py-xl-4">
                            <h2 class="text-white mb-0">{{__('labels.hello')}} , {{ Str::title(auth()->user()->name) }}</h2>
                            <p class="text-15 fw-light mt-4 text-white">{{__('labels.welcome_to') .' '. __('labels.dashboard')}}</p>
                        </div>
                    </div>
                    <div class="col-sm-5 d-sm-block d-none">
                        <div class="text-center h-100 d-flex justify-content-center align-items-end ">
                            <img src="{{asset('dashboard/assets/img/gretting-img.png')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            @role('teacher')
                {{--        number of students, parents, and teachers--}}
                <div class="row">
                    <div class="card-title mb-3">Users Overview</div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big bg-main-600 text-center icon-primary bg-main-600 bubble-shadow-small"
                                        >
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Students</p>
                                            <h4 class="card-title">{{$totalStudents}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big bg-main-600 text-center icon-info bubble-shadow-small"
                                        >
                                            <i class="fas fa-user-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Parents</p>
                                            <h4 class="card-title">{{$totalParents}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div
                                            class="icon-big bg-main-600 text-center icon-secondary bg-main-600 bubble-shadow-small"
                                        >
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Teachers</p>
                                            <h4 class="card-title">{{$totalTeachers}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--            //stages count--}}
                <div class="row">
                    <div class="card-title mb-3">Students by Stage</div>
                    @foreach($currentStageCounts as $currentStageCount)
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big bg-main-600 text-center icon-primary bg-main-600 bubble-shadow-small"
                                            >
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">{{$currentStageCount->stage_name }}</p>
                                                <h4 class="card-title">{{$currentStageCount->student_count }}</h4>
                                                <p class="card-category">{{ number_format($currentStageCount->percentage, 2) }}%</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    {{--            download students' scores--}}
              <div class="row">
                <div class="card-title mb-3 fw-bold">Download Students' Scores by Stage</div>
                @foreach($stages as $stage)
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round position-relative">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col col-stats">
                                        <div class="numbers">
                                            <p class="card-category mb-0">{{ $stage->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('export.students.scores', ['stage' => $stage->id]) }}"
                            class="btn btn-sm position-absolute bg-main-600 text-white"
                            style="bottom: 15px; right: 15px;">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

    {{--            cities bar chart--}}
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Number of students in each city</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    {{--            New Users, students list--}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-round">
                            <div class="card-body">
                                <div class="card-head-row card-tools-still-right">
                                    <div class="card-title">New Users</div>
                                </div>
                                <div class="card-list py-4">
                                    @foreach($recentUsers as $user)
                                        <div class="item-list">
                                            <div class="avatar">
                                                @if(!empty($user->image_path))
                                                    <img src={{Storage::url($user->image_path)}} alt="..." class="avatar-img rounded-circle"/>
                                                @else
                                                    <span
                                                        class="avatar-title rounded-circle border border-white bg-secondary"
                                                    >F</span>
                                                @endif
                                            </div>
                                            <div class="info-user ms-3">
                                                <div class="username">{{$user->name}}</div>
                                                <div class="status">{{$user->getRoleNames()->first()}}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-head-row card-tools-still-right">
                                    <div class="card-title">Students</div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <!-- Projects table -->
                                    <table class="table align-items-center mb-0">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Student Name</th>
                                            <th scope="col" class="text-end">Join Date</th>
                                            <th scope="col" class="text-end">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <th scope="row">
                                                    <!-- <button
                                                        class="btn btn-icon btn-round btn-success btn-sm me-2"
                                                    >
                                                        <i class="fa fa-check"></i>
                                                    </button> -->
                                                    {{$student->name}}
                                                </th>
                                                <td class="text-end">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $student->created_at)->format('d M Y  H:i:s')}}</td>
                                                <td class="text-end">
                                                    {{--                                            <a type="button" class="btn btn-outline-main rounded-pill">Show</a>--}}
                                                    <button type="button" class="btn btn-outline-main rounded-pill" data-bs-toggle="modal" data-bs-target="#showStudentModal"
                                                            data-id="{{ $student->id }}"
                                                            data-name="{{ $student->name }}"
                                                            data-email="{{ $student->email }}"
                                                            data-role="{{ $student->getRoleNames()->first() }}"
                                                            data-code="{{ $student->code }}"
                                                            data-senior_year="{{ $student->senior_year }}"
                                                            data-current_stage="{{ $student->stage->name }}"
                                                            data-area_id="{{ !empty($student->area->area_name_ar) ? $student->area->area_name_ar . "/" . $student->area->area_name_en : " " }}"
                                                            data-city_id="{{ !empty($student->city->city_name_ar) ? $student->city->city_name_ar . "/" . $student->city->city_name_en  : " "}}"
                                                            data-school="{{ $student->school }}"
                                                            data-school_type="{{ $student->school_type }}"
                                                            data-second_language="{{ $student->second_language }}"
                                                            data-mobile="{{ $student->mobile }}"
                                                            data-whats_app="{{$student->mobile_country_code  . $student->whats_app }}"
                                                            data-mom_whats_app="{{ $student->mom_whats_app }}"
                                                            data-dad_whats_app="{{ $student->dad_whats_app }}"
                                                            data-dad_job="{{ $student->dad_job }}"
                                                            data-facebook_link="{{ $student->facebook_link }}"
                                                            data-identity_number="{{ $student->identity_number }}"
                                                            data-image_path="{{ $student->image_path }}">
                                                        Show
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination justify-content-center">
                                        {{ $students->onEachSide(1)->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    {{--            number of students & their percentage--}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pie Chart</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas
                                        id="pieChart"
                                        style="width: 50%; height: 50%"
                                    ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-head-row card-tools-still-right">
                                    <div class="card-title">Parents</div>
                                    {{--                                <div class="card-tools">--}}
                                    {{--                                    <div class="dropdown">--}}
                                    {{--                                        <button--}}
                                    {{--                                            class="btn btn-icon btn-clean me-0"--}}
                                    {{--                                            type="button"--}}
                                    {{--                                            id="dropdownMenuButton"--}}
                                    {{--                                            data-bs-toggle="dropdown"--}}
                                    {{--                                            aria-haspopup="true"--}}
                                    {{--                                            aria-expanded="false"--}}
                                    {{--                                        >--}}
                                    {{--                                            <i class="fas fa-ellipsis-h"></i>--}}
                                    {{--                                        </button>--}}
                                    {{--                                        <div--}}
                                    {{--                                            class="dropdown-menu"--}}
                                    {{--                                            aria-labelledby="dropdownMenuButton"--}}
                                    {{--                                        >--}}
                                    {{--                                            <a class="dropdown-item" href="#">Action</a>--}}
                                    {{--                                            <a class="dropdown-item" href="#">Another action</a>--}}
                                    {{--                                            <a class="dropdown-item" href="#"--}}
                                    {{--                                            >Something else here</a--}}
                                    {{--                                            >--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <!-- Projects table -->
                                    <table class="table align-items-center mb-0">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Parent Name</th>
                                            <th scope="col" class="text-end">Join Date</th>
                                            <th scope="col" class="text-end">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($parents as $parent)
                                            <tr>
                                                <th scope="row">
                                                    <!-- <button
                                                        class="btn btn-icon btn-round btn-success btn-sm me-2"
                                                    >
                                                        <i class="fa fa-check"></i>
                                                    </button> -->
                                                    {{$parent->name}}
                                                </th>
                                                <td class="text-end">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $parent->created_at)->format('d M Y  H:i:s')}}</td>
                                                <td class="text-end">
                                                    {{--                                            <a type="button" class="btn btn-outline-main rounded-pill">Show</a>--}}
                                                    <button type="button" class="btn btn-outline-main rounded-pill" data-bs-toggle="modal" data-bs-target="#showParentModal"
                                                            data-id="{{ $parent->id }}"
                                                            data-name="{{ $parent->name }}"
                                                            data-email="{{ $parent->email }}"
                                                            data-role="{{ $parent->getRoleNames()->first() }}"
                                                            data-mobile="{{ $parent->mobile }}"
                                                            data-job="{{ $parent->job }}"
                                                            data-image_path="{{ $parent->image_path }}"
                                                    >
                                                        Show
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination justify-content-center">
                                        {{ $students->onEachSide(1)->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    {{--            total lessons--}}
                <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Total Lessons</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="lessonsBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                {{--            total homework--}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Total Homework</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="homeworkBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole

            @role('student')
{{--            total lessons--}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Total Lessons</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="lessonsBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--            total homework--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Total Homework</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="homeworkBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Quiz scores</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole

            @role('parent')
{{--            total lessons--}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Total Lessons</div>
                            </div>
                            <div class="card-body">
                                <div id="child-lesson-charts-container"></div>
                            </div>
                        </div>
                    </div>
                    {{--            total homework--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Total Homework</div>
                            </div>
                            <div class="card-body">
                                <div id="child-homework-chart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>


    <!-- Modal for Showing User Info -->
    <div class="modal fade" id="showStudentModal" tabindex="-1" aria-labelledby="showStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showStudentModalLabel">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="student-id"></span></p>
                    <p><strong>Name:</strong> <span id="student-name"></span></p>
                    <p><strong>Email:</strong> <span id="student-email"></span></p>
                    <p><strong>Role:</strong> <span id="student-role"></span></p>
                    <p><strong>Code:</strong> <span id="student-code"></span></p>
                    <p><strong>Senior Year:</strong> <span id="student-senior-year"></span></p>
                    <p><strong>Current Stage:</strong> <span id="student-current-stage"></span></p>
                    <p><strong>Area ID:</strong> <span id="student-area-id"></span></p>
                    <p><strong>City ID:</strong> <span id="student-city-id"></span></p>
                    <p><strong>School:</strong> <span id="student-school"></span></p>
                    {{--                    <p><strong>School Type:</strong> <span id="student-school-type"></span></p>--}}
                    {{--                    <p><strong>Second Language:</strong> <span id="student-second-language"></span></p>--}}
                    <p><strong>Mobile:</strong> <span id="student-mobile"></span></p>
                    <p><strong>WhatsApp:</strong> <span id="student-whats-app"></span></p>
                    <p><strong>Mom's WhatsApp:</strong> <span id="student-mom-whats-app"></span></p>
                    <p><strong>Dad's WhatsApp:</strong> <span id="student-dad-whats-app"></span></p>
                    <p><strong>Dad's Job:</strong> <span id="student-dad-job"></span></p>
                    {{--                    <p><strong>Facebook Link:</strong> <span id="student-facebook-link"></span></p>--}}
                    <p><strong>Identity Number:</strong> <span id="student-identity-number"></span></p>
                    <p><strong>Image Path:</strong> <span id="student-image-path"></span></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showParentModal" tabindex="-1" aria-labelledby="showParentModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showParentModal">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="parent-id"></span></p>
                    <p><strong>Name:</strong> <span id="parent-name"></span></p>
                    <p><strong>Email:</strong> <span id="parent-email"></span></p>
                    <p><strong>Role:</strong> <span id="parent-role"></span></p>
                    <p><strong>Mobile:</strong> <span id="parent-mobile"></span></p>
                    <p><strong>Job:</strong> <span id="parent-job"></span></p>
                    <p><strong>Image path:</strong> <span id="parent-image_path"></span></p>
                    <hr>
                    <div id="students-list"></div> <!-- This will hold the students -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script src={{asset("dashboard/assets/js/plugin/chart.js/chart.min.js")}}></script>
    <script>
        // Script to populate modal with student data
        var showStudentModal = document.getElementById('showStudentModal');
        showStudentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal

            var studentId = button.getAttribute('data-id');
            var studentName = button.getAttribute('data-name');
            var studentEmail = button.getAttribute('data-email');
            var studentRole = button.getAttribute('data-role');
            var studentCode = button.getAttribute('data-code');
            var studentSeniorYear = button.getAttribute('data-senior_year');
            var studentCurrentStage = button.getAttribute('data-current_stage');
            var studentAreaId = button.getAttribute('data-area_id');
            var studentCityId = button.getAttribute('data-city_id');
            var studentSchool = button.getAttribute('data-school');
            // var studentSchoolType = button.getAttribute('data-school_type');
            // var studentSecondLanguage = button.getAttribute('data-second_language');
            var studentMobile = button.getAttribute('data-mobile');
            var studentWhatsApp = button.getAttribute('data-whats_app');
            var studentMomWhatsApp = button.getAttribute('data-mom_whats_app');
            var studentDadWhatsApp = button.getAttribute('data-dad_whats_app');
            var studentDadJob = button.getAttribute('data-dad_job');
            // var studentFacebookLink = button.getAttribute('data-facebook_link');
            var studentIdentityNumber = button.getAttribute('data-identity_number');
            var studentImagePath = button.getAttribute('data-image_path');
            // Update modal content
            document.getElementById('student-id').textContent = studentId;
            document.getElementById('student-name').textContent = studentName;
            document.getElementById('student-email').textContent = studentEmail;
            document.getElementById('student-role').textContent = studentRole;

            document.getElementById('student-code').textContent = studentCode;
            document.getElementById('student-senior-year').textContent = studentSeniorYear;
            document.getElementById('student-current-stage').textContent = studentCurrentStage;
            document.getElementById('student-area-id').textContent = studentAreaId;
            document.getElementById('student-city-id').textContent = studentCityId;
            document.getElementById('student-school').textContent = studentSchool;
            // document.getElementById('student-school-type').textContent = studentSchoolType;
            // document.getElementById('student-second-language').textContent = studentSecondLanguage;
            document.getElementById('student-mobile').textContent = studentMobile;
            document.getElementById('student-whats-app').textContent = studentWhatsApp;
            document.getElementById('student-mom-whats-app').textContent = studentMomWhatsApp;
            document.getElementById('student-dad-whats-app').textContent = studentDadWhatsApp;
            document.getElementById('student-dad-job').textContent = studentDadJob;
            // document.getElementById('student-facebook-link').textContent = studentFacebookLink;
            document.getElementById('student-identity-number').textContent = studentIdentityNumber;
            document.getElementById('student-image-path').textContent = studentImagePath;
        });

        // Script to populate modal with parent data
        var showParentModal = document.getElementById('showParentModal');
        showParentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal

            var parentId = button.getAttribute('data-id');
            var parentName = button.getAttribute('data-name');
            var parentEmail = button.getAttribute('data-email');
            var parentRole = button.getAttribute('data-role');
            var parentMobile = button.getAttribute('data-mobile');
            var parentJob = button.getAttribute('data-job');
            var parentImagePath = button.getAttribute('data-image_path');
            // Update modal content
            document.getElementById('parent-id').textContent = parentId;
            document.getElementById('parent-name').textContent = parentName;
            document.getElementById('parent-email').textContent = parentEmail;
            document.getElementById('parent-role').textContent = parentRole;
            document.getElementById('parent-mobile').textContent = parentMobile;
            document.getElementById('parent-job').textContent = parentJob;
            document.getElementById('parent-image_path').textContent = parentImagePath;
            // Clear the students list first
            $('#students-list').empty();

            // Append the children (students) dynamically
            var parentData = {!! json_encode($parents->keyBy('id')) !!}; // Key the parents by their ID
            var selectedParent = parentData[parentId]; // Get the selected parent object

            if (selectedParent && selectedParent.students.length > 0) {
                $('#students-list').append('<p class="text-primary">Students:</p>'); // Add title
                var studentList = '<ul class="ml-3">'; // Create unordered list
                selectedParent.students.forEach(function (student) {
                    studentList += '<li>' + student.name + '</li>'; // Append each student as a list item
                });
                studentList += '</ul>';
                $('#students-list').append(studentList); // Append the complete list to the div
            } else {
                $('#students-list').append('<p>No students available.</p>'); // If no students
            }

        });


        //pie chart
        if (document.getElementById('pieChart')) {
            var pieChart = document.getElementById("pieChart").getContext("2d");
            var pieData = [];
            var pieLabels = [];
            var colors = ["#1d7af3", "#f3545d", "#fdaf4b", "#31CE36"];
            
            @foreach($currentStageCounts as $index => $stage)
                @if(isset($stage->percentage))
                    pieData.push({{$stage->percentage}});
                    pieLabels.push("{{str_replace(' ','-',$stage->stage_name)}}");
                @endif
            @endforeach

            var myPieChart = new Chart(pieChart, {
                type: "pie",
                data: {
                    datasets: [
                        {
                            data: pieData,
                            backgroundColor: colors.slice(0, pieData.length),
                            borderWidth: 0,
                        },
                    ],
                    labels: pieLabels
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: "bottom",
                        labels: {
                            fontColor: "rgb(154, 154, 154)",
                            fontSize: 11,
                            usePointStyle: true,
                            padding: 20,
                        },
                    },
                    pieceLabel: {
                        render: "percentage",
                        fontColor: "white",
                        fontSize: 14,
                    },
                    tooltips: false,
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 20,
                        },
                    },
                },
            });
        }


        //cities bar chart
        if (document.getElementById('barChart')) {
            var barChart = document.getElementById("barChart").getContext("2d");
            var cityNames = {!! json_encode($cityNames) !!}; // Array of city names
            var totalStudents = {!! json_encode($totalStudentsCount) !!}; // Array of student counts
            var myBarChart = new Chart(barChart, {
                type: "bar",
                data: {
                    labels: cityNames,
                    datasets: [
                        {
                            label: "number of students",
                            backgroundColor: "#06b3c6",
                            borderColor: "#06b3c6",
                            data: totalStudents,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                },
                            },
                        ],
                    },
                },
            });
        }

        //lessons bar chart
        if (document.getElementById('lessonsBarChart')) {
            var lessonsBarChart = document.getElementById("lessonsBarChart").getContext("2d");
            var totalLessons = {!! json_encode($allLessons) !!};
            var viewedLessons = {!! json_encode($allViewedLessons) !!};
            var myLessonsBarChart = new Chart(lessonsBarChart, {
                type: "bar",
                data: {
                    labels: ["total", "viewed"],
                    datasets: [
                        {
                            label: "number of lessons",
                            backgroundColor: "#716aca",
                            borderColor: "rgb(23, 125, 255)",
                            data: [totalLessons, viewedLessons],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                },
                            },
                        ],
                    },
                },
            });
        }

        //child lessons bar chart
        // Assuming children data is passed from the server
        document.addEventListener("DOMContentLoaded", function () {
            // Assuming children data is passed from the server
            var children = {!! json_encode($children) !!}; // Your array of children data

            // Check if the charts-container div exists
            var chartContainer = document.getElementById("child-lesson-charts-container");
            if (!chartContainer) {
                console.error("charts-container div is missing.");
                return;
            }

            var homeworkChartContainer = document.getElementById("child-homework-chart-container");
            if (!homeworkChartContainer) {
                console.error("homeworkChartContainer div is missing.");
                return;
            }

            // Iterate over each child to create a chart
            children.forEach((child, index) => {
                // Create a new canvas element for each child
                var chartDiv = document.createElement("div");
                chartDiv.className = "child-chart";
                var canvas = document.createElement("canvas");
                canvas.id = `childLessonsBarChart-${index}`; // Unique ID for each chart
                chartDiv.appendChild(canvas);
                chartContainer.appendChild(chartDiv);

                // Data for the chart (total and viewed lessons for this child)
                var totalLessons = child.all_lessons;
                var viewedLessons = child.viewed_lessons;

                // Create the chart
                var lessonsBarChart = canvas.getContext("2d");
                new Chart(lessonsBarChart, {
                    type: "bar",
                    data: {
                        labels: ["Total Lessons", "Viewed Lessons"],
                        datasets: [
                            {
                                label: `Number of lessons for ${child.name}`,
                                backgroundColor: "#716aca",
                                borderColor: "rgb(23, 125, 255)",
                                data: [totalLessons, viewedLessons],
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                },
                            ],
                        },
                    },
                });
            });
            children.forEach((child, index) => {
                // Create a new canvas element for each child
                let homeworkChartDiv = document.createElement("div");
                homeworkChartDiv.className = "child-chart";
                var canvas = document.createElement("canvas");
                canvas.id = `childHomeworkBarChart-${index}`; // Unique ID for each chart
                homeworkChartDiv.appendChild(canvas);
                homeworkChartContainer.appendChild(homeworkChartDiv);

                // Data for the chart (total and viewed lessons for this child)
                var totalHomewwork = child.all_homework;
                var viewedHomework = child.viewed_homework;

                // Create the chart
                var homeworkBarChart = canvas.getContext("2d");
                new Chart(homeworkBarChart, {
                    type: "bar",
                    data: {
                        labels: ["Total Homework", "Viewed Homework"],
                        datasets: [
                            {
                                label: `Number of homework for ${child.name}`,
                                backgroundColor: "#fdaf4b",
                                borderColor: "#fdaf4b",
                                data: [totalHomewwork, viewedHomework],
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                },
                            ],
                        },
                    },
                });
            });
        });


        {{--if (document.getElementById('childLessonsBarChart')) {--}}
        {{--    var lessonsBarChart = document.getElementById("childLessonsBarChart").getContext("2d");--}}
        {{--    var totalLessons = {!! json_encode($allLessons) !!};--}}
        {{--    var viewedLessons = {!! json_encode($allViewedLessons) !!};--}}
        {{--    var myLessonsBarChart = new Chart(lessonsBarChart, {--}}
        {{--        type: "bar",--}}
        {{--        data: {--}}
        {{--            labels: ["total", "viewed"],--}}
        {{--            datasets: [--}}
        {{--                {--}}
        {{--                    label: "number of lessons",--}}
        {{--                    backgroundColor: "#716aca",--}}
        {{--                    borderColor: "rgb(23, 125, 255)",--}}
        {{--                    data: [totalLessons, viewedLessons],--}}
        {{--                },--}}
        {{--            ],--}}
        {{--        },--}}
        {{--        options: {--}}
        {{--            responsive: true,--}}
        {{--            maintainAspectRatio: false,--}}
        {{--            scales: {--}}
        {{--                yAxes: [--}}
        {{--                    {--}}
        {{--                        ticks: {--}}
        {{--                            beginAtZero: true,--}}
        {{--                        },--}}
        {{--                    },--}}
        {{--                ],--}}
        {{--            },--}}
        {{--        },--}}
        {{--    });--}}
        {{--}--}}

        //homework bar chart
        if (document.getElementById('homeworkBarChart')) {
            var homeworkBarChart = document.getElementById("homeworkBarChart").getContext("2d");
            var totalHomework = {!! json_encode($allHomework) !!};
            var viewedHomework = {!! json_encode($viewedHomework) !!};
            var myHomeworkBarChart = new Chart(homeworkBarChart, {
                type: "bar",
                data: {
                    labels: ["total", "viewed"],
                    datasets: [
                        {
                            label: "number of homework videos",
                            backgroundColor: "#fdaf4b",
                            borderColor: "#fdaf4b",
                            data: [totalHomework, viewedHomework],
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                },
                            },
                        ],
                    },
                },
            });
        }

        if (document.getElementById('lineChart')) {
            //line chart
            var lineChart = document.getElementById("lineChart").getContext("2d");
            var myLineChart = new Chart(lineChart, {
                type: "line",
                data: {
                    labels: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    datasets: [
                        {
                            label: "Score",
                            borderColor: "#1d7af3",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#1d7af3",
                            pointBorderWidth: 2,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 1,
                            pointRadius: 4,
                            backgroundColor: "transparent",
                            fill: true,
                            borderWidth: 2,
                            data: {!! json_encode($monthlyScores) !!},
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: "bottom",
                        labels: {
                            padding: 10,
                            fontColor: "#1d7af3",
                        },
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10,
                    },
                    layout: {
                        padding: {left: 15, right: 15, top: 15, bottom: 15},
                    },
                },
            });
        }
    </script>
@endpush
