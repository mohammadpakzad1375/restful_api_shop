<?php

namespace App\Http\Controllers\Api\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notify\Notification\NotificationApiResourceCollection;
use App\Http\Services\BusinessLogic\Notify\NotificationService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct(private NotificationService $notificationService)
    {
    }

    public function all()
    {
        $result = $this->notificationService->showAllNotifications();

        return ApiResponse::withData(NotificationApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function read()
    {
        $result = $this->notificationService->showReadNotifications();

        return ApiResponse::withData(NotificationApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function unread()
    {
        $result = $this->notificationService->showUnreadNotifications();

        return ApiResponse::withData(NotificationApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function destroy()
    {
        $result = $this->notificationService->deleteNotifications();

        return ApiResponse::withResponseMessage('All notifications deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
