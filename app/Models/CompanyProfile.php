<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'company_name',
        'description',
        'address',
        'phone',
        'email',
        'social_links',
        'logo_path',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'social_links' => 'array',
    ];

    /**
     * HELPER
     */

    // ambil satu data (biasanya cuma 1 row di table ini)
    public static function getProfile(){
        return self::first();
    }

    // cek ada logo atau nggak
    public function hasLogo(){
        return !empty($this->logo_path);
    }
}