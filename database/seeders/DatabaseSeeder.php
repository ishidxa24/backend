<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CsvImportSeeder::class,
            // Jika nanti ada seeder untuk Course/LearningPath, tambahkan disini
        ]);
    }
}