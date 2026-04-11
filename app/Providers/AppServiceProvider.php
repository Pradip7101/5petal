<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\URL;
use App\Contracts\LogisticsHandler;
use App\Services\DelhiveryService;

class AppServiceProvider extends ServiceProvider
{
  
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogisticsHandler::class, DelhiveryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Customize the reset password URL for admin
        ResetPassword::createUrlUsing(function ($user, string $token) {
            if ($user->role === 'admin') {
                return URL::route('admin.password.reset', ['token' => $token, 'email' => $user->email]);
            }

            // Default behavior for other roles
            return URL::route('password.reset', ['token' => $token, 'email' => $user->email]);
        });
    }
}
