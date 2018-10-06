<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Usergroup;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;
use Response;

class UsergroupController extends Controller {
	private $data = array();
	
	/*
	|--------------------------------------------------------------------------
	| Usergroup Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "User Groups System".
	|
	*/

	/**
	 * construct
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->UsergroupModel = new Usergroup();
	}
	

	/**
	 * dashboard page of User Groups
	 */
	function index($item=10)
	{
		$page = (Input::get('page'))?Input::get('page'): '1';
		$this->data['page'] = $page;
		$this->data['item'] = $item;
		
		$this->data['sort'] = (Input::get('sort'))?Input::get('sort'): 'ASC';
		$this->data['sort_by'] = (Input::get('sort_by'))?Input::get('sort_by') : 'id';
		
		$lastUpdated = $this->UsergroupModel->getLastUpdated();
		
		$usergroups = $this->UsergroupModel->getUsergroups($item, $page, $this->data['sort_by'],$this->data['sort']);
		
		//// Total user groups
		$totalUserGroups = DB::table('usergroups')->orderBy($this->data['sort_by'],$this->data['sort'])->get();
		$this->data['countUserGroups'] = count($totalUserGroups);
		
		$this->data['lastUpdated'] = $lastUpdated;
		
		$this->data['usergroups'] = $usergroups;
		
		$this->data['success'] = Session::get('response');
		Session::forget('response');
		
		$this->data['paginate_msg'] = $this->UsergroupModel->get_paginate_msg($item, $page);
		
		$this->data['page_title']='User Groups:: Listing';	

		
		
		return view('admin.usergroup.usergroup_list', $this->data);
	}
	
	
	/**
	 * Add User Groups
	 */
	function addUsergroup()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'usergroupName' => 'required',
			]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->UsergroupModel->addUsergroup(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
	}
	
	
	/**
	 * Edit User Groups
	 */
	function editUsergroup()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'usergroupName' => 'required',
			]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->UsergroupModel->updateUsergroup(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
		
	}
	
	
	/**
	 * Delete User Groups
	 */
	function deleteUsergroup()
	{
		if(Request::isMethod('post'))
		{
			$this->UsergroupModel->deleteUsergroups(Request::input());
				
			return Redirect::to('web88cms/usergroups')->withFlashMessage('User group(s) has been deleted successfully..');
		}
	}
	
	
	/**
	 * Delete User Groups
	 */
	function deleteAll()
	{
		$this->UsergroupModel->deleteAll();
				
		return Redirect::to('web88cms/usergroups')->withFlashMessage('All User groups has been deleted successfully..');
	}
}
