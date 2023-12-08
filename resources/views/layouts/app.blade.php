<!doctype html>
<html lang="en">

@include('includes.head')

<body data-bs-theme="dark" style="background-image: url('{{ asset('assets/images/world.jpg') }}')">

<div class="overlay py-5">
    <div class="container ">
        @include('includes.header')

        <main>
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
