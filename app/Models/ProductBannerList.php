<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBannerList extends Model {

    /**
     * Generated
     */

    protected $table = 'product_banner_list';
    protected $fillable = ['id', 'title', 'category', 'tick', 'banner', 'start_date', 'end_date', 'created', 'status', 'token', 'modified'];



}
