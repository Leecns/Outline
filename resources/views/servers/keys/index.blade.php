@extends('layouts.app')

@section('content')
    <h3>{{ $server->name }} <sub>{{ $server->version }}</sub></h3>
    <section class="d-flex gap-2">
        <div>{{ __('Server ID') }}: {{ $server->serverId }}</div>
        <div>{{ __('Is metrics enabled') }}: {{ $server->metricsEnabled ? __('YES') : __('NO') }}</div>
        <div>{{ __('Creation date') }}: {{ now()->parse($server->createdTimestampMs / 1000) }}</div>
        <div><abbr title="{{ __('This port will be used to create new keys.') }}">{{ __('Port') }}</abbr>: {{ $server->portForNewAccessKeys }}</div>
        <div><abbr title="{{ __('This hostname will be used to create new keys.') }}">{{ __('Hostname') }}</abbr>: {{ $server->hostnameForAccessKeys }}</div>
        <div>{{ __('Number of keys:') }}: {{ $keys->count() }}</div>
    </section>

    <section>
        <h4>{{ __('Keys') }}</h4>
        <a href="{{ route('keys.create') }}">{{ __('Create') }}</a>
    </section>

    <section>
        @foreach($keys as $key)
            <section>
                <div>{{ $key->id }}</div>
                <div>{{ $key->name }}</div>
                <div>{{ $key->port }}</div>
                <div>{{ $key->method }}</div>
                <div>{{ is_null($key->dataLimitInBytes) ? __('No Limit') : $key->dataLimitInBytes  }}</div>
            </section>
        @endforeach
    </section>
@endsection
