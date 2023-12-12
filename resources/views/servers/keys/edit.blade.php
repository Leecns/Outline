@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <h3>{{ __('Editing :key', ['key' => $key->name]) }}</h3>

        <form action="{{ route('servers.keys.update', [$server->id, $key->id]) }}" method="post">
            @csrf
            @method('PATCH')

            <section class="d-grid gap-3 my-3">
                <div class="input-group">
                    <span class="input-group-text">{{ __('Key name') }} <sup class="text-danger">*</sup></span>
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
