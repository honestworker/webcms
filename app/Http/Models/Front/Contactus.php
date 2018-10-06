<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;

class Contactus extends Model{
	function createContact($contact){
		return $id = DB::table('contactus')->insertGetId($contact);
	}
}

?>