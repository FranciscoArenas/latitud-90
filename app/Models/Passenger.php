<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'rut',
        'first_name',
        'last_name',
        'email',
        'phone',
        'program_id',
        'status',
        'individual_price',
        'price_adjustments',
        'adjustment_reason',
        'document_type',
        'document_number',
        'full_name',
        'birth_date',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'dietary_restrictions',
        'medical_conditions',
        'registration_date'
    ];

    protected $casts = [
        'individual_price' => 'decimal:2',
        'price_adjustments' => 'decimal:2'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function paymentLinks()
    {
        return $this->hasMany(PaymentLink::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'approved')->sum('amount');
    }

    public function getPendingAmountAttribute()
    {
        return ($this->individual_price + $this->price_adjustments) - $this->total_paid;
    }
}
