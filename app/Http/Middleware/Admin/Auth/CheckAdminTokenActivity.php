<?php

namespace App\Http\Middleware\Admin\Auth;

use App\Http\Services\RestfulApi\Facades\ApiResponse;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminTokenActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('sanctum');

        if ($user) {

            $token = $user->currentAccessToken();

            if ($token) {

                $sevenDaysAgo = Carbon::now()->subDays(7);

                if ($token->last_used_at && $token->last_used_at->lt($sevenDaysAgo)) {
                    $token->delete();

                    return ApiResponse::withSuccess(false)
                        ->withResponseMessage('Token expired. Please login again.')
                        ->withResponseStatus(401)
                        ->build()
                        ->response(true);
                }
            }
        }

        return $next($request);
    }
}
