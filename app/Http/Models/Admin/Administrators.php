<?php
namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class Administrators extends Model{
	
	public function getAdministrator($administrator_id)
	{
		return DB::table('users')->where('id', '=', $administrator_id)->first();
	}

	public function getAdministrators($limit, $page, $data)
	{
		$administrators = DB::table('users')->where('isSuperAdmin', '=', '0');
		
		if(isset($data['email']) && trim($data['email']) != ''){
			$administrators->where('email', 'LIKE', '%' . $data['email'] . '%');
		}
		
		//Sorting Start
		$sort = 'ASC';
		$sort_by = 'createdate';
		
		if(isset($data['sort']) && $data['sort'] == 'DESC'){
			$sort = $data['sort'];
		}
		
		if(isset($data['sort_by']) && in_array($data['sort_by'], array('id', 'name', 'email', 'createdate', 'status'))){
			$sort_by = $data['sort_by'];
		}
		
		if($sort_by == 'name'){
			$administrators->orderBy('first_name', $sort);
			$administrators->orderBy('last_name', $sort);
		}
		else{
			$administrators->orderBy($sort_by, $sort);
		}
		//Sorting End
		
		return $administrators->paginate($limit);
	}
	
	public function getLastUpdated(){
		$modifydate = DB::table('users')->select('modifydate')->orderBy('modifydate', 'DESC')->take(1)->first();
		if($modifydate){
			return date('d M, Y @ h:i A', strtotime($modifydate->modifydate));
		}
		else{
			return false;
		}
	}
	
	public function get_paginate_msg($limit, $page, $data){
		$page = ($page ? ($page-1) * $limit : 0);
		
		//First query
		$administrators = DB::table('users')->where('isSuperAdmin', '=', '0')->select('id');		
		if(isset($data['email']) && trim($data['email']) != ''){
			$administrators->where('email', 'LIKE', '%' . $data['email'] . '%');
		}
		
		$results = $administrators->skip($page)->take($limit)->get();
		
		//Second query
		$administrators = DB::table('users')->where('isSuperAdmin', '=', '0');
		if(isset($data['email']) && trim($data['email']) != ''){
			$administrators->where('email', 'LIKE', '%' . $data['email'] . '%');
		}
		
		$count = $administrators->count();
		
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}
	
	public function deleteAdministrator($administrator_id){
		DB::table('users')->where('id', '=', $administrator_id)->delete();
	}
	
	public function addAdministrator($data){
		$insert = [
					'password' 				=> Hash::make($data['password']),
					'first_name' 			=> $data['first_name'],
					'last_name' 			=> $data['last_name'],
					'email' 				=> $data['email'],
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
					'isSuperAdmin'			=> '0',
					'modifydate'			=> date('Y-m-d H:i:s'),
					'createdate'			=> date('Y-m-d H:i:s'),
				];

		DB::table('users')->insert($insert);
	}

	public function editAdministrator($administrator_id, $data){
		$update = [
					'password' 				=> Hash::make($data['password']),
					'first_name' 			=> $data['first_name'],
					'last_name' 			=> $data['last_name'],
					'email' 				=> $data['email'],
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
					'modifydate'	=> date('Y-m-d H:i:s')
				];

		DB::table('users')->where('id', $administrator_id)->update($update);
	}
}