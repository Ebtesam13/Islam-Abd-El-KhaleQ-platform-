<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public  static $status = [
        'CREATED' => 'created',
        'EXPIRED' => 'expired',
        'VALID' => 'valid',
    ];
    use HasFactory;
    protected $fillable = ['combination','status', 'lesson_id','expiry_days'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_lesson_access', 'access_code_id', 'student_id')
            ->withTimestamps();
    }
}
