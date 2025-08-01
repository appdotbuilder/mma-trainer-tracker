<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test Fighter',
            'email' => 'test@example.com',
        ]);

        // Seed exercises
        $this->call([
            ExerciseSeeder::class,
        ]);
    }
}
