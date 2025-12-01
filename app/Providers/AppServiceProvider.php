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

        Gate::define('create-story', function (User $user) {
            return $user->role >= 1; // verified ir aukštesni gali kurti istorijas
        });

        Gate::define('edit-story', function (User $user, \App\Models\Story $story) {
            return $user->id === $story->user_id || $user->role >= 2; // redaguoti gali autorius arba admin/superadmin
        });

        Gate::define('delete-story', function (User $user, \App\Models\Story $story) {
            return $user->id === $story->user_id || $user->role >= 2; // trinti gali autorius arba admin/superadmin
        });
    }
}
