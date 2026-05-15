<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'slug',
        'tags',
        'status'
    ];

    protected $hidden = ['slug','status','created_at','updated_at','deleted_at'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
