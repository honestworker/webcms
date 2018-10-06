<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;

class Brands extends Model{

	protected $table = 'brands';

	function getAllBrands()
	{
		$brands = $this->where('status', '1')->orderBy('id', 'ASC')->select('id as brand_id', 'title', 'image')->get()->toArray();
		
		return $brands;
	}

	function getBrands()
	{
		$brands = array();
		$results = DB::table('brands')->select('*', 'id as brand_id')->where('status', '=', '1')->orderBy('id', 'ASC')->get();
		
		foreach($results as $result){
			$brands[] = array(
				'brand_id'			=> $result->brand_id,
				'title'					=> $result->title,
				'image'					=> $result->image,
			);
		}

		return $brands;
	}

	function products()
	{
		return $this->hasMany('App\Http\Models\Front\Product', 'brand_id');
	}
	
	function getAllTopSellingBrands()
	{
		return $this
		->with('products')
		->select('id','title')
		->where('status','1')
		->skip(0)
		->take(10)
		->get();
	}
	
	function getTopSellingBrands()
	{
		return DB::table('brands as b')->select('b.id','b.title',DB::raw('count(b.id) as total_products'))->rightjoin('products as p','p.brand_id','=','b.id')->where('b.status','1')->groupBy('b.id')->orderBy('total_products','desc')->skip(0)->take(10)->get();
				
	}
	
}

?>