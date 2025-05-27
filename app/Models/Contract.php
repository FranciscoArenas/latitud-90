<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'passenger_id',
        'contract_type',
        'total_amount',
        'paid_amount',
        'pending_amount',
        'status',
        'vouchers'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'pending_amount' => 'decimal:2',
        'vouchers' => 'json'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function addVoucher($payment)
    {
        $vouchers = $this->vouchers ?? [];
        $vouchers[] = [
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'date' => $payment->created_at,
            'voucher_number' => 'V-' . $this->contract_number . '-' . (count($vouchers) + 1)
        ];
        $this->update(['vouchers' => $vouchers]);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->total_amount == 0) return 0;
        return round(($this->paid_amount / $this->total_amount) * 100, 2);
    }
}
