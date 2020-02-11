<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield ('head')
<body>
    @yield ('header')
    <main>
        @yield ('content')
    </main>
    @yield ('footer')
</body>
    @yield ('script')
</html>
