<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','lesson_id','video','image_path'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function studentAccess()
    {
        return $this->hasMany(StudentHomeworkAccess::class, 'homework_id');
    }
}
