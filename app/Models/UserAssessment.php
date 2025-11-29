<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAssessment extends Model
{
    use HasFactory;

    protected $table = 'user_assessments';

    protected $fillable = [
        'user_id',
        'recommended_role',
        'skill_profile_data'
    ];

    // Otomatis ubah JSON di database menjadi Array di PHP
    protected $casts = [
        'skill_profile_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}