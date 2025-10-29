<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use app\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
	    Gate::define('isAdmin', function(User $user) {
	    	return $user->role === 2 || $user->role === 3;
	    });

	    Gate::define('isSuperAdmin', function(User $user) {
	    	return $user->role === 3;
	    });
    }
}
