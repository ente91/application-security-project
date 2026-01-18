@extends('layouts.app')

@section('content')
    <section>
        <header class="major">
            <h2>Admin dashboard</h2>
            <p>Moderate users and content</p>
        </header>

        <div class="post" style="padding: 1rem;">
            <h3>Users ({{ $users->count() }})</h3>

            @if($users->isEmpty())
                <p>No users found.</p>
            @else
                <ul style="margin: 0.25rem 0 0 1.25rem;">
                    @foreach($users as $user)
                        <li style="margin-bottom: 0.5rem;">
                            <strong>{{ $user->name }}</strong>
                            <small style="opacity: 0.75;">({{ $user->email }})</small>
                            <small style="opacity: 0.75;">role: {{ $user->role ?? 'user' }}</small>

                            @if((int)$user->id !== (int)auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user account?');" style="display: inline; margin-left: 0.5rem;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button small">Delete user</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="post" style="padding: 1rem; margin-top: 1rem;">
            <h3>Posts ({{ $posts->count() }})</h3>

            @if($posts->isEmpty())
                <p>No posts found.</p>
            @else
                <ul style="margin: 0.25rem 0 0 1.25rem;">
                    @foreach($posts as $post)
                        <li style="margin-bottom: 0.5rem;">
                            <strong>{{ $post->name }}</strong>
                            <small style="opacity: 0.75;">by {{ optional($post->user)->name ?? 'Anonymous' }}</small>
                            <small style="opacity: 0.75;">({{ $post->created_at->format('F j, Y H:i') }})</small>

                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');" style="display: inline; margin-left: 0.5rem;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button small">Delete post</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection
