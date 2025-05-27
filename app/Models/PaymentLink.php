<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'passenger_id',
        'amount',
        'payment_method',
        'description',
        'status',
        'expires_at',
        'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expires_at' => 'datetime',
        'metadata' => 'json'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($paymentLink) {
            if (!$paymentLink->token) {
                $paymentLink->token = Str::random(32);
            }
        });
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function getIsExpiredAttribute()
    {
        return $this->expires_at < now();
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active' && !$this->is_expired;
    }

    public function getUrlAttribute()
    {
        return route('payment.link', $this->token);
    }
}
