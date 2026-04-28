<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
protected $fillable = [
    'category_id', 'name', 'description', 'price', 
    'prewedding_duration', 'wedding_duration', // Tambahkan ini
    'duration_hours', 'max_per_day', 'is_active','notes',
];

protected $casts = [
    'price' => 'decimal:2',
    'prewedding_duration' => 'integer', // Tambahkan ini
    'wedding_duration' => 'integer',    // Tambahkan ini
    'duration_hours' => 'integer',
    'intimate_duration' => 'integer',
    'max_per_day' => 'integer',
    'is_active' => 'boolean',
    
];

    /**
     * RELATION
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function blockedDates(){
        return $this->hasMany(BlockedDate::class);
    }

    /**
     * HELPER (biar logic lu ga bego di controller)
     */

    // apakah paket aktif
    public function isActive(){
        return $this->is_active === true;
    }

    // apakah paket pakai durasi otomatis (kayak wedding)
    public function isAutoDuration(){
        return !is_null($this->duration_hours);
    }

    // cek apakah full di tanggal tertentu
    public function isFullOnDate($date){
        $count = $this->bookings()
            ->where('booking_date', $date)
            ->count();

        return $count >= $this->max_per_day;
    }

    public function includes()
    {
        return $this->hasMany(PackageInclude::class);
    }
}