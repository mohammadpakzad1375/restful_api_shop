<?php

namespace App\Http\Middleware\Admin\User;

use App\Http\Services\RestfulApi\Facades\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->route('customer');

        if ($user->isAdmin()) {

            return ApiResponse::withSuccess(false)
                ->withResponseMessage('This action is unauthorized.')
                ->withResponseStatus(403)
                ->build()
                ->response(true);
        }

        return $next($request);
    }
}
