<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;

    protected $table = 'Delivery';

    protected $fillable = [
        'name',
        'amount',
        'delivery_time',
        'delivery_time_unit',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected function time() : Attribute
    {
        return Attribute::make(

            get: fn() => "{$this->delivery_time} {$this->delivery_time_unit}",

        );
    }
}
