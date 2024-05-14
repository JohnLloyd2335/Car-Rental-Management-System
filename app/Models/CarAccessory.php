<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarAccessory extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'car_id', 'accessory_id'];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function accessory(): BelongsTo
    {
        return $this->belongsTo(Accessory::class);
    }
}
