<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToImage extends Model {

    /**
     * Generated
     */

    protected $table = 'product_to_images';
    protected $fillable = ['id', 'product_id', 'file_name'];



}
