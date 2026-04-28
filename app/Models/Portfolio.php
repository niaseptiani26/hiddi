<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     */
protected $fillable = [
    'category_id',
    'title',
    'description',
    'image_path',
    'video_path', // WAJIB
    'type',       // WAJIB
    'is_featured'
];
    /**
     * Casting
     */
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * RELATION
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * HELPER
     */
    public function isFeatured(){
        return $this->is_featured === true;
    }
}