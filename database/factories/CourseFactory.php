<?php

namespace Database\Factories;

use App\Models\Difficulty;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // 3 random words
            'classroom' => $this->faker->url,
            'amount' => $this->faker->numberBetween(100, 1000),
            'difficulty_id' => Difficulty::inRandomOrder()->first()->id, // automatically creates a difficulty if none exists
            'teacher_id' => Teacher::inRandomOrder()->first()->id, // automatically creates a teacher if none exists
        ];
    }
}
