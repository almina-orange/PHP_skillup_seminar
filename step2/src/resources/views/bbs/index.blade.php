<!DOCTYPE HTML>
<html>
<head>
    <title>Board</title>
</head>
</html>

<body>

<h1>Board</h1>

<!-- Error message area -->
@if ($errors->any())
    <h2> Error message </h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<!-- Sent comment area -->
@isset($bbs)
    @foreach ($bbs as $d)
        <h2> Previous post by {{ $d->name }}  </h2>
        {{ $d->comment }}
        <br><hr>
    @endforeach
@endisset

<!-- Form area -->
<h2>Form</h2>
<form action="/bbs" method="POST">
    Name : <br>
    <input name="name">
    <br>

    <textarea name="comment" rows="4" cols="40"></textarea>
    <br>

    {{ csrf_field() }}  <!-- token -->

    <button class="btn btn-success"> Send </button>
</form>

</body>
</html>