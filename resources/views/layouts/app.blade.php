<!doctype html>
<html lang="en">

@include('includes.head')

<body data-bs-theme="dark">

<div class="container mt-5">
    @include('includes.header')

    <main>
        @yield('content')
    </main>
</div>

@yield('footer-stuff')

</body>
</html>
