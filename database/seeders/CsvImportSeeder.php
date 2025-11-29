<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CsvImportSeeder extends Seeder
{
    public function run()
    {
        // Pastikan path file sesuai
        $file = database_path('data/student_progress.csv'); 

        // Cek apakah file ada sebelum diproses
        if (!file_exists($file)) {
            $this->command->error("File CSV tidak ditemukan di: $file");
            return;
        }

        $handle = fopen($file, "r");
        $header = fgetcsv($handle); // Skip baris header

        $batch = [];
        while (($row = fgetcsv($handle)) !== FALSE) {
            
            // --- FIX UTAMA: Gunakan trim() pada email ---
            $cleanEmail = isset($row[1]) ? trim($row[1]) : null; 
            
            // Abaikan baris jika email kosong
            if (empty($cleanEmail)) continue;

            $batch[] = [
                'name' => isset($row[0]) ? trim($row[0]) : null,
                'email' => $cleanEmail, // Email yang sudah dibersihkan
                'course_name' => isset($row[2]) ? trim($row[2]) : null,
                'active_tutorials' => is_numeric($row[3]) ? $row[3] : 0,
                'completed_tutorials' => is_numeric($row[4]) ? $row[4] : 0,
                'is_graduated' => isset($row[5]) && $row[5] == '1',
                'exam_score' => isset($row[10]) && is_numeric($row[10]) ? $row[10] : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        fclose($handle);
        
        // Insert data secara massal (lebih cepat)
        // Chunk per 500 data agar tidak memory limit
        foreach (array_chunk($batch, 500) as $chunk) {
            DB::table('student_progress')->insert($chunk);
        }
        
        $this->command->info('Student Progress imported successfully (Cleaned)!');
    }
}