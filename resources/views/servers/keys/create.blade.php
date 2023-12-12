@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <h3>{{ __('New key') }}</h3>

        <form action="{{ route('servers.keys.store', $server->id) }}" method="post">
            @csrf

            <section class="d-grid gap-3 my-3">
                <div class="input-group">
                    <span class="input-group-text">{{ __('Key name') }} <sup class="text-danger">*</sup></span>
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
