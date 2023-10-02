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
    public function show(Company $company, Offer $offer): bool
    {
        return $company->id === $offer->company_id;
    }

    /**
     * Determine whether the company can update the model.
     */
    public function update(Company $company, Offer $offer): bool
    {
        return $company->id === $offer->company_id;
    }

    /**
     * Determine whether the company can delete the model.
     */
    public function delete(Company $company, Offer $offer): bool
    {
        return $company->id === $offer->company_id;
    }
}
