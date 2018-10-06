<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalDiscountsToCategory extends Model {

    /**
     * Generated
     */

    protected $table = 'global_discounts_to_category';
    protected $fillable = ['id', 'global_discount_id', 'category_id'];



}
