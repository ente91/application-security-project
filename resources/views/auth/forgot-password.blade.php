@extends('layouts.app')

@section('content')
    <section class="post">
        <header>
            <div class="title">
                <h2>Forgot password</h2>
                <p>We will email you a link to reset your password</p>
            </div>
        </header>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <ul class="actions" style="margin-top: 1.5rem;">
                <li><button type="submit" class="button large">Email reset link</button></li>
                <li><a href="{{ route('login') }}" class="button">Back to login</a></li>
            </ul>
        </form>
    </section>
@endsection
