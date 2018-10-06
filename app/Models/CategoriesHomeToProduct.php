<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesHomeToProduct extends Model {

    /**
     * Generated
     */

    protected $table = 'categories_home_to_product';
    protected $fillable = ['id', 'category_home_id', 'category_tab_id', 'product_id', 'display_order', 'status'];



}
