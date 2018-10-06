<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministratorsOld extends Model {

    /**
     * Generated
     */

    protected $table = 'administrators_old';
    protected $fillable = ['id', 'first_name', 'last_name', 'email', 'telephone', 'birth_date', 'password', 'billing_first_name', 'billing_last_name', 'billing_email', 'billing_telephone', 'billing_address', 'billing_city', 'billing_post_code', 'billing_state', 'billing_country', 'shipping_first_name', 'shipping_last_name', 'shipping_email', 'shipping_telephone', 'shipping_address', 'shipping_city', 'shipping_post_code', 'shipping_state', 'shipping_country', 'status', 'modifydate', 'createdate'];



}
