<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalDiscount extends Model {

    /**
     * Generated
     */

    protected $table = 'global_discounts';
    protected $fillable = ['id', 'from_amount', 'to_amount', 'discount', 'discount_by', 'status', 'last_modified'];



}
