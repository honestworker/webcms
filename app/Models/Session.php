<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model {

    /**
     * Generated
     */

    protected $table = 'sessions';
    protected $fillable = ['id', 'payload', 'last_activity'];



}
