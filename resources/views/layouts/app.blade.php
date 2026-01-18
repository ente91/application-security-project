<!DOCTYPE HTML>
<html>
    <head>
        <title>Application Security - Simple Posts</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

        {{-- Same CSS pipeline as original project --}}
        @vite(['resources/assets/css/main.css'])
    </head>
    <body class="is-preload">

        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="{{ route('home') }}">Simple Posts</a></h1>

                <nav class="links">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>

                        <li>
                            <form action="{{ route('home') }}" method="GET" style="display: inline-flex; gap: 0.25rem; align-items: center;">
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." style="max-width: 12rem;" />
                                <button type="submit" class="button small">Go</button>
                            </form>
                        </li>

                        @auth
                            <li><a href="{{ route('posts.create') }}">New post</a></li>
                            @if(auth()->user()->isAdmin())
                                <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            @endif
                            <li>Welcome, {{ auth()->user()->name }}</li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="button small">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Log in</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endauth
                    </ul>
                </nav>
            </header>

            <!-- Main content -->
            <div id="main">
                @if (session('status'))
                    {{-- Flash message styled as a normal post card --}}
                    <section class="post status-message">
                        <p>{{ session('status') }}</p>
                    </section>
                @endif

                @yield('content')
            </div>

        </div>
    </body>
</html>
