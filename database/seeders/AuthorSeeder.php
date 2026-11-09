<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Kapitan Argoncillo',
            'position' => 'Kagawad',
            'email' => 'kagawad.argoncillo@example.com',
        ]);

        Author::factory()->count(4)->create();
    }
}
