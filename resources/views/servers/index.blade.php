@extends('layouts.app')

@section('content')
    <a href="{{ route('servers.create') }}" class="btn btn-light text-uppercase">{{ __('Create') }}</a>

    <ul>
        @foreach($servers as $server)
            @if ($server->is_available)
                <li><a href="{{ route('servers.keys.index', $server->id) }}">{{ $server->name }}</a></li>
            @else
                <li>{{ $server->name }} ({{ __('Not Available') }})</li>
            @endif
        @endforeach
    </ul>
@endsection
