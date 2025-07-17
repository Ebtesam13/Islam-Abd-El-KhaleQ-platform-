<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicQuizAttemptAnswer extends Model
{
    use HasFactory;
    protected $table = 'public_quiz_attempt_answers';
    protected $fillable = ['quiz_attempt_id', 'question_id', 'answer_id'];
}
