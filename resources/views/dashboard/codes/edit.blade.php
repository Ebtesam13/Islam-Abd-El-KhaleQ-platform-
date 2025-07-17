@extends('dashboard.partials.layout')

@section('content')
    <!-- About Start -->
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
                @if(Session::has('message'))
                    @foreach(Session::get('message') as $class => $message)
                        <p class="alert {{ $class }}">{{ $message }}</p>
                    @endforeach
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Edit Code') }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.codes.update', $code->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="combination">{{ __('Combination') }}</label>
                            <input type="text" class="form-control" id="combination" name="combination"
                                   value="{{ old('combination', $code->combination) }}" required autofocus disabled>
                        </div>
                        @error('combination')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="status">{{ __('Status') }}</label>
                            <input type="text" class="form-control" id="status"
                                   value="{{ old('status', $code->status) }}" disabled>
{{--                            <select class="form-select" name="status" id="status" required>--}}
{{--                                <option value="created" {{ $code->status === 'created' ? 'selected' : '' }}>--}}
{{--                                    {{ __('Created') }}--}}
{{--                                </option>--}}
{{--                                <option value="valid" {{ $code->status === 'valid' ? 'selected' : '' }}>--}}
{{--                                    {{ __('Valid') }}--}}
{{--                                </option>--}}
{{--                            </select>--}}
                        </div>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="expiry_days">{{ __('Expiry Days') }} (Max: {{ $maxExpiryDays }})</label>
                            <input type="number" class="form-control" id="expiry_days" name="expiry_days"
                                   value="{{ old('expiry_days', $code->expiry_days) }}"
                                   max="{{ $maxExpiryDays }}"
                                   {{ $code->status !== 'created' ? 'disabled' : '' }} required>
                        </div>
                        @error('expiry_days')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="lesson_id">{{ __('Lesson') }}</label>
                            <input type="text" class="form-control" value="{{$code->lesson ? $code->lesson->name : ""}}" required autofocus disabled>
                        </div>
                        @error('lesson_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">{{ __('Update Code') }}</button>
                        <a href="{{ route('dashboard.codes.show', $code->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Script to handle expiry_days -->
    @push('page-specific-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const statusField = document.getElementById('status');
                const expiryDaysField = document.getElementById('expiry_days');

                statusField.addEventListener('change', function () {
                    if (statusField.value === 'created') {
                        expiryDaysField.disabled = false;
                    } else {
                        expiryDaysField.disabled = true;
                    }
                });
            });
        </script>
    @endpush
@endsection
@push('page-specific-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusField = document.getElementById('status');
            const expiryDaysField = document.getElementById('expiry_days');
            const maxExpiryDays = {{ $maxExpiryDays }};

            statusField.addEventListener('change', function () {
                if (statusField.value === 'created') {
                    expiryDaysField.disabled = false;
                } else {
                    expiryDaysField.disabled = true;
                    expiryDaysField.value = '';
                }
            });

            expiryDaysField.addEventListener('input', function () {
                if (expiryDaysField.value > maxExpiryDays) {
                    expiryDaysField.value = maxExpiryDays;
                }
            });
        });
    </script>
@endpush
