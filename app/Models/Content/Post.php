<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'summary',
        'body',
        'image',
        'commentable',
        'published_at',
        'slug',
        'tags',
        'author_id',
        'category_id',
        'status',
    ];

    protected $hidden = ['slug','status','created_at','updated_at','deleted_at'];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    //delete all comments when post delete
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->comments()->delete();
        });
    }

    public function postCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {

        return $this->morphMany(Comment::class, 'commentable');
    }
}
