<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Show list of posts.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        Post::create([
            'name'    => $data['name'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home')->with('status', 'Post has been created.');
    }
}
