<?php

use App\Http\Controllers\Api\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Api\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Api\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Api\Admin\Content\FAQController;
use App\Http\Controllers\Api\Admin\Content\MenuController;
use App\Http\Controllers\Api\Admin\Content\PageController;
use App\Http\Controllers\Api\Admin\Content\PostController;
use App\Http\Controllers\Api\Admin\Market\AmazingSaleController;
use App\Http\Controllers\Api\Admin\Market\AttributeValueController;
use App\Http\Controllers\Api\Admin\Market\BrandController;
use App\Http\Controllers\Api\Admin\Market\CategoryAttributeController;
use App\Http\Controllers\Api\Admin\Market\CategoryController;
use App\Http\Controllers\Api\Admin\Market\CommentController;
use App\Http\Controllers\Api\Admin\Market\CommonDiscountController;
use App\Http\Controllers\Api\Admin\Market\CopanController;
use App\Http\Controllers\Api\Admin\Market\DeliveryController;
use App\Http\Controllers\Api\Admin\Market\GalleryController;
use App\Http\Controllers\Api\Admin\Market\OrderController;
use App\Http\Controllers\Api\Admin\Market\PaymentController;
use App\Http\Controllers\Api\Admin\Market\ProductColorController;
use App\Http\Controllers\Api\Admin\Market\ProductController;
use App\Http\Controllers\Api\Admin\Market\StorageController;
use App\Http\Controllers\Api\Admin\Notify\EmailController;
use App\Http\Controllers\Api\Admin\Notify\NotificationController;
use App\Http\Controllers\Api\Admin\Notify\SMSController;
use App\Http\Controllers\Api\Admin\Setting\SettingController;
use App\Http\Controllers\Api\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Api\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Api\Admin\Ticket\TicketController;
use App\Http\Controllers\Api\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Api\Admin\User\AdminUserController;
use App\Http\Controllers\Api\Admin\User\CustomerController;
use App\Http\Controllers\Api\Admin\User\PermissionController;
use App\Http\Controllers\Api\Admin\User\RoleController;
use App\Http\Controllers\Api\Customer\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('throttle:login')->post('admin/auth/login', [AdminAuthController::class,'login']);

Route::prefix('admin')->middleware(['auth:sanctum', 'admin.token.activity', 'throttle:admin-api'])->group(function (){

    Route::prefix('auth')->group(function () {

            Route::post('/logout', [AdminAuthController::class,'logout']);

            Route::patch('/change-password', [AdminAuthController::class, 'changePassword']);

        });

    Route::prefix('market')->group(function () {

        Route::apiResource('category', CategoryController::class)->names('admin.market.category');

        Route::apiResource('brand', BrandController::class)->names('admin.market.brand');

        Route::prefix('comment')->controller(CommentController::class)->group(function () {

            Route::get('', 'index')->name('admin.market.comment.index');
            Route::get('/{comment}', 'show')->name('admin.market.comment.show');
            Route::delete('/{comment}', 'destroy')->name('admin.market.comment.destroy');
            Route::patch('/approved/{comment}', 'approved')->name('admin.market.comment.approved');
            Route::patch('/status/{comment}', 'status')->name('admin.market.comment.status');

        });

        Route::apiResource('delivery', DeliveryController::class)->names('admin.market.delivery');

        Route::prefix('discount')->group(function () {

            Route::apiResource('common-discount', CommonDiscountController::class)->names('admin.market.discount.commonDiscount');
            Route::apiResource('amazing-sale', AmazingSaleController::class)->names('admin.market.discount.amazingSale');
            Route::apiResource('copan', CopanController::class)->names('admin.market.discount.copan');

        });

        Route::prefix('order')->group(function () {

            Route::get('/', [OrderController::class, 'all'])->name('admin.market.order.all');
            Route::get('new-order', [OrderController::class, 'newOrder'])->name('admin.market.order.newOrder');
            Route::get('awaiting-confirmation', [OrderController::class, 'awaitingConfirmation'])->name('admin.market.order.awaitingConfirmation');
            Route::get('unpaid', [OrderController::class, 'unpaid'])->name('admin.market.order.unpaid');
            Route::get('canceled', [OrderController::class, 'canceled'])->name('admin.market.order.canceled');
            Route::get('returned', [OrderController::class, 'returned'])->name('admin.market.order.returned');
            Route::get('/{order}', [OrderController::class, 'show'])->name('admin.market.order.show');
            Route::patch('change-delivery-status/{order}', [OrderController::class, 'changeDeliveryStatus'])->name('admin.market.order.changeDeliveryStatus');
            Route::patch('change-order-status/{order}', [OrderController::class, 'changeOrderStatus'])->name('admin.market.order.changeOrderStatus');
            Route::patch('change-payment-status/{order}', [OrderController::class, 'changePaymentStatus'])->name('admin.market.order.changePaymentStatus');
        });

        Route::prefix('payment')->group(function () {

            Route::get('/', [PaymentController::class, 'all'])->name('admin.market.payment.all');
            Route::get('online', [PaymentController::class, 'online'])->name('admin.market.payment.online');
            Route::get('cash', [PaymentController::class, 'cash'])->name('admin.market.payment.cash');
            Route::get('/{payment}', [PaymentController::class, 'show'])->name('admin.market.payment.show');
            Route::patch('cancel/{payment}', [PaymentController::class, 'cancel'])->name('admin.market.payment.cancel');
            Route::patch('return/{payment}', [PaymentController::class, 'return'])->name('admin.market.payment.return');

        });

        Route::prefix('product')->group(function () {

            Route::apiResource('/', ProductController::class)
                ->parameters(['' => 'product'])
                ->names('admin.market.product');

            Route::get('{product}/gallery', [GalleryController::class, 'index'])
                ->name('admin.market.product.gallery.index');

            Route::apiResource('gallery', GalleryController::class)
                ->only([ 'store', 'destroy'])
                ->names('admin.market.product.gallery');

            Route::get('{product}/color', [ProductColorController::class, 'index'])
                ->name('admin.market.product.color.index');

            Route::apiResource('color', ProductColorController::class)
                ->only(['store', 'destroy'])
                ->names('admin.market.product.color');

        });

        Route::prefix('category-attribute')->group(function () {

            //form kala (category_attributes)
            Route::get('category/{category}', [CategoryAttributeController::class, 'index'])
                ->name('admin.market.category-attribute.index');

            Route::apiResource('', CategoryAttributeController::class)
                ->except(['index'])
                ->parameters(['' => 'category_attribute'])
                ->names('admin.market.category-attribute');

            Route::get('{category_attribute}/value', [AttributeValueController::class, 'index'])
                ->name('admin.market.category-attribute.value.index');

            Route::apiResource('value', AttributeValueController::class)
                ->except(['index'])
                ->names('admin.market.category-attribute.value');

        });

        Route::prefix('storage')->controller(StorageController::class)->group(function (){

            Route::patch('add-to-storage/{product}', 'addToStorage')->name('admin.market.storage.add-to-storage');

            Route::patch('update/{product}', 'update')->name('admin.market.storage.update');

        });

    });

    Route::prefix('content')->group(function () {

        Route::apiResource('category', ContentCategoryController::class)->names('admin.content.category');

        Route::prefix('comment')->controller(ContentCommentController::class)->group(function () {

            Route::get('', 'index')->name('admin.content.comment.index');
            Route::get('/{comment}', 'show')->name('admin.content.comment.show');
            Route::delete('/{comment}', 'destroy')->name('admin.content.comment.destroy');
            Route::patch('/approved/{comment}', 'approved')->name('admin.content.comment.approved');
            Route::patch('/status/{comment}', 'status')->name('admin.content.comment.status');

        });

        Route::apiResource('faq', FAQController::class)->names('admin.content.faq');

        Route::apiResource('menu', MenuController::class)->names('admin.content.menu');

        //page creator
        Route::apiResource('page', PageController::class)->names('admin.content.page');

        Route::apiResource('post', PostController::class)->names('admin.content.post');

    });

    Route::prefix('user')->group(function () {

        Route::apiResource('admin-user', AdminUserController::class)
            ->parameters(['admin-user' => 'admin_user'])
            ->names('admin.user.admin-user');

        Route::apiResource('customer', CustomerController::class)->names('admin.user.customer');

        Route::apiResource('role', RoleController::class)->names('admin.user.role');

        Route::get('permission', [PermissionController::class, 'index'])->name('admin.user.permission.index');

    });

    Route::prefix('notify')->group(function () {

        Route::apiResource('email', EmailController::class)->only(['index','store','show'])->names('admin.notify.email');

//        Route::apiResource('sms', SMSController::class)->names('admin.notify.sms');

        Route::prefix('notification')->controller(NotificationController::class)->group(function (){

            Route::get('', 'all')->name('admin.notify.notification.all');
            Route::get('read', 'read')->name('admin.notify.notification.read');
            Route::get('unread', 'unread')->name('admin.notify.notification.unread');
            Route::delete('delete', 'destroy')->name('admin.notify.notification.destroy');

        });

    });

    Route::prefix('ticket')->group(function () {

        Route::apiResource('category', TicketCategoryController::class)->names('admin.ticket.category');

        Route::apiResource('priority', TicketPriorityController::class)->names('admin.ticket.priority');

        Route::prefix('admin')->controller(TicketAdminController::class)->group(function () {

            Route::get('/', 'index')->name('admin.ticket.admin.index');
            Route::post('/toggle/{admin}', 'toggle')->name('admin.ticket.admin.toggle');

        });

        Route::controller(TicketController::class)->group(function () {
            Route::get('new-tickets', 'newTickets')->name('admin.ticket.new-tickets');
            Route::get('open-tickets', 'openTickets')->name('admin.ticket.open-tickets');
            Route::get('close-tickets', 'closeTickets')->name('admin.ticket.close-tickets');
            Route::post('answer/{ticket}', 'answer')->name('admin.ticket.answer');
            Route::patch('change-status/{ticket}', 'changeStatus')->name('admin.ticket.change-status');
            Route::get('/{ticket}', 'show')->name('admin.ticket.show');
            Route::get('/', 'index')->name('admin.ticket.index');


        });

    });

    Route::apiResource('setting', SettingController::class)->except(['store', 'show', 'destroy'])->names('admin.setting');

});

Route::prefix('customer/auth')->group(function () {

    Route::post('send-otp', [CustomerAuthController::class, 'sendOtp'])
        ->middleware('throttle:send-otp');

    Route::post('verify-otp', [CustomerAuthController::class, 'verifyOtp'])
        ->middleware('throttle:verify-otp');

    Route::post('refresh', [CustomerAuthController::class, 'refresh'])
        ->middleware('throttle:refresh-token');

    Route::middleware([
        'auth:customer',
        'throttle:customer-auth',
    ])->group(function () {

        Route::post('logout', [CustomerAuthController::class, 'logout']);

        Route::post('logout-all-devices', [CustomerAuthController::class, 'logoutAllDevices']);

    });

});
