<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;

class CategoryPage extends Model{

	function getCategory($id = 0)
	{
		$category = array();
		$results = DB::table('categories')->select('*', 'id as category_id')->where('id', '=', $id)->get();
		
		foreach($results as $result){
			$category[] = array(
				'category_id'			=> $result->category_id,
				'title'					=> $result->title,
				'iconKeyword'			=> $result->iconKeyword,
				'image'					=> $result->image,
				'parent_id'				=> $result->parent_id,
				'order_no'				=> $result->order_no,
				'short_description'     => $result->short_description,
			);
		}
				
		return $category;	
	}
	
	
	function getSubCategories($parent_id = 0)
	{
		$categories = array();
		$results = DB::table('categories')->select('*', 'id as category_id')->where('parent_id', '=', $parent_id)->orderBy('order_no', 'ASC')->get();
		
		foreach($results as $result){
			$categories[] = array(
				'category_id'			=> $result->category_id,
				'title'					=> $result->title,
				'iconKeyword'			=> $result->iconKeyword,
				'image'					=> $result->image,
				'parent_id'				=> $result->parent_id,
				'order_no'				=> $result->order_no,
				'sub_categories'		=> $this->getSubCategories($result->category_id),
			);
		}
				
		return $categories;	
	}
	
	
	function getProducts($id = 0, $sort = 'new', $item=20, $page = 1)
	{
		if($page>1){
			$startLimit = ($page-1)*$item;
		}else{
			$startLimit = 0;	
		}
		
		$products = array();
		$totalProducts = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->get();
		

		if($sort == 'priceAsc'){
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.list_price', 'ASC')->skip($startLimit)->take($item)->get();
		}else if($sort == 'priceDesc'){
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.list_price', 'DESC')->skip($startLimit)->take($item)->get();
		}else if($sort == 'a-z'){
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.product_name', 'ASC')->skip($startLimit)->take($item)->get();
		}else if($sort == 'z-a'){
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.product_name', 'DESC')->skip($startLimit)->take($item)->get();
		}else if($sort == 'date'){
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.last_modified', 'DESC')->skip($startLimit)->take($item)->get();
		}else if($sort == 'brand'){
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.brand_id', 'ASC')->skip($startLimit)->take($item)->get();
		}else{
			$results = DB::table('products')
				->join('product_to_category', function($join) use($id)
				{
					$join->on('products.id', '=', 'product_to_category.product_id')
						 ->where('product_to_category.category_id', '=', $id);
				})
				->orderBy('products.id', 'ASC')->skip($startLimit)->take($item)->get();
		}
		
		foreach($results as $result){
			$products[] = array(
				'totalProducts'			=> count($totalProducts),
				'product_name'			=> $result->product_name,
				'product_code'			=> $result->product_code,
				'list_price'			=> $result->list_price,
				'large_image'			=> $result->large_image,
			);
		}
			
			
		
				
		return $products;	
	}
	
	function getProductBanners($catid = 0)
	{
		$banners = array();
		$results = DB::table('product_banner_list')->select('*')->where('category', '=', $catid)->get();
		
		foreach($results as $result){
				$banners[] = array(
					'title'			=> $result->title,
					'banner'		=> $result->banner,
				);
		}
				
		return $banners;	
	}
}

?>