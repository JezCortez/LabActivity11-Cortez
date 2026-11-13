<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('bulletin2026');

        User::create([
            'name' => 'Lola Cortez',
            'email' => 'lola.cortez@bulletin.test',
            'password' => $password,
        ]);

        $kagawadUser = User::create([
            'name' => 'Kagawad Jez Cortez',
            'email' => 'kagawad.cortez@bulletin.test',
            'password' => $password,
        ]);

        // Link the login account to the Kagawad's author profile.
        $author = Author::where('email', 'kagawad.cortez@bulletin.test')->first();
        $author->update(['user_id' => $kagawadUser->id]);

        User::factory()->count(8)->create();
    }
}
