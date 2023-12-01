@extends('layouts.app')

@section('content')
    <h3>{{ __('New key') }}</h3>
    <form action="{{ route('keys.store') }}" method="post">
        @csrf

        <label>
            <span>{{ __('Key name') }}:</span>
            <input type="text" name="name" required>
        </label>

        <button>{{ __('Create') }}</button>
    </form>
@endsection
