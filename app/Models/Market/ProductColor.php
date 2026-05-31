<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'color_name',
        'color_code',
        'product_id',
        'price_increase',
        'status',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
