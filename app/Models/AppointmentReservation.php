<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date_id',
        'user_id',
        'payment_status',
        'year_and_section',
        'proof_of_payment',
        'mode_of_payment',
    ];



    public function markAsPaid()
    {
        $this->payment_status = 'paid';
        $this->save();

        EventRegistration::create([
            'event_id' => $this->appointmentDate->event->id,
            'user_id' => $this->user->id,
            'status' => 'registered',
        ]);
        
    }

    public function appointmentDate()
    {
        return $this->belongsTo(AppointmentDate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get event_id from appointment_date_id
    public function event()
    {
        return $this->belongsToThrough(Event::class, AppointmentDate::class);
    }
}
