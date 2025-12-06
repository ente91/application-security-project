@extends('layouts.app')

@section('content')
    <section>
        <header>
            <h2>Register</h2>
        </header>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name">Name</label><br>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 1rem;">
                <label for="email">Email</label><br>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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
                <label for="password_confirmation">Confirm password</label><br>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" class="button">Create account</button>
            </div>
        </form>
    </section>
@endsection
