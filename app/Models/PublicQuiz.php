<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicQuiz extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','time','active'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($quiz) {
            $quiz->questions()->delete();
//            $quiz->corrections()->delete();
            $quiz->quizAttempts()->delete();
        });
    }

    public function questions()
    {
        return $this->hasMany(PublicQuestion::class,'quiz_id');
    }

    public function corrections()
    {
        return $this->hasMany(QuizCorrection::class);
    }
    public function quizAttempts()
    {
        return $this->hasMany(PublicQuizAttempt::class, 'quiz_id');
    }
}
