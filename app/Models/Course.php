<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'id',
        'course_name',
        'learning_path_id',
        'level' // (Beginner, Intermediate, Advanced)
    ];

    // Relasi ke Learning Path (Kebalikannya)
    public function learningPath()
    {
        return $this->belongsTo(LearningPath::class, 'learning_path_id');
    }

    // Relasi: Satu Course punya banyak Tutorial
    public function tutorials()
    {
        return $this->hasMany(Tutorial::class, 'course_id');
    }
}