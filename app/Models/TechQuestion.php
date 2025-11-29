<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'difficulty', 'tech_category', 'options'];
    protected $casts = ['options' => 'array']; // Jika opsi disimpan sebagai JSON
}