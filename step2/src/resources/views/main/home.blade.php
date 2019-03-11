<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Home</title>
</head>

<body>
<h1>Welcome to Hinstagram!</h1>

<header>
Header
<ul>
    <li><a href="/home">Home</a></li>
    <li><a href="/">Logout</a></li>
    <li><a href="/post?uid={{ $user->id }}">Post</li>
    <li><a href="/user?uid={{ $user->id }}">MyPage</a></li>
</ul>
</header>
<hr>

<div>
<h2>Login user information</h2>
<ul>
    <li>UserID :: {{ $user->id }}</li>
    <li>Username :: {{ $user->name }}</li>
    <li>GitHubID :: {{ $user->github_id }}</li>
</ul>
</div>
<hr>

<!-- View uploaded image -->
<h2>Timeline</h2>
@isset ($images)
    @foreach ($images as $d)
        <div>
            ImageID :: {{ $d->id }}<br>
            Posted by <a href="/user?uid={{ $d->user_id }}">{{ $d->name }}</a>.<br>
            <img src="{{ asset('storage/' . $d->filepath) }}">
            <br>
            Caption :: {{ $d->caption }}<br>
            <a href="/like/list?iid={{ $d->id }}">Liked users</a><br>

            <form action="/like" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="iid" value="{{ $d->id }}">
                <input type="hidden" name="uid" value="{{ $user->id }}">
                <input type="submit" value="Like">
            </form>

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
    <form action="/" method="post">
        {{ csrf_field() }}
        <input type="submit" value="Previous">
    </form>

    <form action="/" method="post">
        {{ csrf_field() }}
        <input type="submit" value="Next">
    </form>
</div>
<hr>

<footer>
Copyright by hogehoge.
</footer>

</body>
</html>