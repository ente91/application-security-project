<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Create a demo admin account (if not already present)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Create a demo user (if not already present)
        $user = User::firstOrCreate(
            ['email' => 'alice@example.com'],
            [
                'name'     => 'Alice Developer',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]
        );

        // Create a sample post if there are no posts yet
        if (Post::count() === 0) {
            Post::create([
                'name'    => 'Welcome to the blog',
                'content' => 'This is your first sample post. You can now register, log in and create your own posts.',
                'user_id' => $user->id,
            ]);
        }
    }
}
