<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    /**
     * Generated
     */

    protected $table = 'brands';
    protected $fillable = ['id', 'title', 'image', 'status', 'last_modified'];



}
