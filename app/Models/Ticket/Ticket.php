<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject',
        'description',
        'seen',
        'reference_id',
        'user_id',
        'category_id',
        'priority_id',
        'ticket_id',
        'status',
    ];

    protected $hidden = ['status','created_at','updated_at','deleted_at'];

    public function ticketCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function ticketPriority(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }
}
