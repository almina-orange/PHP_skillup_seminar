<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Github</title>
</head>

<body>
    <form action="/account" method="post">
        {{ csrf_field() }}

        <div>Your name : <input type="text" name="name" value="{{$user->name}}"></div>
        <div>Comment : <input type="text" name="comment" value="{{$user->comment}}"></div>

        <input type="submit" value="Confirm">
    </form>
    <hr>

    <div>Welcome {{ $nickname }}!</div>
    <div>Your token is {{ $token }}.</div>
    <div>Repository list ::</div>
    <ul>
    @foreach($repos as $repo)
        <li>{{ $repo }}</li>
    @endforeach
    </ul>
    <hr>

    <form action="/github/issue" method="post">
        {{ csrf_field() }}

        <div>repo : <input type="text" name="repo"></div>
        <div>title : <input type="text" name="title"></div>
        <div>body : <input type="text" name="body"></div>

        <input type="submit" value="Confirm">
    </form>
</body>
</html>