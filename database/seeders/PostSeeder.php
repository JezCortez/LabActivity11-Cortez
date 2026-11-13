<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        $kagawad = Author::where('email', 'kagawad.cortez@bulletin.test')->first();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Purok Cortez Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'Maki-join sa clean-up drive sa Purok Cortez. Dalhin ang inyong walis, guwantes, at sako. Magsisimula ang trabaho ala-sais ng umaga sa barangay hall.',
            'is_published' => true,
            'is_pinned' => true,
            // TODO: change to YOUR birthday in 2026
            'published_at' => '2026-01-01 08:00:00',
        ]);
    }
}
