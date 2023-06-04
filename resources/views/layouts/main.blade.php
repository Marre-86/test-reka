<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />

        <title>{{ config('app.name') }}</title>
                <!-- Scripts -->
                @vite(['resources/js/app.js', 'resources/scss/app.scss'])
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
                
    </head>
    <body class="container-fluid">
        <div id="app">
            <header class="fixed w-full"  style="position: relative; margin-bottom:1em">
                @include('layouts.partials.navbar')
            </header>

            <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 2500)">
                @if (session()->has('flash_notification'))               
                    <div style="z-index: 3; position: absolute; top: 10%; left: 40%;  width: 30%; text-align: center;">
                        @include('flash::message')
                    </div>
                @endif
            </div>

            <div class="container-xxl">
                @yield('content')
            </div>

        </div>
    </body>
</html>