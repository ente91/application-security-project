@extends('layouts.app')

@section('content')
    <section class="post">
        <header>
            <div class="title">
                <h2>Reset password</h2>
                <p>Choose a new password for your account</p>
            </div>
        </header>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field" style="margin-top: 1rem;">
                <label for="password">New password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field" style="margin-top: 1rem;">
                <label for="password_confirmation">Confirm new password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <ul class="actions" style="margin-top: 1.5rem;">
                <li><button type="submit" class="button large">Reset password</button></li>
                <li><a href="{{ route('login') }}" class="button">Back to login</a></li>
            </ul>
        </form>
    </section>
@endsection
