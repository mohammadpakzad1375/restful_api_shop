<?php

namespace App\Models\Ticket;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected function status() : Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == 1 ? 'closed' : 'open',
            set: fn ($value) => $value == 'closed' ? 1 : 0,
        );
    }

    public function scopeSeen($query)
    {
        return $query->where('seen', 1);
    }

    public function scopeUnseen($query)
    {
        return $query->where('seen', 0);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 0);
    }

    public function scopeClose($query)
    {
        return $query->where('status', 1);
    }

    public function toggleStatus()
    {
        $this->status = ($this->status == 'open') ? 'closed' : 'open';
        $this->save();
    }

    public function ticketCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function ticketPriority(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticketAdmin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'ticket_id');
    }

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'ticket_id');
    }
}
