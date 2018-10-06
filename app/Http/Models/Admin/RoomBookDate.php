<?php
namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class RoomBookDate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_booked_date';
    
    public function getRoomBookDates($limit, $page, $data) {
        $RoomBookDate = DB::table($this->table);

        
        
        return $RoomBookDate->all();

        //Sorting End
        
        //return $gstrates->paginate($limit);
    }
    
    public function order() 
    {
        return $this->belongsTo('App\Http\Models\Admin\Orders', 'order_id');
    } 
}