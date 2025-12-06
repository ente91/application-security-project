<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get(); // or ->paginate(10)

        return view('posts.index', compact('posts'));
    }
}