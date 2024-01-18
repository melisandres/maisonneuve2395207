@extends('layouts.layout')
@section('content')
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
    @auth
        <a class="navbar-brand" href="#">Hello {{ auth()->user()->name }}</a>
    @else
        <a class="navbar-brand" href="#">Hello Guest</a>
    @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @guest
                    <a class="nav-link" href="{{route('user.registration')}}">Registration</a>
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                @else
                    <a class="nav-link" href="{{route('etudiants.index')}}">Blogs</a>
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
@endsection