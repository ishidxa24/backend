<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillKeyword extends Model
{
    use HasFactory;

    protected $table = 'skill_keywords';

    protected $fillable = [
        'keyword',
        'category', // Tech / Interest
        'learning_path_id'
    ];

    public function learningPath()
    {
        return $this->belongsTo(LearningPath::class, 'learning_path_id');
    }
}