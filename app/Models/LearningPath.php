<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPath extends Model
{
    use HasFactory;

    protected $table = 'learning_paths';

    // Kita izinkan 'id' diisi manual agar sesuai dengan ID di CSV
    protected $fillable = [
        'id', 
        'name'
    ];

    // Relasi: Satu Learning Path punya banyak Course
    public function courses()
    {
        return $this->hasMany(Course::class, 'learning_path_id');
    }
}