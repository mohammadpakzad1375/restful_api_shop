<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TicketAdmin extends Model
{
    protected $fillable = [
        'user_id'
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
