<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield ('head')
<body>
    @yield ('header')
    <main class="py-4">
        @yield ('content')
    </main>
    @yield ('footer')
</body>
</html>
