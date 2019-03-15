<!-- Check login status -->
<?php $stat = Illuminate\Support\Facades\Auth::check(); ?>

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
<h2>Login user information</h2>
@if (is_null($user))
@else
    <ul>
        <li>UserID :: {{ $user->id }}</li>
        <li>User :: <a href="user?uid={{ $user->id }}">{{ $user->github_id }}</a></li>
    </ul>
@endif
</div>
<hr>

<!-- View uploaded image -->
<h2>Timeline</h2>
@isset ($images)
    @foreach ($images as $d)
        <div>
            ImageID :: {{ $d->id }}<br>
            Posted by <a href="/user?uid={{ $d->user_id }}">{{ $d->github_id }}</a>.<br>
            <img src="data:image/png;base64,<?= $d->image ?>">
            <br>
            Caption :: {{ $d->caption }}<br>
            <a href="/like/list?iid={{ $d->id }}">Liked users</a><br>

            @if (is_null($user))
            @else
                <?php
                    $row = App\Model\Like::where('image_id', $d->id)
                                        ->where('user_id', $user->id)
                                        ->get();
                    if (count($row) != 0) { 
                ?>
                        <div>You already liked this post!</div><br>
                <?php
                    }
                ?>

                <form action="/like" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="iid" value="{{ $d->id }}">
                    <input type="hidden" name="uid" value="{{ $user->id }}">
                    <input type="submit" value="Like">
                </form>
            @endif

            @if (is_null($user))
            @else
                @if ($d->github_id == $user->github_id)
                    <form action="/post/delete" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $d->id }}">
                        <input type="submit" value="Delete">
                    </form>
                @endif
            @endif
        </div>
        <hr>
    @endforeach
@endisset

<div>
    @if ($pg > 1)
        <a href="home?pg={{ $pg - 1 }}">Previous</a>
    @endif
    Page : {{ $pg }} / {{ $maxPg }}
    @if ($pg < $maxPg)
        <a href="home?pg={{ $pg + 1 }}">Next</a>
    @endif
</div>
<hr>

<footer>
Copyright by hogehoge.
</footer>

</body>
</html>