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
class Copan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'amount',
        'amount_type',
        'discount_ceiling',
        'user_id',
        'start_date',
        'end_date',
        'status'
    ];

    protected $hidden = ['status','created_at','updated_at','deleted_at'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    protected function amountType() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => match ((int) $value) {
                0 => 'percentage',
                1 => 'price_unit',
            },
            set: fn ($value) => match ((string) $value) {
                '0', 'percentage' => 0,
                '1', 'price_unit' => 1,
                default => throw new \InvalidArgumentException(
                    "Invalid copan amount_type: {$value}"
                ),
            },
        );
    }

    public function generateCopanCode(): string
    {
        do {
            $code = 'OFF-' . now()->format('ymd') . '-' . strtoupper(Str::random(6));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
