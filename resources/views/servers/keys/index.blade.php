@extends('layouts.app')

@section('content')
    <div class="card m-5 p-1">
        <div class="card-body">
            <h5 class="card-title">{{ $server->name }}</h5>

            <h6 class="card-subtitle mb-2 text-body-secondary opacity-50">{{ $server->version }} | {{ $server->api_id }}</h6>

            <section class="d-flex flex-wrap gap-2 justify-content-between">
                <div>
                    <span class="opacity-50">{{ __('Metrics status') }}:</span>
                    <span class="badge bg-light text-dark">{{ $server->is_metrics_enabled ? __('ENABLED') : __('DISABLED') }}</span>
                </div>

                <div>
                    <span class="opacity-50">{{ __('Creation date') }}:</span>
                    <span class="badge bg-light text-dark">{{ $server->api_created_at }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This port will be used to create new keys.') }}">{{ __('Port') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->port_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This hostname will be used to create new keys.') }}">{{ __('Hostname') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->hostname_for_new_access_keys }}</span>
                </div>

                <div>
                    <span class="opacity-50">{{ __('Number of keys') }}:</span>
                    <span class="badge bg-light text-dark">{{ $keys->count() }}</span>
                </div>
            </section>
        </div>
    </div>

    <div class="card m-5 p-1">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between gap-2 align-items-center mb-3">
                <h5>{{ __('Keys') }}</h5>

                <a href="{{ route('servers.keys.create', $server->id) }}" class="btn btn-light text-uppercase">{{ __('Create') }}</a>
            </div>


            <section class="d-flex flex-wrap gap-3 justify-content-start">
                @foreach($keys as $key)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $key->name ?: "Key-$key->id" }}</h5>
                            <div class="card-text py-2 mb-2">
                                <code>{{ $key->access_url }}</code>
                            </div>
                            <a href="{{ route('servers.keys.edit', [$server->id, $key->id]) }}" class="btn btn-outline-secondary text-uppercase">{{ __('Edit') }}</a>
                            <form method="post" action="{{ route('servers.keys.destroy', [$server->id, $key->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger text-uppercase">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
