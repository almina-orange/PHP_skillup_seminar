<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Info</title>
</head>

<body>
<div>{{ $info }}</div><hr>
<a href="/logout">logout</a>
<a href="/">back</a>
</body>
</html>