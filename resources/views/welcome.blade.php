<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100 w-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Exercise</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="h-100 w-100">
    <div id="app" class="container py-5"></div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>