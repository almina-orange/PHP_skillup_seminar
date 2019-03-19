<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    {{-- Header / Navbars --}}
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            {{-- Logo --}}
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="https://github.com/almina-orange.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Hinstagram
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- Navbarの左側 --}}
                <ul class="navbar-nav mr-auto">
                    {{-- 「記事」と「ユーザー」へのリンク --}}
                    <li class="nav-item active">
                        <a class="nav-link" href="/home"> Latest <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/home/rank"> Ranking </a>
                    </li>
                </ul>

                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submin">Search</button>
                </form> -->

                {{-- Navbarの右側 --}}
                <ul class="navbar-nav ml-auto">
                    {{-- 投稿ボタン --}}
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ url('/post') }}" id="new-post">New Post</a>
                    </li>

                    {{-- 認証関連のリンク --}}
                    @guest
                        {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュー --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Guest <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <a class="dropdown-item" href="#">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/') }}"> Login </a>
                            </div>
                        </li>
                    @else
                        {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュー --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->github_id }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <a class="dropdown-item" href="{{ url('/user?uid='.auth()->user()->id) }}">Profile</a>
                                <a class="dropdown-item" href="{{ url('/favo?uid='.auth()->user()->id) }}">Favorite</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

{{-- JavaScript --}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>