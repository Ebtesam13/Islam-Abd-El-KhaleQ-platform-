<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('created_at', 'asc');
    }
    public function course()
    {
        return $this->belongsTo(Course::class)->orderBy('created_at', 'asc');
    }
}
