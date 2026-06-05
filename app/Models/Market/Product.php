<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'introduction',
        'image',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'marketable',
        'status',
        'sold_number',
        'frozen_number',
        'marketable_number',
        'category_id',
        'brand_id',
        'published_at',
        'tags',
        'slug',
    ];

    protected $hidden = ['slug','created_at','updated_at','deleted_at'];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function colors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function gallery(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function attributeValue(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryAttributeValue::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
