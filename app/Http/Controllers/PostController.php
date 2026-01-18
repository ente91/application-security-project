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
        $q = request()->string('q')->trim()->toString();

        $postsQuery = Post::query()
            ->with([
                'user',
                'attachments',
                'comments.user',
                'ratings',
            ])
            ->latest();

        // Guests (and all users) can perform simple keyword-based search.
        if ($q !== '') {
            $postsQuery->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        $posts = $postsQuery->get();

        return view('posts.index', compact('posts', 'q'));
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

    /**
     * Delete a post.
     *
     * - Regular users can delete only their own posts.
     * - Admins can delete any post.
     */
    public function destroy(Post $post)
    {
        $user = Auth::user();

        if (! $user || (! $user->isAdmin() && (int) $post->user_id !== (int) $user->id)) {
            abort(403);
        }

        // Clean up uploaded files from the public disk.
        // DB records are removed by cascading deletes.
        if ($post->attachments()->exists()) {
            Storage::disk('public')->deleteDirectory("post-attachments/{$post->id}");
        }

        $post->delete();

        return redirect()->route('home')->with('status', 'Post has been deleted.');
    }
}
