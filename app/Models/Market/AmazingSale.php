<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingSale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'percentage',
        'product_id',
        'start_date',
        'end_date',
        'status'
    ];

    protected $hidden = ['status','created_at','updated_at','deleted_at'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
