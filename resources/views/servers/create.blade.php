@extends('layouts.app')

@section('content')
    <section class="mt-5 px-5">
        <header class="d-flex justify-content-between align-items-center">
            <h2 class="text-center text-uppercase">{{ __('Add Servers') }}</h2>
        </header>

        <section class="d-grid gap-3 mt-3">
            <section>
                <h4>Follow the instructions below</h4>
                <p>These steps will help you install Outline on a Linux server.</p>
            </section>

            <section>
                <div>Log into your server, and run this command.</div>
                <textarea
                    class="form-control"
                    readonly
                    rows="6"
                    required>{{ config('outline.setup_script') }}</textarea>
            </section>

            <section>
                <div>Paste your installation output here.</div>
                <form action="{{ route('servers.store') }}" method="post">
                    @csrf

                    <section>
                        <textarea
                            class="form-control"
                            rows="6"
                            name="api_url_and_cert_sha256"
                            placeholder="{{ config('outline.setup_script_output_example') }}"
                            required>{{ old('api_url_and_cert_sha256') }}</textarea>
                        @error('api_url_and_cert_sha256')
                            <smal class="text-danger">{{ $message }}</smal>
                        @enderror
                    </section>

                    <section class="d-flex justify-content-between gap-2 mt-3">
                        <button class="btn btn-primary text-uppercase">{{ __('Add') }}</button>
                        <a href="{{ route('servers.index') }}" class="btn btn-light text-uppercase">{{ __('Cancel') }}</a>
                    </section>
                </form>
            </section>
        </section>
    </section>


@endsection
