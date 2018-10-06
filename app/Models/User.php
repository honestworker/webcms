<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    /**
     * Generated
     */

    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'password', 'remember_token', 'image', 'first_name', 'last_name', 'telephone', 'birth_date', 'billing_first_name', 'billing_last_name', 'billing_email', 'billing_telephone', 'billing_address', 'billing_city', 'billing_post_code', 'billing_state', 'billing_country', 'shipping_first_name', 'shipping_last_name', 'shipping_email', 'shipping_telephone', 'shipping_address', 'shipping_city', 'shipping_post_code', 'shipping_state', 'shipping_country', 'status', 'isSuperAdmin', 'modifydate', 'createdate'];



}
