<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Simple Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    {{-- CSS via Vite --}}
    @vite(['resources/assets/css/main.css'])
</head>
<body class="is-preload">
<div id="wrapper">

    <header id="header">
        <h1><a href="{{ route('home') }}">Simple Posts</a></h1>

        <nav class="links">
            <ul>
                @auth
                    <li>Welcome, {{ auth()->user()->name }}</li>
                    <li><a href="{{ route('posts.create') }}">New post</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Log in</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <div id="main">
        @if (session('status'))
            <section class="flash-message">
                {{ session('status') }}
            </section>
        @endif

        @yield('content')
    </div>

</div>
</body>
</html>
