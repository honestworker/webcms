<?php
namespace App\Http\Models; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
class User extends Model{

	public function getUser($id)
	{
		$user = array();
		$result = $this->find($id);	
		
		if($result)
			$user = array(
							'id'	=> $result->id,
							'name'	=> $result->name
						);
		
		return $user;
	}
	
	function getAlbums()
	{
		$albums = array();
		$albums = DB::table('albums')->get();	
		
		return $albums;	
	}
	
}

?>