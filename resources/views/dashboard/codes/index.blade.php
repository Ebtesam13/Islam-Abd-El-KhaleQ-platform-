@extends('dashboard.partials.layout')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="card">
                <div class="card-body">
                    <table id="codes-table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Combination</th>
                            <th>Status</th>
                            <th>Expiry Days</th>
                            <th>Lesson ID</th>
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

            $('#codes-table').DataTable({
                ajax: '{{ route('codes.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'combination', name: 'combination' },
                    { data: 'status', name: 'status' },
                    { data: 'expiry_days', name: 'expiry_days' },
                    { data: 'lesson_name', name: 'lesson_name', title: 'Lesson Name' }, // Add this column
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });

        var deleteUrl = "{{ route('dashboard.codes.destroy', ':id') }}";
        $(document).on('click', '.delete-button', function (e) {
            e.preventDefault();
            var codeId = $(this).data('id'); // Get the code ID
            var finalUrl = deleteUrl.replace(':id', codeId); // Replace placeholder with codeId

            if (confirm('Are you sure you want to delete this code?')) {
                $.ajax({
                    url: finalUrl,
                    type: 'DELETE',
                    success: function (response) {
                        alert(response.success); // Show success message
                        location.reload(); // Reload the page to update the table
                    },
                    error: function (xhr) {
                        alert('Error: ' + (xhr.responseJSON?.error || 'Something went wrong.')); // Show error message
                    }
                });
            }
        });
    </script>
@endpush
