@extends('layouts.app')

@section('content')
    <h3>{{ __('New Server') }}</h3>
    <form action="{{ route('servers.store') }}" method="post">
        @csrf

        <label>
            <span>{{ __('Server API URL and certificate sha256') }}:</span>
            <textarea type="text" name="api_url_and_cert_sha256" required>{{ old('api_url_and_cert_sha256') }}</textarea>
        </label>

        <button>{{ __('Create') }}</button>
    </form>
@endsection
