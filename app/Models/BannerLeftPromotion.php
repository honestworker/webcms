<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerLeftPromotion extends Model {

    /**
     * Generated
     */

    protected $table = 'banner_left_promotion';
    protected $fillable = ['id', 'title', 'short_description', 'banner', 'start_date', 'end_date', 'display_order', 'enlarge_banner', 'pdf_link', 'url', 'created', 'status', 'token', 'modified'];



}
