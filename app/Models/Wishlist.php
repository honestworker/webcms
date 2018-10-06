<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {

    /**
     * Generated
     */

    protected $table = 'wishlist';
    protected $fillable = ['id', 'user_id', 'list_name', 'is_default', 'token', 'last_modified', 'createdate'];



}
