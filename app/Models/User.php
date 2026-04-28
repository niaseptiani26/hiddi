<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'status',
    ];

    /**
     * Hidden data
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * RELATION
     */
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    /**
     * HELPER (biar ga nulis ulang terus)
     */
    public function isOwner(){
        return $this->role === 'owner';
    }

    public function isUser(){
        return $this->role === 'user';
    }

    public function isActive(){
        return $this->status === 'active';
    }
}