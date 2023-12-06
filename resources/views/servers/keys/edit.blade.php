@extends('layouts.app')

@section('content')
    <h3>{{ __('Editing :key', ['key' => $key->name]) }}</h3>
    <form action="{{ route('servers.keys.update', [$server->id, $key->id]) }}" method="post">
        @csrf
        @method('PATCH')

        <label>
            <span>{{ __('Key name') }}:</span>
            <input type="text" name="name" required value="{{ old('name', $key->name) }}">
        </label>

        <button>{{ __('Update') }}</button>
    </form>
@endsection
