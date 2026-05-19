<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMS extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "public_sms";

    protected $fillable = [
        'title',
        'body',
        'published_at',
        'status',
    ];

    protected $hidden = ['status','created_at','updated_at','deleted_at'];

    protected $casts = [
        'published_at' => 'datetime'
    ];
}
