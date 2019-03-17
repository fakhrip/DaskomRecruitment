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
            <div class="body-box ui dimmable">
                {{-- <img src="/assets/bg-elektro.jpg" class="bg" alt="" id="bg_jurusan"> --}}
                <div id="app">
                    <caas-component user-data="{{ Auth::user() }}"></caas-component>
                </div>
                <div class="ui page dimmer">
                    <div class="content">
                        <h1 class="ui inverted header">Sorry i can't find the combination of this<br>nim and password 😕</h1>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
