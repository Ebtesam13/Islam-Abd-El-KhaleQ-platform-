<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookletCode extends Model
{
    use HasFactory;
    public  static $status = [
        'CREATED' => 'created',
        'EXPIRED' => 'expired',
        'VALID' => 'valid',
    ];
    protected $fillable = ['code', 'booklet_id','status'];

    public function booklet()
    {
        return $this->belongsTo(Booklet::class);
    }
}
