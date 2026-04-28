<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatusHistory extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'booking_id',
        'status',
        'note',
        'changed_by',
    ];

    /**
     * RELATION
     */
    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'changed_by');
    }

    /**
     * HELPER
     */

    // cek apakah perubahan dilakukan owner
    public function isByOwner(){
        return $this->user && $this->user->role === 'owner';
    }
}