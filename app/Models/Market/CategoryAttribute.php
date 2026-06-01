<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'unit',
        'category_id',
    ];

    protected $hidden = ['type','created_at','updated_at','deleted_at'];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
