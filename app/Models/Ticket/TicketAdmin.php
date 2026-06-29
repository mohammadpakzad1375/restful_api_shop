<?php

namespace App\Models\Ticket;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketAdmin extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id'
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
