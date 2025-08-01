<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingBlock>
 */
class TrainingBlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 month', '+1 month');
        $endDate = fake()->dateTimeBetween($startDate, '+2 months');

        return [
            'user_id' => User::factory(),
            'name' => fake()->words(3, true) . ' Training Block',
            'description' => fake()->sentences(2, true),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => fake()->randomElement(['planned', 'active', 'completed', 'paused']),
            'goals' => [
                'improve striking accuracy',
                'increase cardio endurance',
                'master new takedown techniques'
            ],
        ];
    }

    /**
     * Indicate that the training block is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the training block is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }
}