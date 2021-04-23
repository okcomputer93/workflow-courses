<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/df1c4e8a69.js" crossorigin="anonymous"></script>
    <!-- Use push and endpush to stack specific scripts here -->
    @stack('scripts')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if ($head->isEmpty())
        <title>Workflow</title>
    @else
        {{ $head }}
    @endif
</head>
<body>

    @props([
            'header' => 'true',
            'footer' => 'true'
        ])

    @if ($header === 'true')
        <x-header auth="true">
            <x-nav-link route="home">Home</x-nav-link>
            <x-nav-link route="courses">Cursos</x-nav-link>
            <x-nav-link route="aboutus">Nosotros</x-nav-link>
        </x-header>
    @endif
        {{ $slot }}
    @if ($footer === 'true')
        <x-footer>
            <x-nav-link-footer route="aboutus">Nosotros</x-nav-link-footer>
            <x-nav-link-footer route="courses">Cursos</x-nav-link-footer>
            <x-nav-link-footer route="accesibility">Accesibilidad</x-nav-link-footer>
            <x-nav-link-footer route="sale">Promociones</x-nav-link-footer>
        </x-footer>
    @endif
</body>
</html>
