@extends('../../layouts/my')
@section('title', 'Favorite')
@section('content')
<!-- View uploaded image -->
<div class="container">
    <h2>Favorites</h2>
    <div class="card-deck">
        @isset ($images)
            @foreach ($images as $d)
                <div class="card" style="min-width: 21rem; max-width: 21rem;">
                    <img src="data:image/png;base64,{{ $d->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $d->caption }}</p>
                            <footer class="blockquote-footer">Posted by <a href="/user?uid={{ $d->user_id }}">{{ $d->github_id }}</a></footer>
                        </blockquote>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#" class="card-link">liked users</a></li>
                    </ul>
                    <div class="card-body">
                        @guest
                            <button class="card-link btn btn-primary" disabled> Like </button>
                        @else
                            <form action="/like" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="iid" value="{{ $d->id }}">
                                <input type="hidden" name="uid" value="{{ $user->id }}">

                                <?php
                                    $row = App\Model\Like::where('image_id', $d->id)
                                                        ->where('user_id', $user->id)
                                                        ->get();
                                    if (count($row) != 0) { 
                                ?>
                                        <button class="card-link btn btn-secondary"> Dismiss </button>
                                <?php
                                    } else {
                                ?>
                                        <button class="card-link btn btn-primary"> Like </button>
                                <?php
                                    }
                                ?>
                            </form>
                        @endguest
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>

<!-- <div>
    @if ($pg > 1)
        <a href="home?pg={{ $pg - 1 }}">Previous</a>
    @endif
    Page : {{ $pg }} / {{ $maxPg }}
    @if ($pg < $maxPg)
        <a href="home?pg={{ $pg + 1 }}">Next</a>
    @endif
</div>
<hr> -->
<div class="container">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection()