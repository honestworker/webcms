<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model {

    /**
     * Generated
     */

    protected $table = 'wishlist_items';
    protected $fillable = ['id', 'product_id', 'color_id', 'wishlist_id', 'priority', 'last_modified'];



}
