<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function car_accessories(): HasMany
    {
        return $this->hasMany(CarAccessory::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return date('M d, Y h:i A', strtotime($value));
            }
        );
    }
}
