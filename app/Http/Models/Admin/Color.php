<?php
namespace App\Http\Models\Admin; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
class Color extends Model{

	// get all colors
	function getColors()
	{
		$results = DB::table('colors')->orderBy('title','asc')->get();		
		return $results;
	}
	
	// get active colors
	function getActiveColors()
	{
		$results = DB::table('colors')->where('status','1')->orderBy('title','asc')->get();		
		return $results;
	}
	
	function getDetails($color_id)
	{
		return DB::table('colors')->where('id',$color_id)->first();
	}
	
	function addColor($formData)
	{		
		$status = (isset($formData['status']) && $formData['status'] == 'on') ? '1' : '0';
		
		$data['status'] = $status;	
		$data['title'] = $formData['title'];
		$data['hex_code'] = $formData['hex_code'];
		$data['last_modified'] = date('Y-m-d H:i:s');
		
		DB::table('colors')->insert($data);
	}
	
	function updateColor($formData,$color_id)
	{		
		$status = (isset($formData['status']) && $formData['status'] == 'on') ? '1' : '0';
		
		$data['status'] = $status;	
		$data['title'] = $formData['title'];
		$data['hex_code'] = $formData['hex_code'];
		$data['last_modified'] = date('Y-m-d H:i:s');
		
		DB::table('colors')->where('id', $color_id)->update($data);
	}
	
	function deleteColors($item_id)
	{
		DB::table('colors')->whereIn('id',explode(',',$item_id))->delete();
		
	}
	
}