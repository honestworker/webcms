<?php
namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class Customers extends Model{

	public function getCustomer($customer_id)
	{
		return DB::table('customers')->where('id', '=', $customer_id)->first();
	}
	
	public function getCustomers($limit, $page, $data)
	{
		$customers = DB::table('customers');

		if(isset($data['email']) && trim($data['email']) != ''){
			$customers->where('email', 'LIKE', '%' . $data['email'] . '%');
		}
		if(isset($data['customer_name']) && trim($data['customer_name']) != ''){
			$customers->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $data['customer_name'] . '%');
		}
		
		//Sorting Start
		$sort = 'DESC';
		$sort_by = 'createdate';
		
		if(isset($data['sort'])){
			$sort = $data['sort'];
		}
		
		if(isset($data['sort_by']) && in_array($data['sort_by'], array('id', 'name', 'email', 'createdate', 'status'))){
			$sort_by = $data['sort_by'];
		}
		
		if($sort_by == 'name'){
			$customers->orderBy('first_name', $sort);
			$customers->orderBy('last_name', $sort);
		}
		else{
			$customers->orderBy($sort_by, $sort);
		}
		//Sorting End
		
		return $customers->paginate($limit);
	}
	
	public function get_paginate_msg($limit, $page, $data){
		$page = ($page ? ($page-1) * $limit : 0);
		
		//First query
		$customers = DB::table('customers')->select('id');		
		if(isset($data['email']) && trim($data['email']) != ''){
			$customers->where('email', 'LIKE', '%' . $data['email'] . '%');
		}
		if(isset($data['customer_name']) && trim($data['customer_name']) != ''){
			$customers->where('first_name', 'LIKE', '%' . $data['customer_name'] . '%');
		}
		$results = $customers->skip($page)->take($limit)->get();
		
		//Second query
		$customers = DB::table('customers');
		if(isset($data['email']) && trim($data['email']) != ''){
			$customers->where('email', 'LIKE', '%' . $data['email'] . '%');
		}
		if(isset($data['customer_name']) && trim($data['customer_name']) != ''){
			$customers->where('first_name', 'LIKE', '%' . $data['customer_name'] . '%');
		}
		
		$count = $customers->count();
		
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}
	
	public function getLastUpdated(){
		$modifydate = DB::table('customers')->select('modifydate')->orderBy('modifydate', 'DESC')->take(1)->first();
		if($modifydate){
			return date('d M, Y @ h:i A', strtotime($modifydate->modifydate));
		}
		else{
			return false;
		}
	}
	
	public function addCustomer($data){
		$insert = [
					'password' 				=> Hash::make($data['password']),
					'first_name' 			=> $data['first_name'],
					'last_name' 			=> $data['last_name'],
					'email' 				=> $data['email'],
					'telephone' 			=> $data['telephone'],
					'birth_date' 			=> date('Y-m-d', strtotime($data['birth_date'])),
					'billing_first_name' 	=> $data['billing_first_name'],
					'billing_last_name' 	=> $data['billing_last_name'],
					'billing_email' 		=> $data['billing_email'],
					'billing_telephone' 	=> $data['billing_telephone'],
					'billing_address' 		=> $data['billing_address'],
					'billing_city' 			=> $data['billing_city'],
					'billing_post_code' 	=> $data['billing_post_code'],
					'billing_state' 		=> $data['billing_state'],
					'billing_country' 		=> $data['billing_country'],
					'shipping_first_name' 	=> $data['shipping_first_name'],
					'shipping_last_name' 	=> $data['shipping_last_name'],
					'shipping_email' 		=> $data['shipping_email'],
					'shipping_telephone' 	=> $data['shipping_telephone'],
					'shipping_address' 		=> $data['shipping_address'],
					'shipping_city' 		=> $data['shipping_city'],
					'shipping_post_code' 	=> $data['shipping_post_code'],
					'shipping_state' 		=> $data['shipping_state'],
					'shipping_country' 		=> $data['shipping_country'],
					'status'				=> (isset($data['status']) ? '1' : '0'),
					'modifydate'			=> date('Y-m-d H:i:s'),
					'createdate'			=> date('Y-m-d H:i:s'),
				];

		DB::table('customers')->insert($insert);
	}
	
	public function editCustomer($customer_id, $data){
		$update = [
					'first_name' 			=> $data['first_name'],
					'last_name' 			=> $data['last_name'],
					'email' 				=> $data['email'],
					'telephone' 			=> $data['telephone'],
					'birth_date' 			=> date('Y-m-d', strtotime($data['birth_date'])),
					'billing_first_name' 	=> $data['billing_first_name'],
					'billing_last_name' 	=> $data['billing_last_name'],
					'billing_email' 		=> $data['billing_email'],
					'billing_telephone' 	=> $data['billing_telephone'],
					'billing_address' 		=> $data['billing_address'],
					'billing_city' 			=> $data['billing_city'],
					'billing_post_code' 	=> $data['billing_post_code'],
					'billing_state' 		=> $data['billing_state'],
					'billing_country' 		=> $data['billing_country'],
					'shipping_first_name' 	=> $data['shipping_first_name'],
					'shipping_last_name' 	=> $data['shipping_last_name'],
					'shipping_email' 		=> $data['shipping_email'],
					'shipping_telephone' 	=> $data['shipping_telephone'],
					'shipping_address' 		=> $data['shipping_address'],
					'shipping_city' 		=> $data['shipping_city'],
					'shipping_post_code' 	=> $data['shipping_post_code'],
					'shipping_state' 		=> $data['shipping_state'],
					'shipping_country' 		=> $data['shipping_country'],
					'status'				=> (isset($data['status']) ? '1' : '0'),
					'modifydate'			=> date('Y-m-d H:i:s')
				];
		
		if($data['password'] != ''){
			$update['password'] = Hash::make($data['password']);
		}

		DB::table('customers')->where('id', $customer_id)->update($update);
	}
	
	public function deleteCustomer($customer_id){
		DB::table('customers')->where('id', '=', $customer_id)->delete();
	}
	
	public function getCustomerOrders($customer_id, $data = null)
	{
		//Sorting Start
		$sort = 'DESC';
		$sort_by = 'createdate';
		
		if(isset($data['sort'])){
			$sort = $data['sort'];
		}
		
		if(isset($data['sort_by']) && in_array($data['sort_by'], array('order_id', 'billing_email', 'createdate', 'status', 'payment_status', 'totalPrice'))){
			$sort_by = $data['sort_by'];
		}
		if(isset($data['sort_by']) && ($data['sort_by']) == 'name'){
			$sort_by = 'billing_first_name';
		}
		return DB::table('orders')->where('customer_id', $customer_id)->orderBy($sort_by, $sort)->get();
	}
	
	public function deleteCustomerOrder($customer_id, $order_id){
		$affected = DB::table('orders')->where('id', '=', $order_id)->where('customer_id', '=', $customer_id)->delete();

		if($affected){
			DB::table('order_to_product')->where('order_id', '=', $order_id)->delete();
		}
	}
	
	public function getCustomerWishlist($customer_id, $limit, $data=null)
	{
		//Sorting Start
		$sort = 'DESC';
		$sort_by = 'createdate';
		
		if(isset($data['sort'])){
			$sort = $data['sort'];
		}
		if(isset($data['sort_by']) && in_array($data['sort_by'], array('list_name', 'createdate', 'totalItems'))){
			$sort_by = $data['sort_by'];
		}
		
		$customers = DB::table('wishlist')->select('*', DB::raw('(SELECT COUNT(id) as total from wishlist_items WHERE wishlist_id = wishlist.id) as totalItems'));
		$customers->where('user_id', '=', $customer_id);
		$customers->orderBy($sort_by, $sort);

		return $customers->paginate($limit);
	}
	
	public function getWishlistPaginateMsg($customer_id, $limit, $page){
		$page = ($page ? ($page-1) * $limit : 0);
		
		//First query
		$results = DB::table('wishlist')->select('id')->where('user_id', '=', $customer_id)->skip($page)->take($limit)->get();
		
		//Second query
		$count = DB::table('wishlist')->where('user_id', '=', $customer_id)->count();
		
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}
	
	public function getWishlist($wishlist_id){
		return DB::table('wishlist')->where('id', '=', $wishlist_id)->first();
	}
	
	public function getWishlistProducts($wishlist_id){
		$result = DB::table('wishlist_items as wi');
		$result->select('wi.*', 'p.product_name', 'p.product_code', 'p.thumbnail_image_1', 'p.thumbnail_image_2', 'p.sale_price', 'p.quantity_in_stock', 'c.title as color_name');
		$result->leftjoin('colors as c','c.id', '=','wi.color_id' );
		$result->leftjoin('products as p','p.id', '=','wi.product_id' );
		$result->where('wi.wishlist_id', $wishlist_id);
		//$result->groupBy('p.id');

		return $result->get();
	}
	
	//Start special
	public function getCustomerSpecial($customer_id, $limit, $data = null)
	{
		//Sorting Start
		$sort = 'DESC';
		$sort_by = 'created';
		
		if(isset($data['sort'])){
			$sort = $data['sort'];
		}
		if(isset($data['sort_by']) && in_array($data['sort_by'], array('event_type', 'event_date', 'totalGifts'))){
			$sort_by = $data['sort_by'];
		}
		
		$customers = DB::table('special_events')->select('*', DB::raw('(SELECT COUNT(id) as total from special_events_items WHERE event_id = special_events.id) as totalGifts'));
		$customers->where('user_id', '=', $customer_id);
		$customers->orderBy($sort_by, $sort);

		return $customers->paginate($limit)->setPageName('page_s');
	}
	
	public function getSpecialPaginateMsg($customer_id, $limit, $page){
		$page = ($page ? ($page-1) * $limit : 0);
		
		//First query
		$results = DB::table('special_events')->select('id')->where('user_id', '=', $customer_id)->skip($page)->take($limit)->get();
		
		//Second query
		$count = DB::table('special_events')->where('user_id', '=', $customer_id)->count();
		
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}
	
	public function getSpecialList($special_id){
		return DB::table('special_events')->where('id', '=', $special_id)->first();
	}
	
	public function getSpecialListProducts($special_id){
		$result = DB::table('special_events_items as sei');
		$result->select('sei.*', 'p.product_name', 'p.product_code', 'p.thumbnail_image_1', 'p.thumbnail_image_2', 'p.sale_price', 'p.quantity_in_stock', 'c.title as color_name', DB::raw('(SELECT SUM(otp.quantity) as total from order_to_product as otp WHERE otp.product_id = sei.product_id AND otp.color_id = sei.color_id AND otp.special_event_id = sei.event_id) as totalGifts'));
		
		$result->leftjoin('colors as c','c.id', '=','sei.color_id' );
		$result->leftjoin('products as p','p.id', '=','sei.product_id' );
		
		$result->where('sei.event_id', $special_id);

		return $result->get();
	}
	//End special
}