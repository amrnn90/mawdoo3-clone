<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'ar_AE.utf8');
        \Carbon\Carbon::setLocale(config('app.locale'));

        view()->composer('*', function($view) {
            $categories = Category::getCategoriesWithSub();
            $popularCategories = Category::popular()->take(7)->get();

            $view->with(compact('categories', 'popularCategories'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
