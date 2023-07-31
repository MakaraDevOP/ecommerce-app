<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/icon.jpg">
    <title>Ecommerce Managements</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
</head>

<body class="antialiased">
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
