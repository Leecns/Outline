@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <header class="d-flex justify-content-between align-items-center">
            <h2 class="text-center text-uppercase">{{ __('Editable information') }}</h2>
            <a class="btn btn-outline-light" href="{{ route('servers.keys.index', $server->id) }}">{{ __('Back') }}</a>
        </header>

        <form class="d-grid gap-3 mt-3" action="{{ route('servers.update', $server->id) }}" method="post">
            @csrf
            @method('PATCH')
            <section>
                <div class="input-group">
                    <span class="input-group-text">{{ __('Name') }} <sup class="text-danger">*</sup></span>
                    <input class="form-control" type="text" name="name" required value="{{ old('name', $server->name) }}" autofocus>
                </div>
                <small class="text-muted">{{ __('Set a new name for your server. Note that this will not be reflected on the devices of the users that you invited to connect to it.') }}</small>
                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
            </section>

            <section class="d-flex gap-3">
                <section>
                    <div class="input-group">
                        <span class="input-group-text">{{ __('Hostname or IP for new access keys') }} <sup class="text-danger">*</sup></span>
                        <input class="form-control" type="text" name="hostname_for_new_access_keys" required value="{{ old('hostname_for_new_access_keys', $server->hostname_for_new_access_keys) }}" autofocus>
                    </div>
                    @error('port_for_new_access_keys')<small class="text-danger">{{ $message }}</small>@enderror
                </section>

                <section>
                    <div class="input-group">
                        <span class="input-group-text">{{ __('Port for new access keys (Max: 65535)') }} <sup class="text-danger">*</sup></span>
                        <input class="form-control" type="text" name="port_for_new_access_keys" required value="{{ old('port_for_new_access_keys', $server->port_for_new_access_keys) }}" autofocus>
                    </div>
                    @error('port_for_new_access_keys')<small class="text-danger">{{ $message }}</small>@enderror
                </section>
            </section>

            <section class="d-flex justify-content-between">
                <button class="btn btn-light">{{ __('Update') }}</button>
            </section>
        </form>

        <section class="mt-5">
            <h3 class="text-uppercase">{{ __('Remove this server') }}</h3>
            <p>{{ __("Please note that this action will only remove the server from the :app's database. The server itself will not be affected.", ['app' => config('app.name')]) }}</p>

            <form action="{{ route('servers.destroy', $server->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">{{ __('Remove') }}</button>
            </form>
        </section>
    </section>


@endsection
