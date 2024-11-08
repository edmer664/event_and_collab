<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'uid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($eventRegistration) {
            $eventRegistration->uid = uniqid();
        });
    }

    public function markAsAttended()
    {
        $this->status = 'attended';
        $this->save();
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
