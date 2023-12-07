<header>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('servers.index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2.284 21.541A11.987 11.987 0 0 1 0 14.483C0 7.842 5.373 2.46 12 2.46c6.628 0 12 5.383 12 12.024a11.985 11.985 0 0 1-2.284 7.058l-5.763-9.378l-.557.942l.565 2.619L12 8.934l-2.45 4.145l.57 2.645l-2.076-3.556l-5.76 9.373z"/>
                </svg>
                <strong class="text-uppercase">{{ config('app.name') }}</strong>
            </a>
        </div>
    </nav>
</header>

