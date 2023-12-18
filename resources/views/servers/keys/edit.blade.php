@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <div class="d-flex align-items-center gap-2">
            <a class="btn btn-tool" href="{{ route('servers.keys.index', $server->id) }}">
                <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12q0-.2.063-.375T4.7 11.3l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z"/></svg>
            </a>
            <h2>{{ __('Editing :key', ['key' => $key->name]) }}</h2>
        </div>

        <form action="{{ route('servers.keys.update', [$server->id, $key->id]) }}" method="post">
            @csrf
            @method('PATCH')

            <section class="d-grid gap-3 my-3">
                <div class="input-group">
                    <span class="input-group-text">{{ __('Key name') }} <sup class="error-message">*</sup></span>
                    <input class="form-control" type="text" name="name" required value="{{ old('name', $key->name) }}" autofocus>
                </div>
                @error('name')
                    <small>{{ $message }}</small>
                @enderror

                <div class="input-group">
                    <span class="input-group-text">{{ __('Data limit') }}</span>
                    <input class="form-control" type="text" name="data_limit" value="{{ old('data_limit', $key->data_limit ? round($key->data_limit / pow(1024, 2), 2) : null) }}">
                    <span class="input-group-text">
                        <select name="data_limit_unit" class="form-control py-0">
                            <option>KB</option>
                            <option selected>MB</option>
                            <option>GB</option>
                        </select>
                    </span>
                </div>

                @error('data_limit')
                    <small>{{ $message }}</small>
                @enderror

                <div class="input-group">
                    <span class="input-group-text">{{ __('Expiration time') }}</span>
                    <input class="form-control" type="datetime-local" name="expires_at" id="expiresAt" value="{{ old('expires_at', $key->expires_at?->format('Y-m-d\TH:i')) }}" min="{{ now()->format('Y-m-d\TH:i') }}">
                    <span class="input-group-text">
                        <button type="button" class="btn btn-sm btn-dark" onclick="expiresAt.value = ''">{{ __('Clear') }}</button>
                    </span>
                </div>

                @error('expires_at')
                    <small>{{ $message }}</small>
                @enderror
            </section>

            <button class="btn btn-primary">{{ __('Update') }}</button>
        </form>
    </section>
@endsection
