<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'event_type',
        'start_time',
        'end_time',
        'location',
        'status',
        'cover_image',
        'user_id',
    ];

    public function approve()
    {
        Notification::make()
            ->title('Event Approved')
            ->body("{$this->name} has been approved.")
            ->sendToDatabase($this->user)
            ->send();

        

        $this->update([
            'status' => 'approved',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
