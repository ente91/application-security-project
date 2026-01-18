<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Create a new comment for a post.
     */
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);

        return back()->with('status', 'Comment added.');
    }

    /**
     * Delete a comment.
     *
     * - Regular users can delete only their own comments.
     * - Admins can delete any comment.
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if (! $user || (! $user->isAdmin() && (int) $comment->user_id !== (int) $user->id)) {
            abort(403);
        }

        $comment->delete();

        return back()->with('status', 'Comment deleted.');
    }
}
