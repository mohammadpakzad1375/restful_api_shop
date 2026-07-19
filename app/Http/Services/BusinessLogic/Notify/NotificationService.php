<?php

namespace App\Http\Services\BusinessLogic\Notify;

use App\Events\Admin\Notify\Email\EmailCreated;
use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Notify\Email;
use App\Models\Notify\SMS;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public function showAllNotifications(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            $notifications = Auth::guard('sanctum')->user()->notifications()->limit(15)->get();

            Auth::guard('sanctum')->user()->unreadNotifications->markAsRead();

            return $notifications;

        });
    }

    public function showReadNotifications(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Auth::guard('sanctum')->user()->readNotifications()->limit(15)->get();
        });
    }

    public function showUnreadNotifications(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            $unreadNotifications = Auth::guard('sanctum')->user()->unreadNotifications()->limit(15)->get();

            Auth::guard('sanctum')->user()->unreadNotifications->markAsRead();

            return $unreadNotifications;

        });
    }

    public function deleteNotifications(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            Auth::guard('sanctum')->user()->notifications()->delete();

        });
    }
}
