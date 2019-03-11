<!-- Error message -->
@if ($errors->any())
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
@endif

<!-- Form -->
<form action="{{ url('upload') }}" method="post" enctype="multipart/form-data">

    <!-- View uploaded image -->
    @isset ($filenames)
        @foreach ($filenames as $f)
            <div>
            <img src="{{ asset('storage/' . $f->filepath) }}">
            <br>
            Posted by {{ $f->name }}.<br>
            </div>
            <hr>
        @endforeach
    @endisset

    Name ::
    <input type="text" name="name">
    <br>
    <label for="photo">Imagefile :: </label>
    <input type="file" class="form-control" name="file">
    <br>
    <hr>
    {{ csrf_field() }}
    <button class="btn btn-success"> Upload </button>
</form>