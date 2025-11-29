<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang ada di database (hasil migrasi)
    protected $table = 'student_progress';

    // Izinkan kolom ini untuk dibaca/ditulis
    protected $fillable = [
        'name',
        'email',
        'course_name',
        'active_tutorials',
        'completed_tutorials',
        'is_graduated',
        'exam_score'
    ];
}