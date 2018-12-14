<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*  share public
           // $menu=[
            //     'menu',
            //     'thực chó',
            //     'product'
            // ];
            View::share('key', $menu);
        */
        // C2 : share 1 vài trang
        $menu=[
                'menu',
                'thực chó',
                'product'
            ];
        view()->composer('layout.header', function ($view) use($menu) {
            // $menu=[
            //     'menu',
            //     'thực chó',
            //     'product'
            // ];
            $view->with('menu',$menu);
        });
        /* share 
            view()->composer(['layout.header','layout.header'], function ($view) use($menu) {
                // $menu=[
                //     'menu',
                //     'thực chó',
                //     'product'
                // ];
                $view->with('menu',$menu);
            });
        */
        /* share all
            view()->composer('*', function ($view) use($menu) {
                // $menu=[
                //     'menu',
                //     'thực chó',
                //     'product'
                // ];
                $view->with('menu',$menu);
            });
        */
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
