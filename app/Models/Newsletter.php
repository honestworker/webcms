<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {

    /**
     * Generated
     */

    protected $table = 'newsletter';
    protected $fillable = ['id', 'name', 'email', 'status'];



}
