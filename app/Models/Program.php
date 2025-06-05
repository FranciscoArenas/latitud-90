<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'service_type',
        'destination',
        'departure_date',
        'return_date',
        'duration_days',
        'capacity',
        'base_price',
        'includes',
        'excludes',
        'requirements',
        'itinerary',
        'image_url',
        'active'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'base_price' => 'decimal:2',
        'active' => 'boolean'
    ];

    public function commercialExecutive()
    {
        return $this->belongsTo(User::class, 'commercial_executive_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    // Nueva relación many-to-many con passengers
    public function enrolledPassengers()
    {
        return $this->belongsToMany(Passenger::class)
                    ->withPivot('individual_price', 'price_adjustments', 'adjustment_reason', 'status', 'registration_date')
                    ->withTimestamps();
    }

    public function getActivePassengersAttribute()
    {
        return $this->passengers()->where('status', 'active')->count();
    }

    public function getTotalRevenueAttribute()
    {
        return $this->passengers()->sum('individual_price');
    }
}
