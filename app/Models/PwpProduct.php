<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PwpProduct extends Model {

    /**
     * Generated
     */

    protected $table = 'pwp_products';
    protected $fillable = ['id', 'product_id', 'category_id', 'pwp_product_id', 'price', 'status'];



}
