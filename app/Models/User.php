<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Notifications\ResetPassword;


class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'code',
        'email',
        'password',
        'senior_year',
        'current_stage',
        'area_id',
        'city_id',
        'school',
        'school_type',
        'second_language',
        'mobile',
        'mobile_country_code',
        'whats_app',
        'mom_whats_app',
        'dad_whats_app',
        'dad_job',
        'job',
        'facebook_link',
        'identity_number',
        'language',
        'image_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function stage()
    {
        return $this->belongsTo(Course::class,'current_stage');
    }

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function courses(): belongsToMany
    {
        return $this->belongsToMany(Course::class,'course_user');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'student_lesson_access', 'student_id')
            ->withPivot(['access_code','expires_at'])
            ->withTimestamps();
    }

    public function videoViews()
    {
        return $this->hasMany(VideoView::class);
    }

    public function viewedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'video_views')
            ->withPivot('views_count')
            ->withTimestamps();
    }
    // User has many completed homeworks
    public function homeworks()
    {
        return $this->belongsToMany(Homework::class, 'student_homework_access', 'student_id', 'homework_id')
            ->withTimestamps();
    }
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'user_id');
    }

    public function parents()
    {
        return $this->belongsToMany(User::class, 'parents_students', 'student_id', 'parent_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'parents_students', 'parent_id', 'student_id');
    }

}
