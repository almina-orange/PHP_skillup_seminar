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

    <!-- Script for preview post image
    Ref :: http://www.koikikukan.com/archives/2016/07/06-000300.php -->
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>
    $(function(){
        $('#file').change(function(){
            $('img').remove();
            var file = $(this).prop('files')[0];
            if(!file.type.match('image.*')){
                return;
            }
            var fileReader = new FileReader();
            fileReader.onloadend = function() {
                $('#result').html('<img src="' + fileReader.result + '"/>');
            }
            fileReader.readAsDataURL(file);
        });
    });
    </script>

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
    User : {{ $user->github_id }}<br>
    <input type="hidden" name="uid" value="{{ $user->id }}">
    <label for="photo">Imagefile :: </label>
    <input type="file" class="form-control" name="file" id="file">
    <div id="result"></div>
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