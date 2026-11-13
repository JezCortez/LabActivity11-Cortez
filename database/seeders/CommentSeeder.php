<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $lola = User::where('email', 'lola.cortez@bulletin.test')->first();

        // 0-5 comments on every published post (pinned post is handled below)
        Post::where('is_published', true)->where('is_pinned', false)->get()
            ->each(function (Post $post) use ($users) {
                $count = rand(0, 5);

                Comment::factory()->count($count)
                    ->state(['post_id' => $post->id])
                    ->sequence(fn () => ['user_id' => $users->random()->id])
                    ->create();
            });

        // Pinned post: 3 comments, one from Lola
        $pinned = Post::where('is_pinned', true)->first();

        $pinned->comments()->create([
            'user_id' => $lola->id,
            'body' => 'Salamat sa abiso! Makaadto ko sa clean-up drive.',
        ]);

        foreach ($users->where('id', '!=', $lola->id)->random(2) as $user) {
            $pinned->comments()->create([
                'user_id' => $user->id,
                'body' => fake()->sentence(),
            ]);
        }
    }
}
