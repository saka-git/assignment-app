<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'requirements',
        'benefits',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'offer_id');
    }
}
