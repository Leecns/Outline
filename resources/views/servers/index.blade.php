@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <header class="d-flex justify-content-between align-items-center">
            <h2 class="text-center text-uppercase">{{ __('Your Servers') }}</h2>

            <a href="{{ route('servers.create') }}" class="btn btn-light text-uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="18" stroke-dashoffset="18" stroke-linecap="round" stroke-width="2"><path d="M12 5V19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.3s" values="18;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="18;0"/></path></g></svg>
                <span>{{ __('Add') }}</span>
            </a>
        </header>

        @if ($numberOfServers > 0)
            <search class="mx-auto my-3">
                <form action="{{ route('servers.index') }}" class="d-flex justify-content-between align-items-center">
                    <div class="input-group mb-3">
                        <label for="search" class="input-group-text">
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
                        <input id="search" autofocus class="form-control" type="search" name="q" value="{{ request()->input('q') }}" placeholder="Name or IP..." />
                    </div>

                </form>
            </search>
        @endif

        @if ($numberOfServers === 0)
            <section class="rounded-3 p-3 text-center text-uppercase mt-5">
                <p>{{ __("You haven't added any server yet!") }}</p>

                <a href="{{ route('servers.create') }}" class="btn btn-light">
                    <span>{{ __('Add first one') }}</span>
                </a>
            </section>

        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('IP Address') }}</th>
                        <th>{{ __('Number of Keys') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servers as $server)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $server->id }}</td>
                            <td>{{ $server->name }}</td>
                            {{-- TODO: change this to hostname --}}
                            <td>{{ $server->hostname_for_new_access_keys }}</td>
                            <td><span class="badge bg-light text-dark">{{ $server->keys()->count() }}</span></td>
                            <td>
                                @if ($server->is_available)
                                    <a href="{{ route('servers.keys.index', $server->id) }}" class="btn btn-sm btn-light">{{ __('Manage') }}</a>
                                @else
                                    <span class="badge bg-danger">{{ __('Not Available') }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">
                                <section class="p-3 text-center d-grid align-items-center text-uppercase">
                                    <div>¯\_(ツ)_/¯</div>
                                    <div>{{ __("No result!") }}</div>
                                </section>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </section>
@endsection
