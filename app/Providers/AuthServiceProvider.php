<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Outlet;
use App\Models\TargetGroup;
use App\Policies\TeamLeadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    protected $policies = [
        //
    Outlet::class => TeamLeadPolicy::class,
    TargetGroup::class => TeamLeadPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
    
}
