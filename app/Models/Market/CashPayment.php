<?php

namespace App\Models\Market;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashPayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id',
        'cash_receiver',
        'pay_date',
        'status',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected $casts = [
        'pay_date' => 'datetime'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }
}
