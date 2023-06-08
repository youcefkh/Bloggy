<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function ($app) {
            return new Category();
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('category', Category::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\app()->runningInConsole() && count(Schema::getColumnListing('categories'))) {
            $categories = Category::with(['articles','subcategories.articles'])->get()->sortByDesc(function (Category $user) {
                return $user->articles->sum('views');
            });
            Config::set('categories', $categories);

        }
    }
}
