<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="apple-mobile-web-app-capable" content="yes" />

        <title>Faitechno</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <main id="swup">
            <div class="body-box">
                <canvas id="main-canvas"></canvas>
                <img src="/assets/background.png" class="bg" alt="">
                <div class="main-box" id="app">
                    <login class="login-content"></login>
                </div>
            </div>
        </main>
    </body>
</html>
