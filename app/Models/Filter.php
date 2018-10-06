<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model {

    /**
     * Generated
     */

    protected $table = 'filters';
    protected $fillable = ['id', 'title', 'status', 'applied_to_categories', 'last_modified'];



}
