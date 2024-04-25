<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;




class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::all();
        $users = User::all();

        for($i = 1; $i <= 10;$i++){
            Post::create([
                'title' => "Post $i",
                'body' => "this is body of post $i",
                'comment_id' => $comments->random()->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
