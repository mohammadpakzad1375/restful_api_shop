<?php

namespace App\Models\Market;

use App\Models\User\User;
use App\Observers\Admin\Market\CopanObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[ObservedBy([CopanObserver::class])]
class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'user_id',
        'address_id',
        'address_object',
        'payment_id',
        'payment_object',
        'payment_type',
        'payment_status',
        'delivery_id',
        'delivery_object',
        'delivery_amount',
        'delivery_status',
        'delivery_date',
        'order_final_amount',
        'order_discount_amount',
        'copan_id',
        'copan_object',
        'order_copan_discount_amount',
        'common_discount_id',
        'common_discount_object',
        'order_common_discount_amount',
        'order_total_products_discount_amount',
        'order_status',

    ];

    protected $hidden = ['status','created_at','updated_at','deleted_at'];

    protected $casts = [
        'delivery_date' => 'datetime',
        'address_object' => 'array',
        'payment_object' => 'array',
        'delivery_object' => 'array',
        'copan_object' => 'array',
        'common_discount_object' => 'array'
    ];

    protected function deliveryStatusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->delivery_status) {
                0 => 'pending shipment',
                1 => 'out for delivery',
                2 => 'shipped',
                3 => 'delivered',
            }
        );
    }

    protected function orderStatusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->order_status) {
                0 => 'not reviewed',
                1 => 'awaiting confirmation',
                2 => 'rejected',
                3 => 'approved',
                4 => 'canceled',
                5 => 'returned',
            }
        );
    }

    public function generateOrderCode(): string
    {
        do {
            $code = 'ORD-' . strtoupper(substr((string) Str::uuid(), 0, 12));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function delivery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function copan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Copan::class, 'copan_id');
    }

    public function commonDiscount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CommonDiscount::class, 'common_discount_id');
    }
}
