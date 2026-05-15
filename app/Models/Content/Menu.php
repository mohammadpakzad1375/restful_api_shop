<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'parent_id',
        'slug',
        'status',
    ];

    protected $hidden = ['slug', 'status', 'created_at', 'updated_at', 'deleted_at'];

    //delete all children when parent delete
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($menu) {
            foreach ($menu->children()->get() as $childMenu) {
                $childMenu->delete();
            }
        });
    }

    public function children()
    {

        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {

        return $this->belongsTo(self::class, 'parent_id');
    }
}
