<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonDiscount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'percentage',
        'discount_ceiling',
        'minimum_order_amount',
        'start_date',
        'end_date',
        'status'
    ];

    protected $hidden = ['status','created_at','updated_at','deleted_at'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];
}
