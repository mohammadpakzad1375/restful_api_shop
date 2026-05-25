<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Ticket\TicketAdmin;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_type',
        'email',
        'mobile',
        'national_code',
        'profile_photo_path',
        'password',
        'activation',
        'activation_date',
        'remember_token',
        'slug',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activation_date' => 'datetime',
        ];
    }

    protected function fullName() : Attribute
    {
        return Attribute::make(

            get: fn() => "{$this->first_name} {$this->last_name}",

        );
    }

    public function scopeAdmin($query)
    {
        return $query->where('user_type', 1);
    }

    public function scopeCustomer($query)
    {
        return $query->where('user_type', 0);
    }

    public function ticketAdmin(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TicketAdmin::class, 'user_id');
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
