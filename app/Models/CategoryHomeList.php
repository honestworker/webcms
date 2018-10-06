<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryHomeList extends Model {

    /**
     * Generated
     */

    protected $table = 'category_home_list';
    protected $fillable = ['id', 'cat_title', 'enable_tab', 'created', 'status', 'token', 'modified'];



}
