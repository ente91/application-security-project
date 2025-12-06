@extends('layouts.app')

@section('content')
    <section>
        <header class="major">
            <h2>Posts</h2>
            <p>Latest entries from all registered users</p>
        </header>

        @if($posts->isEmpty())
            <p>No posts yet.</p>
            @auth
                <p>
                    <a href="{{ route('posts.create') }}" class="button">
                        Create the first post
                    </a>
                </p>
            @endauth
        @else
            @foreach($posts as $post)
                <article class="post">
                    <header>
                        <div class="title">
                            <h2>{{ $post->name }}</h2>
                            <p>by {{ optional($post->user)->name ?? 'Anonymous' }}</p>
                        </div>
                        <div class="meta">
                            <time class="published"
                                  datetime="{{ $post->created_at->toDateString() }}">
                                {{ $post->created_at->format('F j, Y H:i') }}
                            </time>
                            <a href="#" class="author">
                                <span class="name">{{ optional($post->user)->name ?? 'Anonymous' }}</span>
                                {{-- Default avatar from the theme --}}
                                <img src="{{ Vite::asset('resources/assets/images/avatar.jpg') }}" alt="" />
                            </a>
                        </div>
                    </header>

                    <p>{{ $post->content }}</p>
                </article>
            @endforeach
        @endif
    </section>
@endsection
