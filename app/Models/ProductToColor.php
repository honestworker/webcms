<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToColor extends Model {

    /**
     * Generated
     */

    protected $table = 'product_to_color';
    protected $fillable = ['id', 'color_id', 'product_id'];



}
