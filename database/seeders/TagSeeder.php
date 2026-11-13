<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Purok Cortez', 'Urgent', 'Libre', 'Schedule', 'Pamilya'] as $name) {
            Tag::create(['name' => $name]);
        }

        $tags = Tag::all();

        Post::all()->each(function (Post $post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id')->all());
        });

        // The pinned post always has exactly these two tags.
        $pinned = Post::where('is_pinned', true)->first();
        $pinned->tags()->sync([
            $tags->firstWhere('name', 'Purok Cortez')->id,
            $tags->firstWhere('name', 'Urgent')->id,
        ]);
    }
}
