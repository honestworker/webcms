<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider
 * This is Service Provider for View Composer
 */
class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(['front.cart.*', 'front.checkout.*'], 'App\Http\ViewComposers\ShippingComposer');
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}