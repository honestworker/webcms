<?php
namespace App\Http\Models\Admin; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
class Brand extends Model{

	// get all brands
	function getBrands()
	{
		$results = DB::table('brands')->orderBy('title','asc')->get();		
		return $results;
	}
	
	// get active brands
	function getActiveBrands()
	{
		$results = DB::table('brands')->where('status','1')->orderBy('title','asc')->get();		
		return $results;	
	}
	
	
	function addBrand($formData,$imageName = null)
	{
		if($imageName)
			$data['image'] = $imageName;
		
		$status = (isset($formData['status']) && $formData['status'] == 'on') ? '1' : '0';
		
		$data['title'] = $formData['title'];
		$data['status'] = $status;	
		$data['last_modified'] = date('Y-m-d H:i:s');
		
		DB::table('brands')->insert($data);
	}
	
	function updateBrand($formData,$imageName = null)
	{
		if($imageName)
			$data['image'] = $imageName;
		
		$status = (isset($formData['status']) && $formData['status'] == 'on') ? '1' : '0';
		
		$data['title'] = $formData['title'];
		$data['status'] = $status;	
		$data['last_modified'] = date('Y-m-d H:i:s');
		
		DB::table('brands')->where('id', $formData['id'])->update($data);
	}
	
	function deleteBrands($item_id)
	{
		DB::table('brands')->whereIn('id',explode(',',$item_id))->delete();
		
	}
	
}