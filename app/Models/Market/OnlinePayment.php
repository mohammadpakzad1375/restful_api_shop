<?php

namespace App\Models\Market;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlinePayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'user_id',
        'gateway',
        'transaction_id',
        'pay_date',
        'bank_first_response',
        'bank_second_response',
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
