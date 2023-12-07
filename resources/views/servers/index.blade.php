@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <header class="d-flex justify-content-between align-items-center">
            <h2 class="text-center text-uppercase">{{ __('Your Servers') }}</h2>

            <a href="{{ route('servers.create') }}" class="btn btn-light text-uppercase">{{ __('Add') }}</a>
        </header>

        <search class="mx-auto my-3">
            <form action="{{ route('servers.index') }}" class="d-flex justify-content-between align-items-center">
                <label for="search">
                    <svg width="24" height="24" viewBox="0 0 24 24" class="search-icon">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                            <path stroke-dasharray="16" stroke-dashoffset="16" d="M10.5 13.5L3 21">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="16;0"/>
                            </path>
                            <path stroke-dasharray="40" stroke-dashoffset="40" d="M10.7574 13.2426C8.41421 10.8995 8.41421 7.10051 10.7574 4.75736C13.1005 2.41421 16.8995 2.41421 19.2426 4.75736C21.5858 7.10051 21.5858 10.8995 19.2426 13.2426C16.8995 15.5858 13.1005 15.5858 10.7574 13.2426Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="40;0"/>
                            </path>
                        </g>
                    </svg>
                </label>
                <input id="search" class="w-100" type="search" name="q" value="{{ request()->input('q') }}" placeholder="Name or IP..." />
                <button>Search</button>
            </form>
        </search>

        <section class="servers d-flex flex-wrap justify-content-center gap-3">
            @foreach($servers as $server)
                @if ($server->is_available)
                    <section class="server-card rounded-3 pb-0 pt-3">
                        <section class="text-center">
                            <img src="https://img.icons8.com/?size=128&id=v8VaWVgXmNCx&format=png" alt="Location flag" class="location-flag"/>
                        </section>
                        <section class="text-center">{{ $server->name }}</section>
                        {{-- TODO: change this to original_hostname --}}
                        <section class="ip mx-auto mt-2 mb-3">{{ $server->hostname_for_new_access_keys }}</section>
                        <section class="actions text-uppercase">
                            <a href="" class="btn p-2 w-100 text-uppercase edit-action">{{ __('Edit') }}</a>
                        </section>
                    </section>
                @else
                    <li>{{ $server->name }} ({{ __('Not Available') }})</li>
                @endif
            @endforeach
        </section>
    </section>
@endsection
