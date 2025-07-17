<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booklet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number_of_codes', 'file_path', 'quiz_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function bookletCodes()
    {
        return $this->hasMany(BookletCode::class);
    }
}
