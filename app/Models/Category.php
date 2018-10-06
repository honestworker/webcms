<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * Generated
     */

    protected $table = 'categories';
    protected $fillable = ['id', 'title', 'iconKeyword', 'image', 'alt_text', 'image2', 'alt_text2', 'short_description', 'order_no', 'parent_id', 'status', 'modifydate', 'createdate', 'code'];



}
