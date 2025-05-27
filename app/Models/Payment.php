<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'passenger_id',
        'amount',
        'payment_method',
        'payment_type',
        'installment_number',
        'total_installments',
        'transaction_id',
        'authorization_number',
        'status',
        'gateway_response',
        'invoice_number',
        'payer_name',
        'payer_email'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_response' => 'json'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function getIsApprovedAttribute()
    {
        return $this->status === 'approved';
    }

    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->amount, 0, ',', '.');
    }
}
