<!-- Check login status -->
<?php $stat = Illuminate\Support\Facades\Auth::check(); ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>User</title>
</head>

<body>
<h1>User page</h1>

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

<div>
<h2>User information</h2>
<ul>
    <li>Icon :: <img src="https://github.com/{{ $user->github_id }}.png"></li>
    <li>GitHub ID :: {{ $user->github_id }}</li>
    <li>Liked :: {{ $likes }}</li>
    <li>Posting :: {{ $posts }}</li>
</ul>
<!-- <a href="/edit?name={{ $user->name }}&icon={{ $user->icon }}">Edit</a> -->
</div>
<hr>

<h2>Posted photos</h2>

<!-- View uploaded image -->
@isset ($images)
    @foreach ($images as $d)
        <div>
            ImageID :: {{ $d->id }}<br>
            <img src="data:image/png;base64,<?= $d->image ?>">
            <br>
            Caption :: {{ $d->caption }}<br>

            @if ($d->name == "user")
                <form action="/post/delete" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <input type="submit" value="Delete">
                </form>
            @endif
        </div>
        <hr>
    @endforeach
@endisset

<div>
    @if ($pg > 1)
        <a href="user?uid={{ $user->id }}&pg={{ $pg - 1 }}">Previous</a>
    @endif
    Page : {{ $pg }} / {{ $maxPg }}
    @if ($pg < $maxPg)
        <a href="user?uid={{ $user->id }}&pg={{ $pg + 1 }}">Next</a>
    @endif
</div>

<hr>
<footer>
Copyright by hogehoge.
</footer>

</body>
</html>