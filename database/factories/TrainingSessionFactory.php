<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TrainingBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingSession>
 */
class TrainingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $scheduledAt = fake()->dateTimeBetween('-1 week', '+2 weeks');
        $type = fake()->randomElement(['striking', 'grappling', 'conditioning', 'technique', 'sparring', 'mixed']);
        
        return [
            'user_id' => User::factory(),
            'training_block_id' => null,
            'title' => ucfirst($type) . ' Session',
            'description' => fake()->sentences(2, true),
            'scheduled_at' => $scheduledAt,
            'started_at' => null,
            'completed_at' => null,
            'duration_minutes' => null,
            'type' => $type,
            'intensity' => fake()->randomElement(['low', 'moderate', 'high', 'max']),
            'status' => fake()->randomElement(['scheduled', 'in_progress', 'completed', 'cancelled', 'missed']),
            'notes' => fake()->optional()->sentences(1, true),
        ];
    }

    /**
     * Indicate that the session is completed.
     */
    public function completed(): static
    {
        $scheduledAt = fake()->dateTimeBetween('-2 weeks', '-1 day');
        $startedAt = $scheduledAt->modify('+' . fake()->numberBetween(0, 15) . ' minutes');
        $completedAt = $startedAt->modify('+' . fake()->numberBetween(30, 120) . ' minutes');
        $duration = $completedAt->getTimestamp() - $startedAt->getTimestamp();

        return $this->state(fn (array $attributes) => [
            'scheduled_at' => $scheduledAt,
            'started_at' => $startedAt,
            'completed_at' => $completedAt,
            'duration_minutes' => intval($duration / 60),
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the session is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_at' => fake()->dateTimeBetween('+1 day', '+2 weeks'),
            'started_at' => null,
            'completed_at' => null,
            'duration_minutes' => null,
            'status' => 'scheduled',
        ]);
    }
}