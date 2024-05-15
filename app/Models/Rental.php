<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
        'is_paid',
        'amount_paid',
        'date_paid',
        'penalties',
        'cancellation_reason',
        'date_cancelled',
        'date_approved',
        'date_returned',
        'date_late_returned',
        'date_completed'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function startDate(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return date('M d, Y h:i A', strtotime($value));
            }
        );
    }

    public function endDate(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return date('M d, Y h:i A', strtotime($value));
            }
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return date('M d, Y h:i A', strtotime($value));
            }
        );
    }

    public function dateCancelled(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return date('M d, Y h:i A', strtotime($value));
            }
        );
    }
}
