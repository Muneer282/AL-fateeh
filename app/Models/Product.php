<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'price',
        'image',
        'type', // e.g., Sport, Scooter, etc.
    ];

    /**
     * Get the product's image URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return $this->image ? Storage::url($this->image) : null;
    }
}
