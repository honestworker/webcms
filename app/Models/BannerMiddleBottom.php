<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerMiddleBottom extends Model {

    /**
     * Generated
     */

    protected $table = 'banner_middle_bottom';
    protected $fillable = ['id', 'title', 'banner', 'start_date', 'end_date', 'display_order', 'enlarge_banner', 'pdf_link', 'url', 'created', 'status', 'token', 'modified'];



}
