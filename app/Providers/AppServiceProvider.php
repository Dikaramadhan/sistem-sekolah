<?php

namespace App\Providers;

use App\Models\MataKajaran;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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
        // Route model binding
        Route::bind('mapel', function ($value) {
            return MataKajaran::findOrFail($value);
        });

        // Gate untuk role
        Gate::define('isAdmin', fn($user) => $user->role === 'admin');
        Gate::define('isGuru', fn($user) => $user->role === 'guru');
        Gate::define('isSiswa', fn($user) => $user->role === 'siswa');

        // Di AppServiceProvider boot()
        RateLimiter::for('login', function ($request) {
            return Limit::perMinute(3)->by($request->email . $request->ip());
        });

        // Naikkan timeout khusus saat artisan command
        if ($this->app->runningInConsole()) {
            set_time_limit(300);
        }
    }
}
