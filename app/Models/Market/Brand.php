<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'persian_name',
        'original_name',
        'logo',
        'slug',
        'tags',
        'status'
    ];

    protected $hidden = ['slug','status','created_at','updated_at','deleted_at'];
}
