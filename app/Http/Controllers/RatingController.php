<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Create or update the current user's rating for a post.
     */
    public function upsert(Request $request, Post $post)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);

        $post->ratings()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['rating' => $data['rating']]
        );

        return back()->with('status', 'Rating saved.');
    }
}
