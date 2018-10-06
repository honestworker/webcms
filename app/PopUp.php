<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PopUp extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'popup';
   protected $fillable = ['title','image','status'];

}
