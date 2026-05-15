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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('introduction');
            $table->text('image')->nullable();
            $table->decimal('weight',10,2)->nullable();
            $table->decimal('length',10,1)->nullable()->comment('cm unit');
            $table->decimal('width',10,1)->nullable()->comment('cm unit');
            $table->decimal('height',10,1)->nullable()->comment('cm unit');
            $table->decimal('price',20,3)->default(0);
            $table->tinyInteger('marketable')->default(1)->comment('0 => not marketable, 1 => marketable');
            $table->string('slug')->unique()->nullable();
            $table->string('tags')->nullable();
            $table->tinyInteger('sold_number')->default(0);
            $table->tinyInteger('frozen_number')->default(0);
            $table->tinyInteger('marketable_number')->default(0);
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('published_at');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
