@extends('../../layouts/my')
@section('title', 'Like')
@section('content')
<div class="container">
    <h2>Liked users</h2>
    <!-- View uploaded image -->
    @isset ($users)
        @foreach ($users as $d)
            <a href="/user?uid={{ $d->id }}">
            <div class="card mb-3" style="max-width: 270px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://github.com/{{ $d->github_id }}.png" class="card-img" alt="..." height="100">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $d->github_id }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        @endforeach
    @endisset
</div>
@endsection