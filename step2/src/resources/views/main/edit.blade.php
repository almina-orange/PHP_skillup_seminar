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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit</title>
</head>

<body>
<header>
Header
<ul>
    <li><a href="/home">Home</a></li>
    <li><a href="/">Logout</a></li>
    <li><a href="/post">Post</a></li>
</ul>
</header>
<hr>

<form action="{{ url('/edit/update') }}" method="post" enctype="multipart/form-data">
    <div>name : <input type="text" name="name" value="{{ $user }}"></div>
    <label for="photo">Iconfile : </label>
    <input type="file" class="form-control" name="icon">
    <br>

    {{ csrf_field() }}

    <input type="submit" value="Confirm">
</form>
</body>
</html>