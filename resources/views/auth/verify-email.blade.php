@extends('layouts.app')

@section('content')
    <section class="post">
        <header>
            <div class="title">
                <h2>Verify your email address</h2>
                <p>We have sent an activation link to {{ auth()->user()->email }}</p>
            </div>
        </header>

        <p>
            To activate your account, please click the activation link in the email we just sent you.
            Once your email is verified, you will be able to create new posts.
        </p>

        @if (session('status') === 'verification-link-sent' || session('status') === 'Verification link sent!')
            <p><strong>A new activation link has been sent to your email address.</strong></p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <ul class="actions" style="margin-top: 1.5rem;">
                <li>
                    <button type="submit" class="button large">
                        Resend activation email
                    </button>
                </li>
            </ul>
        </form>
    </section>
@endsection
