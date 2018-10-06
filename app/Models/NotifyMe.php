<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifyMe extends Model {

    /**
     * Generated
     */

    protected $table = 'notify_me';
    protected $fillable = ['id', 'product_id', 'name', 'email', 'mail_send', 'createdate'];



}
