@extends('dashboard.partials.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="card">
                <div class="card-body">
                    <table id="students-table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-specific-scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            $('#students-table').DataTable({
                // processing: true,
                // serverSide: true,
                ajax: '{{ route('students.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    // { data: 'grade_level', name: 'grade_level' },
                    // { data: 'enrollment_date', name: 'enrollment_date' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });
        var deleteUrl = "{{ route('students.destroy', ':id') }}";
        $(document).on('click', '.delete-button', function (e) {
            e.preventDefault();
            console.log('------', document.referrer);
            var studentId = $(this).data('id'); // Get the student ID
            var finalUrl = deleteUrl.replace(':id', studentId); // Replace placeholder with studentId
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            if (confirm('Are you sure you want to delete this student?')) {
                $.ajax({
                    url: finalUrl,
                    type: 'DELETE',
                    // data: {
                    //     _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    // },
                    success: function (response) {
                        alert(response.success); // Show success message
                        location.reload(); // Reload the entire page

                        // window.location.href = document.referrer; // Redirect to the referrer page
                    },
                    error: function (xhr) {
                        alert('Error: ' + xhr.responseJSON.error); // Show error message
                    }
                });
            }
        });

    </script>
@endpush
