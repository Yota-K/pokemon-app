<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield ('head')
<body>
    <div id="app">
            @yield ('header')
        <main class="py-4">
            @yield ('content')
        </main>
            @yield ('footer')
    </div>
</body>
</html>
