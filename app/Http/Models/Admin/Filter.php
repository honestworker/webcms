<?php
namespace App\Http\Models\Admin; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
class Filter extends Model{

	public $timestamps = false;

	// get all brands
	function getFilters()
	{
		$results = DB::table('filters')->orderBy('title','asc')->get();		
		return $results;
	}
	
	function updateFilter($formData,$id)
	{
		$formData['last_modified'] = date('Y-m-d H:i:s');
		DB::table('filters')->where('id', $id)->update($formData);
	}
	
	
}