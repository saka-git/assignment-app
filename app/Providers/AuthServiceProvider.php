<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Application;
use App\Models\Message;
use App\Models\Offer;
use App\Policies\OfferPolicy;
use App\Policies\ApplicationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\MessagePolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Offer::class => OfferPolicy::class,
        Application::class => ApplicationPolicy::class,
        Message::class => MessagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
