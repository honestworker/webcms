<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesHome extends Model {

    /**
     * Generated
     */

    protected $table = 'categories_home';
    protected $fillable = ['id', 'title', 'enable_tab', 'tabs', 'status', 'modifydate', 'createdate'];



}
