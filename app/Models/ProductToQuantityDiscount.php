<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToQuantityDiscount extends Model {

    /**
     * Generated
     */

    protected $table = 'product_to_quantity_discount';
    protected $fillable = ['id', 'product_id', 'from_quantity', 'to_quantity', 'discount', 'discount_by', 'status'];



}
