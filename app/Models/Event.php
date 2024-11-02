<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'status',
        'cover_image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
