<?php

namespace App\Models\Content;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'body',
        'parent_id',
        'author_id',
        'commentable_id',
        'commentable_type',
        'seen',
        'approved',
        'status'
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }

    public function toggleApproved()
    {
        $this->approved = !$this->approved;
        $this->save();
    }

    public function commentable(){

        return $this->morphTo();
    }

    public function author(){

        return $this->belongsTo(User::class, 'author_id');
    }

    public function parent() {

        return $this->belongsTo(self::class, 'parent_id');
    }

    public function answers() {

        return $this->hasMany(self::class, 'parent_id');
    }
}
