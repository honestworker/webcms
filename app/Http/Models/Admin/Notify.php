<?php
namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class Notify extends Model{

	public function getNotify($limit, $page, $data)
	{
		$notify = DB::table('notify_me as nm');
		$notify->select('nm.*', 'p.id as product_id', 'p.bed', 'p.room_code', 'p.thumbnail_image_1', 'p.thumbnail_image_2');
		$notify->leftjoin('products as p','p.id', '=','nm.product_id' );
		
		//Sorting Start
		$sort = 'DESC';
		$sort_by = 'createdate';
		
		if(isset($data['sort']) && $data['sort'] == 'ASC'){
			$sort = $data['sort'];
		}
		
		if(isset($data['sort_by']) && in_array($data['sort_by'], array('id', 'name', 'email', 'mail_send'))){
			$sort_by = $data['sort_by'];
		}
		
		$notify->orderBy('nm.' . $sort_by, $sort);
		//Sorting End
		
		return $notify->paginate($limit);
	}
	
	public function get_paginate_msg($limit, $page, $data){
		$page = ($page ? ($page-1) * $limit : 0);
		
		//First query
		$results = DB::table('notify_me')->select('id')->skip($page)->take($limit)->get();
		
		//Second query
		$count = DB::table('notify_me')->count();
		
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}
	
	public function getLastUpdated(){
		$createdate = DB::table('notify_me')->select('createdate')->orderBy('createdate', 'DESC')->take(1)->first();
		if($createdate){
			return date('d M, Y @ h:i A', strtotime($createdate->createdate));
		}
		else{
			return false;
		}
	}
	
	public function deleteNotify($notify){
		DB::table('notify_me')->whereIn('id', $notify)->delete();
	}
}