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

        
    }
}
