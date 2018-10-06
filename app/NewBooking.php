<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBooking extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'new_booking';
    protected $fillable = ['description','status'];

}
