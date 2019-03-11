<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Home</title>
</head>

<body>
<h1>Liked user</h1>

<header>
Header
<ul>
    <li><a href="/home">Home</a></li>
    <li><a href="/">Logout</a></li>
    <li><a href="/post">Post</a></li>
</ul>
</header>
<hr>

<h2>Liked users</h2>

<!-- View uploaded image -->
@isset ($users)
<ul>
    @foreach ($users as $d)
        <li>{{ $d->name }}</li>
    @endforeach
</ul>
@endisset
<hr>

<footer>
Copyright by hogehoge.
</footer>

</body>
</html>