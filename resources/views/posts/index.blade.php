@extends('layouts.app')

@section('content')
    <section class="posts">
        <header>
            <h2>Posts</h2>
        </header>

        @if($posts->isEmpty())
            <p>No posts yet.</p>
            @auth
                <p><a href="{{ route('posts.create') }}">Create the first post</a></p>
            @endauth
        @else
            @foreach($posts as $post)
                <article class="post">
                    <header>
                        <h3>{{ $post->name }}</h3>
                        <p>
                            by {{ optional($post->user)->name ?? 'Anonymous' }}
                            &bullet;
                            {{ $post->created_at->format('Y-m-d H:i') }}
                        </p>
                    </header>

                    <p>{{ $post->content }}</p>
                </article>
            @endforeach
        @endif
    </section>
@endsection
