<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $exercises = [
            // Striking exercises
            [
                'name' => 'Heavy Bag',
                'description' => 'Training with heavy punching bag',
                'category' => 'striking',
                'muscle_groups' => ['shoulders', 'arms', 'core', 'legs'],
                'equipment' => 'Heavy bag, gloves',
                'instructions' => 'Focus on proper form, footwork, and combinations',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Pad Work',
                'description' => 'Training with focus mitts/pads',
                'category' => 'striking',
                'muscle_groups' => ['shoulders', 'arms', 'core'],
                'equipment' => 'Focus mitts, gloves',
                'instructions' => 'Work on timing, accuracy, and combinations with partner',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Shadow Boxing',
                'description' => 'Boxing without equipment',
                'category' => 'striking',
                'muscle_groups' => ['shoulders', 'arms', 'core', 'legs'],
                'equipment' => 'None',
                'instructions' => 'Focus on technique, movement, and visualization',
                'is_custom' => false,
                'created_by' => null,
            ],

            // Grappling exercises
            [
                'name' => 'Takedown Drills',
                'description' => 'Practicing takedown techniques',
                'category' => 'grappling',
                'muscle_groups' => ['legs', 'core', 'back', 'arms'],
                'equipment' => 'Grappling mats',
                'instructions' => 'Focus on proper technique and timing',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Guard Work',
                'description' => 'Training guard positions and transitions',
                'category' => 'grappling',
                'muscle_groups' => ['core', 'legs', 'arms'],
                'equipment' => 'Grappling mats',
                'instructions' => 'Practice guard retention and submission setups',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Submission Drills',
                'description' => 'Practicing submission techniques',
                'category' => 'grappling',
                'muscle_groups' => ['arms', 'core', 'legs'],
                'equipment' => 'Grappling mats',
                'instructions' => 'Focus on proper positioning and leverage',
                'is_custom' => false,
                'created_by' => null,
            ],

            // Conditioning exercises
            [
                'name' => 'Burpees',
                'description' => 'Full body conditioning exercise',
                'category' => 'conditioning',
                'muscle_groups' => ['full_body'],
                'equipment' => 'None',
                'instructions' => 'Maintain proper form throughout the movement',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Sprint Intervals',
                'description' => 'High intensity running intervals',
                'category' => 'conditioning',
                'muscle_groups' => ['legs', 'cardio'],
                'equipment' => 'Track or treadmill',
                'instructions' => 'Alternate between high and low intensity periods',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Battle Ropes',
                'description' => 'High intensity rope training',
                'category' => 'conditioning',
                'muscle_groups' => ['arms', 'shoulders', 'core', 'cardio'],
                'equipment' => 'Battle ropes',
                'instructions' => 'Maintain consistent rhythm and intensity',
                'is_custom' => false,
                'created_by' => null,
            ],

            // Technique exercises
            [
                'name' => 'Flow Drills',
                'description' => 'Technique combination practice',
                'category' => 'technique',
                'muscle_groups' => ['full_body'],
                'equipment' => 'Varies',
                'instructions' => 'Focus on smooth transitions between techniques',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Positional Sparring',
                'description' => 'Controlled sparring from specific positions',
                'category' => 'technique',
                'muscle_groups' => ['full_body'],
                'equipment' => 'Grappling mats',
                'instructions' => 'Focus on technique over intensity',
                'is_custom' => false,
                'created_by' => null,
            ],

            // Flexibility exercises
            [
                'name' => 'Dynamic Stretching',
                'description' => 'Movement-based stretching routine',
                'category' => 'flexibility',
                'muscle_groups' => ['full_body'],
                'equipment' => 'None',
                'instructions' => 'Perform controlled movements through full range of motion',
                'is_custom' => false,
                'created_by' => null,
            ],
            [
                'name' => 'Static Stretching',
                'description' => 'Hold-based stretching routine',
                'category' => 'flexibility',
                'muscle_groups' => ['full_body'],
                'equipment' => 'Yoga mat',
                'instructions' => 'Hold each stretch for 30-60 seconds',
                'is_custom' => false,
                'created_by' => null,
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}