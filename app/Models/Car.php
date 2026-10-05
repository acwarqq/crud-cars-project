<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'release_year',
        'release_month',
        'price',
        'engine_displacement',
        'is_available',
        'body_type_id',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'engine_displacement' => 'decimal:1',
        ];
    }

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }
}