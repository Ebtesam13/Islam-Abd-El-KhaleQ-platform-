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
                    <div class="py-12">
                        <div class="">
                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-specific-scripts')
        <script>
        // Function to open the modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        // Function to close the modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    </script>>
@endpush
