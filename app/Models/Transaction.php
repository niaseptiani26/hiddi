<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'booking_id',
        'invoice_number',
        'amount',
        'payment_method',
        'gateway',
        'gateway_ref',
        'status',
        'paid_at',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * RELATION
     */
    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function logs(){
        return $this->hasMany(PaymentLog::class);
    }

    /**
     * HELPER
     */
    public function isPaid(){
        return $this->status === 'settlement';
    }

    public function isPending(){
        return $this->status === 'pending';
    }

    public function isFailed(){
        return in_array($this->status, ['failed','expired','cancelled']);
    }
}