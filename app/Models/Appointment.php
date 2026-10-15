<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'cancellation_reason',
    ];

    /**
     * Cast attributes to native types or Carbon instances
     */
    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function intakeForm()
    {
        return $this->hasOne(IntakeForm::class);
    }
}