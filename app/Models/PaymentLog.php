<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'transaction_id',
        'request_data',
        'response_data',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
    ];

    /**
     * RELATION
     */
    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}