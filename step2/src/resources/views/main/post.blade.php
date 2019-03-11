<!-- Error message -->
@if ($errors->any())
<H2>Error has occured!</h2>
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
<hr>
@endif

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Home</title>
</head>

<body>
<h1>Post page</h1>

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
<h2>Post form</h2>
<!-- Form -->
<form action="{{ url('post/upload') }}" method="post" enctype="multipart/form-data">
    User : {{ $user->name }}<br>
    <input type="hidden" name="uid" value="{{ $user->id }}">
    <label for="photo">Imagefile :: </label>
    <input type="file" class="form-control" name="file">
    <br>
    
    Caption : <br>
    <textarea name="caption" rows="4" cols="40"></textarea>
    <br>
    <hr>
    {{ csrf_field() }}
    <button class="btn btn-success"> Upload </button>
</form>
</div>
<hr>

<footer>
Copyright by hogehoge.
</footer>

</body>
</html>