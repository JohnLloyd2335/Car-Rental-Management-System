<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'brand_id', 'model', 'year', 'price_per_day', 'is_available', 'plate_number', 'description', 'images'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function accessories(): HasMany
    {
        return $this->hasMany(CarAccessory::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
