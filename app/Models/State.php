<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    /**
     * Generated
     */

    protected $table = 'states';
    protected $fillable = ['zone_id', 'country_id', 'name', 'code', 'status'];



}
