<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model {

    /**
     * Generated
     */

    protected $table = 'role_user';
    protected $fillable = ['id', 'role_id', 'user_id'];



}
