<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryHomeAddtabproductsdatum extends Model {

    /**
     * Generated
     */

    protected $table = 'category_home_addtabproductsdata';
    protected $fillable = ['id', 'productid', 'tabid', 'created', 'modified', 'display_order', 'category_id', 'homecatid'];



}
