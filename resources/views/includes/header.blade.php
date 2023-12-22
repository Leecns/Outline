<header>
    <nav class="d-flex justify-content-between flex-wrap">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('servers.index') }}">
            <x-svg.app />
            <strong class="text-uppercase">{{ config('app.name') }}</strong>
        </a>

        <section>
            <a class="text-white" href="{{ config('app.github_url') }}" target="_blank">
                <x-svg.github width="24" height="24" />
            </a>
        </section>
    </nav>
</header>

