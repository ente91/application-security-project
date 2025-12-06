@extends('layouts.app')

@section('content')
    <section class="post">
        <header>
            <div class="title">
                <h2>Log in</h2>
                <p>Access your account</p>
            </div>
        </header>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field" style="margin-top: 1rem;">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field" style="margin-top: 1rem;">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
            </div>

            <ul class="actions" style="margin-top: 1.5rem;">
                <li><button type="submit" class="button large">Log in</button></li>
            </ul>
        </form>
    </section>
@endsection
