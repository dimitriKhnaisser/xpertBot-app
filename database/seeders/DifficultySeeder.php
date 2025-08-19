<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 // Insert the specific difficulty levels
        $difficulties = ['beginner', 'intermediate', 'advanced'];

        foreach ($difficulties as $level) {
            Difficulty::create([
                'name' => $level
            ]);
        }
    }
}
