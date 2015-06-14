<?php namespace Omashu\Providers;

use Illuminate\Support\ServiceProvider;
use Omashu\Stock\Brand;

class ViewComposerProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.partials.navbar', function ($view) {
            $navBrands = Brand::with('categories')->get();
            $view->with(compact('navBrands'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
