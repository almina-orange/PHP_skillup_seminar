<!-- Check login status -->
<?php $stat = Illuminate\Support\Facades\Auth::check(); ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
</head>

<body>
<h1>Hinstagram</h1>

<header>
Header
@if ($stat)
    <ul>
        <li><a href="/home">Home</a></li>
        <li><a href="/logout">Logout</a></li>
        <li><a href="/post?uid={{ $user->id }}">Post</a></li>
    </ul>
@else
    <ul>
        <li><a href="/home">Home</a></li>
        <li><a href="/">Login</a></li>
        <li><a href="/">Post</a></li>
    </ul>
@endif
</header>
<hr>

@yield('content')

<footer>
Copyright by hogehoge.
</footer>

</body>
</html>