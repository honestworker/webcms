<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model {

    /**
     * Generated
     */

    protected $table = 'colors';
    protected $fillable = ['id', 'title', 'hex_code', 'status', 'last_modified'];



}
