@extends('layouts.app')

@section('content')
    <div class="card m-5 p-1">
        <div class="card-body">
            <h5 class="card-title">{{ $server->name }}</h5>

            <h6 class="card-subtitle mb-2 text-body-secondary opacity-50">{{ $server->version }} | {{ $server->serverId }}</h6>

            <section class="d-flex flex-wrap gap-2 justify-content-between">
                <div>
                    <span class="opacity-50">{{ __('Metrics status') }}:</span>
                    <span class="badge bg-light text-dark">{{ $server->metricsEnabled ? __('ENABLED') : __('DISABLED') }}</span>
                </div>

                <div>
                    <span class="opacity-50">{{ __('Creation date') }}:</span>
                    <span class="badge bg-light text-dark">{{ now()->parse($server->createdTimestampMs / 1000) }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This port will be used to create new keys.') }}">{{ __('Port') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->portForNewAccessKeys }}</span>
                </div>

                <div>
                    <span class="opacity-50">
                        <abbr title="{{ __('This hostname will be used to create new keys.') }}">{{ __('Hostname') }}</abbr>:
                    </span>
                    <span class="badge bg-light text-dark">{{ $server->hostnameForAccessKeys }}</span>
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

                <a href="{{ route('keys.create') }}" class="btn btn-light text-uppercase">{{ __('Create') }}</a>
            </div>


            <section class="d-flex flex-wrap gap-3 justify-content-start">
                @foreach($keys as $key)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $key->name ?: "Key-$key->id" }}</h5>
                            <div class="card-text py-2 mb-2">
                                <code>{{ $key->accessUrl }}</code>
                            </div>
                            <a href="#" class="btn btn-outline-secondary text-uppercase">{{ __('Rename') }}</a>
                            <form method="post" action="{{ route('keys.destroy', $key->id) }}">
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
