@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <div class="d-flex align-items-center gap-2">
            <a class="btn btn-tool" href="{{ route('servers.keys.index', $server->id) }}">
                <svg width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12q0-.2.063-.375T4.7 11.3l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z"/></svg>
            </a>
            <h2>{{ __('New key') }}</h2>
        </div>

        <form action="{{ route('servers.keys.store', $server->id) }}" method="post">
            @csrf

            <section class="d-grid gap-3 my-3">
                <div class="input-group">
                    <span class="input-group-text">{{ __('Key name') }} <sup class="error-message">*</sup></span>
                    <input class="form-control" type="text" name="name" required value="{{ old('name') }}" autofocus>
                </div>

                <div class="input-group">
                    <span class="input-group-text">{{ __('Data limit') }}</span>
                    <input class="form-control" type="number" min="0" max="100000" name="data_limit" value="{{ old('data_limit') }}">
                    <span class="input-group-text">
                        <select name="data_limit_unit" class="form-control py-0">
                            <option>KB</option>
                            <option selected>MB</option>
                            <option>GB</option>
                        </select>
                    </span>
                </div>

                <div class="input-group">
                    <span class="input-group-text">{{ __('Expiration time') }}</span>
                    <input class="form-control" type="datetime-local" name="expires_at" value="{{ old('expires_at') }}" min="{{ now()->format('Y-m-d\TH:i') }}">
                </div>
            </section>

            <button class="btn btn-primary">{{ __('Create') }}</button>
        </form>
    </section>
@endsection
