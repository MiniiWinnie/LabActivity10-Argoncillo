<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn () => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn () => ['author_id' => $authors->random()->id])
            ->create();

        $kagawad = Author::where('email', 'kagawad.argoncillo@example.com')->firstOrFail();

        Post::create([
            'author_id' => $kagawad->id,
            'title' => 'Important Barangay Update',
            'category' => 'Announcement',
            'body' => 'Please be informed of this important barangay update.',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => Carbon::create(2026, 11, 16),
        ]);
    }
}
