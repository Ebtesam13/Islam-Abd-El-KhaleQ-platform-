@extends('dashboard.partials.layout')

@section('content')

    <div class="container-fluid mt-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    {{--                    <h1 class="display-3 text-dark">{{$unit->name}}</h1>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h1>Booklets</h1>
                                </div>
                                <div class="col">
                                    @role('teacher')
                                        <a href="{{ route('dashboard.booklets.create') }}" class="btn btn-primary mb-3">Create New Booklet</a>
                                    @endrole
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                @role('teacher')
                                    <th>Number of Codes</th>
                                @endrole
                                <th>Quiz</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($booklets as $booklet)
                                <input type="hidden" id="booklet_id" value="{{$booklet->id}}">

                                <tr>
                                    <td>{{ $booklet->name }}</td>
                                    @role('teacher')
                                        <td>{{ $booklet->number_of_codes }}</td>
                                    @endrole
                                    <td>{{ $booklet->quiz->name ?? 'N/A' }}</td>
                                    <td>
                                        @role('teacher')
                                        <a href="{{ route('dashboard.booklets.show', $booklet) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('dashboard.booklets.edit', $booklet) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('dashboard.booklets.destroy', $booklet) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booklet?')">Delete</button>
                                            </form>
                                        @endrole
                                        @role('student')
{{--                                        <button type="button" class="btn btn-primary" id="btn-{{$booklet->id}}" data-href="{{ Storage::url($booklet->file_path) }}" onclick="showCodeModal()">View Booklet PDF</button>--}}

                                        <p><strong>PDF File:</strong> <a href="{{ Storage::url($booklet->file_path) }}" target="_blank">View PDF</a></p>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
        <input type="hidden" id="validate-route" value="{{route('dashboard.validate.code')}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="codeModalLabel">Enter Access Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="accessCode" placeholder="Enter your code here">
                    <div id="error-message" class="text-danger mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="validateCode()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-specific-scripts')
    <script>
        function showCodeModal() {
            // Show the modal popup
            var codeModal = new bootstrap.Modal(document.getElementById('codeModal'), {});
            codeModal.show();
        }

        function validateCode() {
            var code = document.getElementById('accessCode').value;
            var errorMessage = document.getElementById('error-message');

            if (code === '') {
                errorMessage.textContent = 'Please enter a code.';
                return;
            }
            let id = $('#booklet_id').val();
            let route = $('#validate-route').val();
            let href = $('#btn-'+id).attr('data-href');
            // AJAX request to validate the code
            fetch(route, {  // Change the URL to your actual route
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    code: code,
                    booklet_id: id,
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        window.location.href = href;
                    } else {
                        errorMessage.textContent = 'Invalid code. Please try again.';
                    }
                })
                .catch(error => {
                    errorMessage.textContent = 'An error occurred. Please try again.';
                });
        }

    </script>
@endpush
