<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model {

    /**
     * Generated
     */

    protected $table = 'usergroups';
    protected $fillable = ['id', 'groupName', 'type', 'status'];



}
