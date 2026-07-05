<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Content\Post;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // for determine comment is for post or product
        Route::bind('comment', function ($value, $route) {

            $query = Comment::whereKey($value);

            if (str_contains($route->getName(), 'market.comment')) {
                $query->where('commentable_type', Product::class);
            }

            if (str_contains($route->getName(), 'content.comment')) {
                $query->where('commentable_type', Post::class);
            }

            return $query->firstOrFail();
        });
    }
}
