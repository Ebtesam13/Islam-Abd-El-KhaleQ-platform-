@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 mb-5 page-header">
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="col-md-12">
                <div class="card card-post card-round">
                    @if($homework->video)
                        <iframe width="560" height="315" src="{{$homework->video}}"
                                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    @endif
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="info-post ms-2">
                                <p class="username">name: {{$homework->name}}</p>
                                <p class="date text-muted">Uploaded: {{$homework->created_at}}</p>
                            </div>
                        </div>
                        <div class="separator-solid"></div>
                        <p class="card-category text-info mb-1">
                            details
                        </p>
                        <p class="card-text">
                            Description: {{$homework->description}}
                        </p>
                        <a href="{{route('dashboard.homework.edit',['homework'=>$homework->id])}}" class="btn btn-primary btn-rounded btn-sm">Edit</a>
                        <form id="delete-form-{{ $homework->id }}" action="{{ route('dashboard.homework.destroy', ['homework'=>$homework->id]) }}"
                              method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="return confirmDelete({{$homework->id}})">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
@push('page-specific-scripts')
    <script>
        function confirmDelete(homeworkId) {
            let result = confirm("Are you sure you want to delete?");
            if (result) {
                document.getElementById('delete-form-' + homeworkId).submit();
            }
        }
    </script>
@endpush
