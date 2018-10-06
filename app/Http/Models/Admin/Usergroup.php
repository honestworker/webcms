<?php
namespace App\Http\Models\Admin; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
class Usergroup extends Model{

	/**
	 * Fetch User Groups From DB Table
	 */
	function getUsergroups($item, $page, $sort_by = 'id', $sort = 'desc')
	{

		$results = DB::table('usergroups')->orderBy($sort_by,$sort)->paginate($item);		
		return $results;
	}
	
	public function get_paginate_msg($limit, $page){
		$page = ($page ? ($page-1) * $limit : 0);
	
		//First query
		$administrators = DB::table('usergroups')->select('id');
	
		$results = $administrators->skip($page)->take($limit)->get();
	
		//Second query
		$administrators = DB::table('usergroups');
	
		$count = $administrators->count();
	
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}
	
		return $message;
	}
	
	/**
	 * Get Last Update Record From DB Table
	 */
	function getLastUpdated()
	{
		$results = DB::table('usergroups')->select('updated_at')->orderBy('updated_at','desc')->first();
		return ($results)?$results->updated_at:'';
	}
	
	
	/**
	 * Insert User Group to DB Table
	 */
	function addUsergroup($formData)
	{
		$results = DB::table('usergroups')->where('groupName',$formData['usergroupName'])->get();

		if(count($results)!=0){
			$json['error'] = "This User Group is Already in Use."; 
			echo json_encode($json);
			exit;
		}else{
			$data['groupName'] = $formData['usergroupName'];
			$data['type'] = $formData['type'];
			$status = (isset($formData['status']) && $formData['status'] == '1') ? '1' : '0';
			$data['status'] = $status;
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['created_at'] = date('Y-m-d H:i:s');

			
			DB::table('usergroups')->insert($data);
		}
	}
	
	
	/**
	 * Update User Group to DB Table
	 */
	function updateUsergroup($formData)
	{
		$results = DB::table('usergroups')->where('groupName',$formData['usergroupName'])->get();

		if(count($results)!=0 && $results[0]->id!=$formData['usergroupId']){
			$json['error'] = "This User Group is Already in Use."; 
			echo json_encode($json);
			exit;
		}else{
			$data['groupName'] = $formData['usergroupName'];
			$data['type'] = $formData['type'];
			$status = (isset($formData['status']) && $formData['status'] == '1') ? '1' : '0';
			$data['status'] = $status;
			
			$data['updated_at'] = date('Y-m-d H:i:s');
		
			DB::table('usergroups')->where('id', $formData['usergroupId'])->update($data);	
		}
	}
	
	/**
	 * Delete User Groups From DB Table
	 */
	function deleteUsergroups($formData)
	{
		DB::table('usergroups')->whereIn('id',explode(',',$formData['usergroupId']))->delete();
		
	}
	
	
	/**
	 * Delete User Groups From DB Table
	 */
	function deleteAll()
	{
		DB::table('usergroups')->delete();
		
	}
	
}