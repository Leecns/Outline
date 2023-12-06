@extends('layouts.app')

@section('content')
    <a href="{{ route('servers.create') }}" class="btn btn-light text-uppercase">{{ __('Create') }}</a>

    <ul>
        @foreach($servers as $server)
            <li><a href="{{ route('servers.keys.index', $server->id) }}">{{ $server->name }}</a></li>
        @endforeach
    </ul>
@endsection
