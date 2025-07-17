<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCorrection extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'name', 'video_path'];

    // Define relationship with Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
