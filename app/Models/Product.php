<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProductType;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'photo',
        'price',
        'product_type_id',
        'attributes'
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
