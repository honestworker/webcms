<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model {

    /**
     * Generated
     */

    protected $table = 'password_resets';
    protected $fillable = ['id', 'email', 'token'];



}
