<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLessonAccess extends Model
{
    use HasFactory;
    protected $table = 'student_lesson_access';
    protected $fillable = ['student_id', 'lesson_id', 'access_code', 'expires_at'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Relationship to the Student model.
     */
    public function student()
    {
        return $this->belongsTo(User::class,'student_id');
    }

    /**
     * Relationship to the Code model.
     */
    public function code()
    {
        return $this->belongsTo(Code::class,'access_code');
    }

}
