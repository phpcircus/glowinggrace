<!DOCTYPE html>
<html class="bg-gray-200">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link href="{{ mix('/css/main.css') }}" rel="stylesheet">
        <link href="/css/fonts.css" rel="stylesheet">
        <script src="{{ mix('/js/main.js') }}" defer></script>
        @routes
    </head>

    <body class="bg-gray-200 font-lato leading-normal tracking-normal">
        @inertia
    </body>

</html>
