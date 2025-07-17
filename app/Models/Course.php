<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Course extends Model
{
    use HasFactory;

    public function getTotalRateAttribute()
    {
        $rates = $this->rates()->get();
        if (count($rates) > 0) {
            $rateValuesArray = $rates->pluck('rate')->toArray();
            return array_sum($rateValuesArray)/count($rates);
        }else{
            return 0;
        }
    }


    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function rates(): hasMany
    {
        return $this->hasMany(CourseRate::class);
    }
    public function units(): hasMany
    {
        return $this->hasMany(Unit::class)->orderBy('created_at', 'asc');
    }

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class,'course_user');
    }

}
