<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model {

    /**
     * Generated
     */

    protected $table = 'promocodes';
    protected $fillable = ['id', 'campaign_name', 'promo_code', 'min_subtotal', 'discount', 'discount_type', 'start_date', 'end_date', 'times_to_use', 'global_discounts', 'free_shipping', 'coupon_application_rule', 'status', 'modifydate', 'createdate'];



}
