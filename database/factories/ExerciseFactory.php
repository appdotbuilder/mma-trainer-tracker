<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['striking', 'grappling', 'conditioning', 'technique', 'flexibility'];
        $category = fake()->randomElement($categories);
        
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentences(2, true),
            'category' => $category,
            'muscle_groups' => fake()->randomElements(['chest', 'back', 'shoulders', 'arms', 'legs', 'core'], 3),
            'equipment' => fake()->optional()->words(2, true),
            'instructions' => fake()->sentences(3, true),
            'is_custom' => false,
            'created_by' => null,
        ];
    }
}