<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesTab extends Model {

    /**
     * Generated
     */

    protected $table = 'categories_tabs';
    protected $fillable = ['id', 'title', 'display_order', 'status', 'modifydate', 'createdate'];



}
