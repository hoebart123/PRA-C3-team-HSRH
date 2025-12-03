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

        Gate::define('delete-beheerder', function ($user = null) {
            if (! $user) return false;
            return isset($user->is_super) ? (bool) $user->is_super : false;
        });
    }
}