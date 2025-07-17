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
                    <h2>{{ __('Code Details') }}</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <td>{{ $code->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Combination') }}</th>
                            <td>{{ $code->combination }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <td>{{ ucfirst($code->status) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Expiry Days') }}</th>
                            <td>{{ $code->expiry_days }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Associated Lesson') }}</th>
                            <td>{{ $code->lesson ? $code->lesson->name : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Created At') }}</th>
                            <td>{{ $code->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Updated At') }}</th>
                            <td>{{ $code->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Used By Students') }}</th>
                            <td>
                                @if(count($studentsUsedThisCode))
                                    <ul>
                                        @foreach($studentsUsedThisCode as $record)
                                            <li>{{ $record->student->name }}
                                                <span class="text-primary"> (Accessed At: {{ $record->created_at }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-danger">{{ __('No students have used this code yet.') }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('dashboard.codes.index') }}" class="btn btn-secondary">{{ __('Back to Codes') }}</a>
                        <a href="{{ route('dashboard.codes.edit', $code->id) }}" class="btn btn-primary">{{ __('Edit Code') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
