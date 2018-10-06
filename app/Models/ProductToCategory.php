<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model {

    /**
     * Generated
     */

    protected $table = 'product_to_category';
    protected $fillable = ['id', 'category_id', 'product_id', 'display_order'];



}
