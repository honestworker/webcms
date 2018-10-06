<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

    /**
     * Generated
     */

    protected $table = 'albums';
    protected $fillable = ['id', 'title', 'is_active', 'created'];



}
