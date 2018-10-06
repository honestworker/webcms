<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

	protected $table = 'locations';
	public static $unguarded = true;


    public static function getLocations()
    {
    	$arr = [];
    	$locations = Location::orderBy('state','asc')->get();
    	foreach($locations as $locations)
    	{
    		$arr[$locations->id] = $locations->state;
    	}
    	return $arr;
    }

}