<?php

namespace App\Models\Market;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id',
        'status',
        'type',
        'paymentable_id',
        'paymentable_type',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected function type() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => match ((int) $value) {
                0 => 'online',
                1 => 'cash',
            },
            set: fn ($value) => match ($value) {
                'online', 0 => 0,
                'cash', 1   => 1,
                default     => throw new \InvalidArgumentException("Invalid payment method: {$value}"),
            },
        );
    }

    protected function status() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => match ((int) $value) {
                0 => 'not_paid',
                1 => 'paid',
                2 => 'canceled',
                3 => 'returned',
            },
            set: fn ($value) => match ($value) {
                'not_paid', 0 => 0,
                'paid', 1     => 1,
                'canceled', 2 => 2,
                'returned', 3 => 3,
                default       => throw new \InvalidArgumentException("Invalid status value: {$value}"),
            },
        );
    }

    public function paymentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
