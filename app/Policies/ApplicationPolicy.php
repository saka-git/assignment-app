<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Application;
use App\Models\Company;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{


    /**
     * Determine whether the user can show models.
     */
    public function viewAny(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine whether the user can company models.
     */
    public function company(Company $company, Application $application): bool
    {
        return $company->id === $application->offer->company_id;
    }
}
