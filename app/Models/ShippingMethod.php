<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model {

    /**
     * Generated
     */

    protected $table = 'shipping_methods';
    protected $fillable = ['id', 'type', 'title', 'product_cat', 'from_weight', 'to_weight', 'from_amount', 'to_amount', 'csv_file', 'csv_content', 'courier_charge', 'country', 'state', 'status'];



}
