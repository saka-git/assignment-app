<?php

namespace App\Models;

// // use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',

    ];



    // リレーション
    public function accounts()
    {
        return $this->hasMany(CompanyAccount::class);
    }
    // public function linkedCompanies()
    // {
    //     return $this->belongsToMany(Company::class, 'company_links', 'company_id', 'linked_company_id');
    // }

    // public function companies()
    // {
    //     return $this->belongsToMany(Company::class, 'company_links', 'linked_company_id', 'company_id');
    // }

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