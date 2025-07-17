<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id','question', 'question_text'];

    public function quiz()
    {
        return $this->belongsTo(PublicQuiz::class);
    }

    public function answers()
    {
        return $this->hasMany(PublicAnswer::class,'question_id');
    }
}
