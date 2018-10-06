<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryHomeListTablisting extends Model {

    /**
     * Generated
     */

    protected $table = 'category_home_list_tablisting';
    protected $fillable = ['id', 'category_id', 'title', 'display_order', 'created', 'status', 'token', 'modified'];



}
