<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttributeValue extends Model
{
    use SoftDeletes;

    protected $table = 'category_values';

    protected $fillable = [
        'value',
        'price_increase',
        'type',
        'category_attribute_id',
        'product_id',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CategoryAttribute::class, 'category_attribute_id');
    }
}
