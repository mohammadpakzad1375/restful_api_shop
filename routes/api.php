<?php

use App\Http\Controllers\Api\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Api\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Api\Admin\Content\FAQController;
use App\Http\Controllers\Api\Admin\Content\MenuController;
use App\Http\Controllers\Api\Admin\Content\PageController;
use App\Http\Controllers\Api\Admin\Content\PostController;
use App\Http\Controllers\Api\Admin\Market\BrandController;
use App\Http\Controllers\Api\Admin\Market\CategoryController;
use App\Http\Controllers\Api\Admin\Market\CommentController;
use App\Http\Controllers\Api\Admin\Market\DeliveryController;
use App\Http\Controllers\Api\Admin\Market\DiscountController;
use App\Http\Controllers\Api\Admin\Market\GalleryController;
use App\Http\Controllers\Api\Admin\Market\OrderController;
use App\Http\Controllers\Api\Admin\Market\PaymentController;
use App\Http\Controllers\Api\Admin\Market\ProductController;
use App\Http\Controllers\Api\Admin\Market\PropertyController;
use App\Http\Controllers\Api\Admin\Market\StoreController;
use App\Http\Controllers\Api\Admin\Notify\EmailController;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admin')->group(function (){

    Route::prefix('market')->group(function (){

        Route::apiResource('category', CategoryController::class)->names('admin.market.category');

        Route::apiResource('brand', BrandController::class)->names('admin.market.brand');

        Route::apiResource('comment', CommentController::class)->names('admin.market.comment');

        Route::apiResource('delivery', DeliveryController::class)->names('admin.market.delivery');

        Route::prefix('discount')->group(function (){

            Route::get('copan', [DiscountController::class, 'copan'])->name('admin.market.discount.copan');
            Route::get('common-discount', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('amazing-sale', [DiscountController::class, 'amazingSale'])->name('admin.market.discount.amazingSale');

        });

        Route::prefix('order')->group(function (){

            Route::get('/', [OrderController::class, 'all'])->name('admin.market.order.all');
            Route::get('new-order', [OrderController::class, 'newOrder'])->name('admin.market.order.newOrder');
            Route::get('sending', [OrderController::class, 'sending'])->name('admin.market.order.sending');
            Route::get('unpaid', [OrderController::class, 'unpaid'])->name('admin.market.order.unpaid');
            Route::get('canceled', [OrderController::class, 'canceled'])->name('admin.market.order.canceled');
            Route::get('returned', [OrderController::class, 'returned'])->name('admin.market.order.returned');
            Route::get('show', [OrderController::class, 'show'])->name('admin.market.order.show');
            Route::get('change-send-status', [OrderController::class, 'changeSendStatus'])->name('admin.market.order.changeSendStatus');
            Route::get('change-send-order', [OrderController::class, 'changeSendOrder'])->name('admin.market.order.changeSendOrder');
            Route::get('cancel-order', [OrderController::class, 'cancelOrder'])->name('admin.market.order.cancelOrder');

        });

        Route::prefix('payment')->group(function (){

            Route::get('/', [PaymentController::class, 'all'])->name('admin.market.payment.all');
            Route::get('online', [PaymentController::class, 'online'])->name('admin.market.payment.online');
            Route::get('offline', [PaymentController::class, 'offline'])->name('admin.market.payment.offline');
            Route::get('attendance', [PaymentController::class, 'attendance'])->name('admin.market.payment.attendance');
            Route::get('confirm', [PaymentController::class, 'confirm'])->name('admin.market.payment.confirm');

        });

        Route::apiResource('product', ProductController::class)->names('admin.market.product');

        Route::apiResource('product/gallery', GalleryController::class)->only(['index','store','destroy'])->names('admin.market.product.gallery');

        //form kala
        Route::apiResource('property', PropertyController::class)->names('admin.market.property');

        Route::apiResource('store', StoreController::class)->names('admin.market.store');

    });

    Route::prefix('content')->group(function (){

        Route::apiResource('category', ContentCategoryController::class)->names('admin.content.category');

        Route::prefix('comment')->controller(ContentCommentController::class)->group(function (){

            Route::get('','index')->name('admin.content.comment.index');
            Route::get('/{comment}','show')->name('admin.content.comment.show');
            Route::delete('/{comment}','destroy')->name('admin.content.comment.destroy');
            Route::patch('/approved/{comment}','approved')->name('admin.content.comment.approved');
            Route::patch('/status/{comment}','status')->name('admin.content.comment.status');

        });

        Route::apiResource('faq', FAQController::class)->names('admin.content.faq');

        Route::apiResource('menu', MenuController::class)->names('admin.content.menu');

        //page creator
        Route::apiResource('page', PageController::class)->names('admin.content.page');

        Route::apiResource('post', PostController::class)->names('admin.content.post');

    });

    Route::prefix('user')->group(function (){

        Route::prefix('admin-user')->controller(AdminUserController::class)->group(function (){

            Route::get('', 'index')->name('admin.user.admin-user.index');
            Route::post('', 'store')->name('admin.user.admin-user.store');
            Route::get('/{adminUser}', 'show')->name('admin.user.admin-user.show');
            Route::put('/{adminUser}', 'update')->name('admin.user.admin-user.update');
            Route::delete('/{adminUser}', 'destroy')->name('admin.user.admin-user.destroy');

        });

        Route::apiResource('customer', CustomerController::class)->names('admin.user.customer');

        Route::apiResource('role', RoleController::class)->names('admin.user.role');

        Route::apiResource('permission', PermissionController::class)->names('admin.user.permission');

    });

    Route::prefix('notify')->group(function (){

        Route::apiResource('email', EmailController::class)->names('admin.notify.email');

        Route::apiResource('sms', SMSController::class)->names('admin.notify.sms');

    });

    Route::prefix('ticket')->group(function (){

        Route::apiResource('category', TicketCategoryController::class)->names('admin.ticket.category');

        Route::apiResource('priority', TicketPriorityController::class)->names('admin.ticket.priority');

        Route::prefix('admin')->controller(TicketAdminController::class)->group(function (){

            Route::get('/','index')->name('admin.ticket.admin.index');
            Route::post('/toggle/{admin}','toggle')->name('admin.ticket.admin.toggle');

        });

        Route::controller(TicketController::class)->group(function (){

            Route::get('/','index')->name('admin.ticket.index');
            Route::post('/','store')->name('admin.ticket.store');
            Route::get('/{ticket}','show')->name('admin.ticket.show');
            Route::patch('/{ticket}','update')->name('admin.ticket.update');
            Route::delete('/{ticket}','destroy')->name('admin.ticket.destroy');
            Route::get('new-tickets','newTickets')->name('admin.ticket.new-tickets');
            Route::get('open-tickets','openTickets')->name('admin.ticket.open-tickets');
            Route::get('close-tickets','closeTickets')->name('admin.ticket.close-tickets');

        });

    });

    Route::apiResource('setting', SettingController::class)->except(['store', 'show', 'destroy'])->names('admin.setting');

});
