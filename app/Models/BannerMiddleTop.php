<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerMiddleTop extends Model {

    /**
     * Generated
     */

    protected $table = 'banner_middle_top';
    protected $fillable = ['id', 'title', 'banner', 'start_date', 'end_date', 'display_order', 'enlarge_banner', 'pdf_link', 'url', 'created', 'status', 'token', 'modified'];



}
