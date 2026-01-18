@extends('layouts.app')

@section('content')
    <section>
        <header class="major">
            <h2>Posts</h2>
            <p>Latest entries from all registered users</p>
        </header>

        @if(!empty($q))
            <p>Search results for: <strong>{{ $q }}</strong></p>
        @endif

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

                    @php
                        $avgRating = $post->ratings?->avg('rating');
                        $ratingCount = $post->ratings?->count() ?? 0;
                    @endphp

                    <div style="margin-top: 0.75rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                        <div>
                            <strong>Rating:</strong>
                            @if($ratingCount > 0)
                                {{ number_format($avgRating, 1) }}/5 ({{ $ratingCount }} votes)
                            @else
                                No ratings yet
                            @endif
                        </div>

                        @auth
                            <form action="{{ route('ratings.upsert', $post) }}" method="POST" style="display: inline-flex; gap: 0.25rem; align-items: center;">
                                @csrf
                                <label for="rating-{{ $post->id }}" style="margin: 0;">Your rating:</label>
                                @php
                                    $myRating = optional($post->ratings->firstWhere('user_id', auth()->id()))->rating;
                                @endphp
                                <select id="rating-{{ $post->id }}" name="rating" style="max-width: 6rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" @selected((int)$myRating === $i)>{{ $i }}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="button small">Save</button>
                            </form>

                            @if(auth()->user()->isAdmin() || (int)$post->user_id === (int)auth()->id())
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button small">Delete post</button>
                                </form>
                            @endif
                        @endauth
                    </div>

                    @if($post->attachments && $post->attachments->isNotEmpty())
                        <div style="margin-top: 0.75rem;">
                            <strong>Attachments:</strong>
                            <ul style="margin: 0.25rem 0 0 1.25rem;">
                                @foreach($post->attachments as $attachment)
                                    <li>
                                        <a href="{{ Storage::disk('public')->url($attachment->path) }}" target="_blank" rel="noopener noreferrer">
                                            {{ $attachment->original_name }}
                                        </a>
                                        <small style="opacity: 0.75;">
                                            ({{ number_format(($attachment->size ?? 0) / 1024, 1) }} KB)
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div style="margin-top: 1rem;">
                        <strong>Comments ({{ $post->comments?->count() ?? 0 }}):</strong>

                        @if($post->comments && $post->comments->isNotEmpty())
                            <ul style="margin: 0.5rem 0 0 1.25rem;">
                                @foreach($post->comments as $comment)
                                    <li style="margin-bottom: 0.5rem;">
                                        <div>
                                            <strong>{{ optional($comment->user)->name ?? 'Anonymous' }}</strong>
                                            <small style="opacity: 0.75;">
                                                {{ $comment->created_at->format('F j, Y H:i') }}
                                            </small>
                                        </div>
                                        <div>{{ $comment->content }}</div>

                                        @auth
                                            @if(auth()->user()->isAdmin() || (int)$comment->user_id === (int)auth()->id())
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?');" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button small">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p style="margin-top: 0.5rem;">No comments yet.</p>
                        @endif

                        @auth
                            <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top: 0.75rem;">
                                @csrf
                                <textarea name="content" rows="3" placeholder="Add a comment..." required style="width: 100%;"></textarea>
                                <button type="submit" class="button">Post comment</button>
                            </form>
                        @endauth
                    </div>
                </article>
            @endforeach
        @endif
    </section>
@endsection
