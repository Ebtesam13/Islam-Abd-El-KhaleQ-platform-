<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'unit_id',
        'price',
        'expiry_days',
        'number_of_codes',
        'video',
        'drive_video',
    ];
    public function getIsExpiredAttribute()
    {
        if(!auth()->check()){
            return true;
        }else{
            $user = Auth::user();
            if ($user->hasRole('student')) {
                $accessRecords = $this->studentLessonAccess()
                    ->where('student_id', $user->id)
                    ->where('expires_at','>=', now())
                    ->exists();

                // If no access records found with valid expiry date, the lesson is expired
                return !$accessRecords;
            } elseif ($user->hasRole('teacher')) {
                return false;
            }
        }
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function homework()
    {
        return $this->hasMany(Homework::class);
    }
    public function studentLessonAccess()
    {
        return $this->hasMany(StudentLessonAccess::class);
    }

    public function videoViews()
    {
        return $this->hasMany(VideoView::class);
    }

    public function viewers()
    {
        return $this->belongsToMany(User::class, 'video_views')
            ->withPivot('views_count')
            ->withTimestamps();
    }

    // A lesson can have many quizzes
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

}
