<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Admin middleware already ensures the user is admin.
        $users = User::query()->latest()->get();
        $posts = Post::query()->with('user')->latest()->get();

        return view('admin.dashboard', compact('users', 'posts'));
    }

    public function destroyUser(User $user)
    {
        // Defensive: do not allow admin to delete themselves from the UI.
        if ((int) $user->id === (int) Auth::id()) {
            return back()->with('status', 'You cannot delete your own account while logged in.');
        }

        $user->delete();

        return back()->with('status', 'User account deleted.');
    }
}
