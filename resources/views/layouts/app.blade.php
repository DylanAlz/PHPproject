<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
    <body>

        @include('layouts.header')

        <main class="main" id="main">
            @yield('content')
        </main>

        @include('layouts.footer')

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        @include('layouts.scripts')

    </body>
</html>
