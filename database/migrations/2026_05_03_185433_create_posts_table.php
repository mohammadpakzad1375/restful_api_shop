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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary');
            $table->text('body');
            $table->text('image')->nullable();
            $table->tinyInteger('commentable')->default(0)->comment('0 =>uncommentable, 1 => commentable');
            $table->timestamp('published_at');
            $table->string('slug')->unique()->nullable();
            $table->string('tags')->nullable();
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('category_id')->constrained('post_categories');
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
        Schema::dropIfExists('posts');
    }
};
