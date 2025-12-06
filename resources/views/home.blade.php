@extends('layouts.app')

@section('content')
    <section class="post">
        <header>
            <div class="title">
                <h2>New post</h2>
                <p>Create a new blog entry</p>
            </div>
        </header>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="field">
                <label for="name">Title</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field" style="margin-top: 1rem;">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <ul class="actions" style="margin-top: 1.5rem;">
                <li><button type="submit" class="button large">Publish</button></li>
                <li><a href="{{ route('home') }}" class="button">Cancel</a></li>
            </ul>
        </form>
    </section>
@endsection
