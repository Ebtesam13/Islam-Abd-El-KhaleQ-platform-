<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','time','lesson_id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($quiz) {
            $quiz->questions()->delete();
            $quiz->corrections()->delete();
            $quiz->quizAttempts()->delete();
        });
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function corrections()
    {
        return $this->hasMany(QuizCorrection::class);
    }
    // A quiz belongs to a lesson
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'quiz_id');
    }
}
