<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalDiscountsToProduct extends Model {

    /**
     * Generated
     */

    protected $table = 'global_discounts_to_products';
    protected $fillable = ['id', 'global_discount_id', 'product_id'];



}
