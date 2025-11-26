<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Beheerder;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // ...
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Gate: alleen superbeheerder (is_super) mag verwijderen
        Gate::define('delete-beheerder', function (?Beheerder $user) {
            return $user && $user->is_super;
        });
    }
}