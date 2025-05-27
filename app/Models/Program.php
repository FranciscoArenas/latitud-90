<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_number',
        'max_passengers',
        'description',
        'commercial_executive_id',
        'start_date',
        'service_type',
        'status',
        'price_per_passenger',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'price_per_passenger' => 'decimal:2'
    ];

    public function commercialExecutive()
    {
        return $this->belongsTo(User::class, 'commercial_executive_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
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
