<!DOCTYPE html>
<html class="bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Merriweather|Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

        <!-- Stylesheets -->
        <link href="{{ mix('/css/main.css') }}" rel="stylesheet">
        <link href="/css/fonts.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.1/build/highlight.min.js"></script>
        <script src="{{ mix('/js/main.js') }}" defer></script>
        @routes
    </head>

    <body class="bg-gray-200 font-lato leading-normal tracking-normal">
        @inertia

        <script src="https://js.stripe.com/v3/"></script>
    </body>

</html>
