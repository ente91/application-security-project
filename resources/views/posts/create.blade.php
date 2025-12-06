@extends('layouts.app')

@section('content')
    <section>
        <header>
            <h2>New post</h2>
        </header>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div>
                <label for="name">Title</label><br>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 1rem;">
                <label for="content">Content</label><br>
                <textarea id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" class="button">Publish</button>
            </div>
        </form>
    </section>
@endsection
