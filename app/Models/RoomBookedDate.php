<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomBookedDate extends Model {

    /**
     * Generated
     */

    protected $table = 'room_booked_date';
    protected $fillable = ['id', 'date_checkin', 'date_checkout', 'order_id', 'product_id'];

    public $timestamps = false;

}
