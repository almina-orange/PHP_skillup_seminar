<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>github</title>
    </head>
    <body>
        <div>{{ $info }}</div><hr>
        <div>Token :: {{ $token }}</div><hr>
        <div>Response :: {{ $res }}</div><hr>
        <div><img src="{{ $res }}"></div><hr>
    </body>
</html>