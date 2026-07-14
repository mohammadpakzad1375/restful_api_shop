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

        // Admin Limiters

        RateLimiter::for('admin-api', function (Request $request) use ($response) {
            return Limit::perMinute(20)
                ->by($request->user('sanctum')?->id ?: $request->ip())
                ->response($response);
        });

        RateLimiter::for('admin-auth', function (Request $request) use ($response) {
            return Limit::perMinute(10)
                ->by($request->user('sanctum')?->id ?: $request->ip())
                ->response($response);
        });

        RateLimiter::for('login', function (Request $request) use ($response) {

            $identifier = $request->input('email') ?? $request->input('mobile');

            return Limit::perMinute(5)->by($identifier.'|'.$request->ip())
                ->response($response);
        });


        // Customer Limiters

        RateLimiter::for('send-otp', function (Request $request) use ($response) {

            return Limit::perMinutes(10, 5)
                ->by($request->ip() . '|' . $request->input('email'))
                ->response($response);

        });

        RateLimiter::for('verify-otp', function (Request $request) use ($response) {

            return [
                Limit::perMinute(10)->by($request->ip())->response($response),
                Limit::perMinute(5)->by($request->input('email'))->response($response),
            ];

        });

        RateLimiter::for('refresh-token', function (Request $request) use ($response) {

            return Limit::perMinute(30)
                ->by($request->user('customer')?->id ?: $request->ip())
                ->response($response);

        });

        RateLimiter::for('customer-auth', function (Request $request) use ($response) {

            return Limit::perMinute(10)
                ->by(optional($request->user('customer'))->id ?: $request->ip())
                ->response($response);

        });
    }
}
