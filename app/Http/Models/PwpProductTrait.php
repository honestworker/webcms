<?php namespace App\Http\Models;

use App\Http\Models\Admin\Product;
use DB;
use Helper;

trait PwpProductTrait {
	public static function getProductByCategoryId($id)
	{
		$product_ids = DB::table('product_to_category')
						->where('category_id', $id)
						->select('product_id')->lists('product_id');
		$product_ids = empty($product_ids) ? [0] : $product_ids;

		return Product::whereIn('id', array_unique($product_ids))->get();
	}

	public static function saveForm($data, $id)
	{
		if ($id && is_numeric($id)) {
			return parent::where('id', $id)->update($data);
		}

		$items = [];
		foreach($data['pwp_product_id'] as $key => $p_id) {
			$items[$key] = $data;
			$items[$key]['pwp_product_id'] = $p_id;
			$items[$key]['created_at'] = date('Y-m-d H:i:s');
		}

		return parent::insert($items);
	}

	public static function getByProductId($id)
	{
		return parent::where('status', 1)->where('product_id', $id)->with('product')->get();
	}
}