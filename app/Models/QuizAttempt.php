<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id',
        'user_id',
        'current_question',
        'time_left',
        'score',
        'full_mark',
        'completed_at',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if the quiz attempt is completed
    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    // Get the remaining time for the quiz in minutes
    public function getRemainingTimeInMinutes()
    {
        return $this->time_left / 60;
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'quiz_attempt_answers', 'quiz_attempt_id', 'answer_id')
            ->withPivot('question_id') // Include 'question_id' if needed
            ->withTimestamps();
    }
}

