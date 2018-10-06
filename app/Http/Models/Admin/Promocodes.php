<?php
namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

use App\Models\Order;


class Promocodes extends Model{

	public $timestamps = false;

	public function getPromocode($promocode_id)
	{
		return DB::table('promocodes')->where('id', '=', $promocode_id)->first();
	}

	public function getPromocodes($limit, $page, $data)
	{
		$promocodes = DB::table('promocodes as p')->select('p.*', DB::raw('(SELECT count(id) as total from orders WHERE orders.promocode_id = p.id) as timeOfUse'));

		//Sorting Start
		$sort = 'ASC';
		$sort_by = 'createdate';

		if(isset($data['sort']) && $data['sort'] == 'DESC'){
			$sort = $data['sort'];
		}

		if(isset($data['sort_by']) && in_array($data['sort_by'], array('id', 'campaign_name', 'promo_code', 'global_discounts', 'cat_prod', 'min_subtotal', 'discount', 'start_date', 'times_to_use', 'status'))){
			$sort_by = $data['sort_by'];
		}

		if($sort_by == 'cat_prod'){

		}
		else{
			$promocodes->orderBy($sort_by, $sort);
		}
		//Sorting End

		return $promocodes->paginate($limit);
	}

	public function get_paginate_msg($limit, $page, $data){
		$page = ($page ? ($page-1) * $limit : 0);

		//First query
		$promocodes = DB::table('promocodes')->select('id');
		$results = $promocodes->skip($page)->take($limit)->get();

		//Second query
		$promocodes = DB::table('promocodes');
		$count = $promocodes->count();

		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}

	public function getLastUpdated(){
		$modifydate = DB::table('promocodes')->select('modifydate')->orderBy('modifydate', 'DESC')->take(1)->first();
		if($modifydate){
			return date('d M, Y @ h:i A', strtotime($modifydate->modifydate));
		}
		else{
			return false;
		}
	}

	public function deletePromocode($promocode_id){
		DB::table('promocodes')->where('id', '=', $promocode_id)->delete();
	}

	public function addNewPromoCode($data){
		$insert = [
			'status'					=> (isset($data['status']) ? '1' : '0'),
			'campaign_name'				=> $data['campaign_name'],
			'promo_code'				=> $data['promo_code'],
			'min_subtotal'				=> $data['min_subtotal'],
			'discount'					=> $data['discount'],
			'discount_type'				=> $data['discount_type'],
			'start_date'				=> date('Y-m-d', strtotime($data['start_date'])),
			'end_date'					=> date('Y-m-d', strtotime($data['end_date'])),
			'times_to_use'				=> $data['times_to_use'],
			'global_discounts'			=> $data['global_discounts'],
			'free_shipping'				=> isset($data['free_shipping']) ? $data['free_shipping'] : 0,
			'coupon_application_rule'	=> $data['coupon_application_rule'],
			'modifydate'				=> date('Y-m-d H:i:s'),
			'createdate'				=> date('Y-m-d H:i:s')
		];

		DB::table('promocodes')->insert($insert);
		return DB::getPdo()->lastInsertId();
	}

	public function editPromoCode($id, $data){
		$update = [
			'status'					=> (isset($data['status']) ? '1' : '0'),
			'campaign_name'				=> $data['campaign_name'],
			'promo_code'				=> $data['promo_code'],
			'min_subtotal'				=> $data['min_subtotal'],
			'discount'					=> $data['discount'],
			'discount_type'				=> $data['discount_type'],
			'start_date'				=> date('Y-m-d', strtotime($data['start_date'])),
			'end_date'					=> date('Y-m-d', strtotime($data['end_date'])),
			'times_to_use'				=> $data['times_to_use'],
			'global_discounts'			=> $data['global_discounts'],
			'free_shipping'				=> isset($data['free_shipping']) ? $data['free_shipping'] : 0,
			'coupon_application_rule'	=> $data['coupon_application_rule'],
			'modifydate'				=> date('Y-m-d H:i:s')
		];

		DB::table('promocodes')->where('id', $id)->update($update);
	}

	public function addPromoCodeCategory($promocode_id, $category_id){
		DB::table('promocodes_to_category')->where('promocode_id', '=', $promocode_id)->where('category_id', '=', $category_id)->delete();

		$insert = [
			'promocode_id'				=> $promocode_id,
			'category_id'				=> $category_id,
		];

		DB::table('promocodes_to_category')->insert($insert);
	}

	public function addPromoCodeProduct($promocode_id, $products){
		foreach($products as $product_id){
			DB::table('promocodes_to_product')->where('promocode_id', '=', $promocode_id)->where('product_id', '=', $product_id)->delete();

			$insert = [
				'promocode_id'				=> $promocode_id,
				'product_id'				=> $product_id,
			];

			DB::table('promocodes_to_product')->insert($insert);
		}
	}

	public function getPromocodeCategories($id){
		return DB::table('promocodes_to_category as ptc')->select('ptc.*', 'c.title')->leftjoin('categories as c','c.id', '=','ptc.category_id' )->where('ptc.promocode_id', $id)->get();
	}

	public function getPromocodeProducts($id){
		return DB::table('promocodes_to_product as ptp')->select('ptp.*', 'p.type', 'p.room_code')->leftjoin('products as p','p.id', '=','ptp.product_id' )->where('ptp.promocode_id', $id)->get();
	}

	public function deletePromoCodeCategory($promocode_id, $category){
		DB::table('promocodes_to_category')->where('promocode_id', '=', $promocode_id)->whereIn('category_id',$category)->delete();
	}

	public function deletePromoCodeProduct($promocode_id, $products){
		DB::table('promocodes_to_product')->where('promocode_id', '=', $promocode_id)->whereIn('product_id', $products)->delete();
	}

	public function validPromoCode(){
		$countOfUsed = Order::where('promocode_id',$this->id)->count();
		if(($countOfUsed >= $this->times_to_use) || strtotime($this->end_date) < time()) {
			if($this->status != 0){
				$this->status = 0;
				$this->save();
			}
			return false;
		}

		return true;

	}
}
