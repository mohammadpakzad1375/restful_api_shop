<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'show_in_menu',
        'slug',
        'tags',
        'status'
    ];

    //delete all products when category delete
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->products()->delete();
        });
    }

    protected $hidden = ['slug','status','created_at','updated_at','deleted_at'];

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // All recursiveChildren in a dataTree structure
    public function recursiveChildren(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->children()->with('recursiveChildren');
    }

    // All recursiveChildren in a flat collection
    public function flattenChildren(): \Illuminate\Support\Collection
    {
        return collect($this->recursiveChildren)->flatMap(function ($child) {
            return collect([$child])->merge($child->flattenChildren());
        });
    }

    public function attributes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryAttribute::class, 'category_id');
    }
}
