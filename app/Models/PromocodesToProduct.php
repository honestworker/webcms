<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocodesToProduct extends Model {

    /**
     * Generated
     */

    protected $table = 'promocodes_to_product';
    protected $fillable = ['id', 'promocode_id', 'product_id'];



}
