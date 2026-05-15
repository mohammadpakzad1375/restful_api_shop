<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('address_object')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('payment_object')->nullable();
            $table->tinyInteger('payment_type')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->foreignId('delivery_id')->nullable()->constrained('delivery')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('delivery_object')->nullable();
            $table->decimal('delivery_amount', 20, 3)->nullable();
            $table->tinyInteger('delivery_status')->default(0)->comment('0 => ارسال نشده, 1 => در حال ارسال, 2 => ارسال شده, 3 => تحویل داده شده');
            $table->timestamp('delivery_date')->nullable();
            $table->decimal('order_final_amount', 20, 3)->nullable();
            $table->decimal('order_discount_amount', 20, 3)->nullable();
            $table->foreignId('copan_id')->nullable()->constrained('copans')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('copan_object')->nullable();
            $table->decimal('order_copan_discount_amount', 20, 3)->nullable();
            $table->foreignId('common_discount_id')->nullable()->constrained('common_discounts')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('common_discount_object')->nullable();
            $table->decimal('order_common_discount_amount', 20, 3)->nullable();
            $table->decimal('order_total_products_discount_amount', 20, 3)->nullable();
            $table->tinyInteger('order_status')->default(0)->comment('0 => بررسی نشده , 1 => در انتظار تایید , 2 => تایید نشده , 3 => تایید شده 4 => باطل شده , 5 => مرجوع شده');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
