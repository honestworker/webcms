<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
     * Generated
     */

    protected $table = 'orders';
    protected $fillable = ['id', 'customer_id', 'order_id', 'billing_first_name', 'billing_last_name', 'billing_email', 'billing_telephone', 'billing_address', 'billing_city', 'billing_post_code', 'billing_state', 'billing_country', 'shipping_first_name', 'shipping_last_name', 'shipping_email', 'shipping_telephone', 'shipping_address', 'shipping_city', 'shipping_post_code', 'shipping_state', 'shipping_country', 'totalPrice', 'discount', 'promocode_id', 'transaction_id', 'payment_method', 'description', 'customer_notes', 'staff_notes', 'payment_status', 'status', 'shipping_method', 'shipping_charge', 'total_weight', 'shipping_estimate_country', 'shipping_estimate_state', 'tracking_number', 'comments', 'shipment_date', 'delivery_date', 'ip_address', 'modifydate', 'createdate'];

    public $timestamps = false;

}
