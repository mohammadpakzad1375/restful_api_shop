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
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(20)
                ->by($request->user()?->id ?: $request->ip())
                ->response([$this, 'rateLimitResponse']);
        });

        RateLimiter::for('login', function (Request $request) {

            $identifier = $request->input('email') ?? $request->input('mobile');

            return Limit::perMinute(5)->by($identifier.'|'.$request->ip())
                ->response([$this, 'rateLimitResponse']);
        });
    }

    private function rateLimitResponse(Request $request, array $headers): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Too many requests.',
        ], 429, $headers);
    }
}
