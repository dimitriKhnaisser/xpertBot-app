<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DifficultySeeder::class,
            CompanySeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            WalletSeeder::class,
            CourseSeeder::class,
            JobSeeder::class,
            ExamSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
