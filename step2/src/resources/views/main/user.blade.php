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
<ul>
    <li><a href="/home">Home</a></li>
    <li><a href="/">Logout</a></li>
    <li><a href="/post">Post</a></li>
</ul>
</header>
<hr>

<div>
<h2>User information</h2>
<ul>
    <li>Icon :: <img src="{{ $avatar }}"></li>
    <li>GitHub ID :: {{ $user->github_id }}</li>
    <li>Liked :: </li>
</ul>
<!-- <a href="/edit?name={{ $user->name }}&icon={{ $user->icon }}">Edit</a> -->
</div>
<hr>

<h2>Posted photos</h2>

<!-- View uploaded image -->
@isset ($images)
    @foreach ($images as $d)
        <div>
            ID :: {{ $d->id }}<br>
            <img src="{{ asset('storage/' . $d->filepath) }}">
            <br>
            Caption :: {{ $d->caption }}<br>
            Liked users :: <br>
            <ul>
                <li>user1</li>
                <li>user2</li>
                <li>user3</li>
            </ul>

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

<hr>
<footer>
Copyright by hogehoge.
</footer>

</body>
</html>