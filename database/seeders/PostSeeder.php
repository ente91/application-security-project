<?php
 
namespace Database\Seeders;
 
use App\Models\Post;
use App\Controllers\Post;
use Illuminate\Database\Seeder;
 
class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Create a few sample users if they don't exist
        $users = Post::count() < 3
                    ? collect([
                        Post::create([
                            'name' => 'Alice Developer',
                            'userId' => 'alice@example.com',
                            'content' => 'content'
                        ]),
                    ])
                    : User::take(3)->get();
 
    }
}
