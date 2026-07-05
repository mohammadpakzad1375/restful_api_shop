<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $response = function (Request $request, array $headers) {
            return response()->json([
                'success' => false,
                'message' => 'Too many requests.',
            ], 429, $headers);
        };

        RateLimiter::for('api', function (Request $request) use ($response) {
            return Limit::perMinute(20)
                ->by($request->user()?->id ?: $request->ip())
                ->response($response);
        });

        RateLimiter::for('login', function (Request $request) use ($response) {

            $identifier = $request->input('email') ?? $request->input('mobile');

            return Limit::perMinute(5)->by($identifier.'|'.$request->ip())
                ->response($response);
        });
    }
}
