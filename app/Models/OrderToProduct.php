<?php
 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderToProduct extends Model {

    /**
     * Generated
     */

    protected $table = 'order_to_product';
    protected $fillable = ['id', 'order_id', 'product_id', 'quantity', 'pwp_price', 'color_id', 'special_event_id', 'amount', 'gst', 'shipping_amount', 'quantity_discount', 'global_discount', 'promo_code_discount'];

    public $timestamps = false;

}
