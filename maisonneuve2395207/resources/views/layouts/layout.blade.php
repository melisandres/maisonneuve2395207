<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name')}}</title>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body class="blue"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <a class="navbar-brand" href="#">Hello @isset($name) {{ $name }} @endisset</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link mx-4 custom-link" href="{{ route('etudiants.index')}}">Les étudiants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-4 custom-link" href="{{ route('etudiants.create')}}">Ajouter</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link mx-4 custom-link" href="{{ route('user.registration') }}">Registration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4 custom-link" href="{{route('login')}}">Login</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link mx-4 custom-link" href="{{ route('etudiants.index') }}">Étudiants</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4 custom-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @yield('content')

        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>