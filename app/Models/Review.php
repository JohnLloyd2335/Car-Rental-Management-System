<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rental_id', 'stars', 'comment'];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}
