<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * RELATION
     */
    public function packages(){
        return $this->hasMany(Package::class);
    }

    public function portfolios(){
        return $this->hasMany(Portfolio::class);
    }

    /**
     * HELPER
     */

    // cek punya paket atau nggak
    public function hasPackages(){
        return $this->packages()->exists();
    }

    // cek punya portfolio atau nggak
    public function hasPortfolios(){
        return $this->portfolios()->exists();
    }
}