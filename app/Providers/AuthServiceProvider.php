<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-store', function ($user, $restaurant) {
            $authRest = User::where('restaurant_id', $restaurant->id);

            return  $authRest ? true : false;
        });

        Gate::define('admin-update', function ($user, $restaurant) {
            $authRest = User::where('restaurant_id', $restaurant->id);

            return $authRest ? true : false;
        });

        Gate::define('admin-destroy', function ($user, $restaurant) {
            $authRest = User::where('restaurant_id', $restaurant->id);

            return $authRest ? true : false;
        });
    }
}
