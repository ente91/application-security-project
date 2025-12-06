@extends('layouts.app')

@section('content')
    <section>
        <header>
            <h2>Log in</h2>
        </header>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">Email</label><br>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 1rem;">
                <label for="password">Password</label><br>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 1rem;">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" class="button">Log in</button>
            </div>
        </form>
    </section>
@endsection
