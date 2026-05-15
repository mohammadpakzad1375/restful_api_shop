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
        Schema::create('category_values', function (Blueprint $table) {
            $table->id();
            $table->text('value');
            $table->tinyInteger('type')->default(0)->comment('0 => simple, 1 => multi values selected by customer (affected on price)');
            $table->foreignId('category_attribute_id')->constrained('category_attributes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_values');
    }
};
