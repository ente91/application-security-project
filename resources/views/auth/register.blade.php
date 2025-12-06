@extends('layouts.app')

@section('content')
    <section class="post">
        <header>
            <div class="title">
                <h2>Register</h2>
                <p>Create a new account</p>
            </div>
        </header>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field" style="margin-top: 1rem;">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <ul class="actions" style="margin-top: 1.5rem;">
                <li><button type="submit" class="button large">Create account</button></li>
            </ul>
        </form>
    </section>
@endsection
