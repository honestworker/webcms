<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Helper;
use Session;

/**
 * Class ShippingComposer
 * This class share general information to multi views
 */
class ShippingComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $shipping_charge = Helper::calculateShippingCharge();
        Session::put('shipping_charge', $shipping_charge);
        $view->with('shipping_charge', $shipping_charge);
    }
}