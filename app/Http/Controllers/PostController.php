<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Show list of posts.
     */
    public function index()
    {
        $posts = Post::with(['user', 'attachments'])->latest()->get();

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
            'attachments'   => ['nullable', 'array', 'max:5'],
            'attachments.*' => [
                'file',
                'max:10240', // 10 MB
                'mimes:jpg,jpeg,png,gif,webp,pdf,txt,doc,docx,xls,xlsx,ppt,pptx,zip',
            ],
        ]);

        DB::transaction(function () use ($request, $data) {
            $post = Post::create([
                'name'    => $data['name'],
                'content' => $data['content'],
                'user_id' => Auth::id(),
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments', []) as $file) {
                    if (! $file || ! $file->isValid()) {
                        continue;
                    }

                    // Store under storage/app/public/post-attachments/{post_id}
                    $storedPath = $file->store("post-attachments/{$post->id}", 'public');

                    PostAttachment::create([
                        'post_id'       => $post->id,
                        'original_name' => $file->getClientOriginalName(),
                        'path'          => $storedPath,
                        'mime'          => $file->getClientMimeType(),
                        'size'          => $file->getSize() ?? 0,
                    ]);
                }
            }
        });

        return redirect()->route('home')->with('status', 'Post has been created.');
    }
}
