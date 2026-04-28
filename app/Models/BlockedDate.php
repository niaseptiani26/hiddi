<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedDate extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'package_id',
        'blocked_date',
        'reason',
        'is_global',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'blocked_date' => 'date',
        'is_global' => 'boolean',
    ];

    /**
     * RELATION
     */
    public function package(){
        return $this->belongsTo(Package::class);
    }

    /**
     * HELPER
     */

    // cek apakah tanggal ini berlaku global
    public function isGlobal(){
        return $this->is_global === true;
    }

    // cek apakah berlaku untuk package tertentu
    public function isForPackage($packageId){
        return $this->package_id == $packageId;
    }
}