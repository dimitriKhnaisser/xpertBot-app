<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade' => $this->faker->numberBetween(0, 100),
            'about' => $this->faker->paragraph(),
            
            'exam_id' => Exam::inRandomOrder()->first()->id, // creates an exam if none exists
        ];
    }
}
