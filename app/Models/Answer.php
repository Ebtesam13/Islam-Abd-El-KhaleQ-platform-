<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'answer', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function quizAttempts()
    {
        return $this->belongsToMany(QuizAttempt::class, 'quiz_attempt_answers', 'answer_id', 'quiz_attempt_id')
            ->withPivot('question_id') // Include 'question_id' if needed
            ->withTimestamps();
    }
}
