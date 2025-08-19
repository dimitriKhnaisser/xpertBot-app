<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle,
            'about' => $this->faker->paragraph,
            'company_id' => Company::inRandomOrder()->first()->id, // creates a company if none exists
            'student_id' => Student::inRandomOrder()->first()->id, 
            // optional null or existing student
        ];
    }
}
