<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    /**
     * Generated
     */

    protected $table = 'pages';
    protected $fillable = ['id', 'page', 'background', 'new_content', 'old_content', 'edit_content', 'slider_text', 'bgimage'];



}
