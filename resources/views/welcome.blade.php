<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Solutech</title>

        <!-- Default app css -->
        <link href="https://solutech.herokuapp.com/css/app.css" rel="stylesheet">
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="https://solutech.herokuapp.com/js/app.js" defer></script>
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    </head>
    <body>
        <div id="app">

            <router-view ></router-view>
            {{-- <products /> --}}

        </div>

    </body>
</html>
