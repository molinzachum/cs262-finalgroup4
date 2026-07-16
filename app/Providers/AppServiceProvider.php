<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // // Define an 'admin' gate that checks if the user's role is 1
        // Gate::define('admin', function (User $user) {
        //     return $user->role === 1;
        // });

        // // Define a 'member' gate
        // Gate::define('member', function (User $user) {
        //     return $user->role === 0;
        // });
        
    }
}
