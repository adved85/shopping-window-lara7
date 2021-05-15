<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany
};

use App\User;


class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'grand_total',
        'item_count',
        'status',

        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'country',
        'post_code',
        'phone_number',
        'notes'
    ];

    protected $with = ['orderItems'];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the items for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
