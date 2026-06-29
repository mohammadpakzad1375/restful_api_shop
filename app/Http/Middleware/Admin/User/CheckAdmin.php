<?php

namespace App\Http\Middleware\Admin\User;

use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->route('admin_user');

        if ($user->isCustomer()) {

            return ApiResponse::withSuccess(false)
                ->withResponseMessage('This action is unauthorized.')
                ->withResponseStatus(403)
                ->build()
                ->response(true);
        }

        return $next($request);
    }
}
