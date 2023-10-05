<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Offer;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class OfferPolicy
{
    /**
     * Determine whether the company can view any models.
     */
    public function viewAny(Company $company, Offer $offer): bool
    {
        return $company->id === $offer->company_id;
    }
}
