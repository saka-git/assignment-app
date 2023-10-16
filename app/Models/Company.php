<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // リレーション
    public function linkedCompanies()
    {
        return $this->belongsToMany(Company::class, 'company_links', 'company_id', 'linked_company_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_links', 'linked_company_id', 'company_id');
    }

    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'recipient');
    }
}
