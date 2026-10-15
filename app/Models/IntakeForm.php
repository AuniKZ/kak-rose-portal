<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeForm extends Model
{
    use HasFactory;

    protected $casts = [
        'soreness_areas' => 'array',
        'is_high_risk' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'appointment_id',
        'postpartum_status',
        'soreness_areas',
        'emergency_contact_name',
        'emergency_contact_phone',
        'is_high_risk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}