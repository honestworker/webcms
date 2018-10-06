<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Administrators;
use App\Http\Models\Countries;

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

class AdministratorsController extends Controller {
	private $data = array();
	private $AdministratorsModel = null;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->AdministratorsModel = new Administrators();
	}		

	public function index($limit = 10)
	{
		$page = 0;

		if(Input::get('page')){
			$page = Input::get('page');
		}
		if(Input::get('sort')){
			$sort = Input::get('sort');
		}
		else{
			$sort = 'ASC';
		}
		if(Input::get('sort_by')){
			$sort_by = Input::get('sort_by');
		}
		else{
			$sort_by = 'createdate';
		}
		
		$this->data['success'] = Session::get('administrator.success');
		Session::forget('administrator.success');
		$this->data['warning'] = Session::get('administrator.warning');
		Session::forget('administrator.warning');

		$this->data['administrators'] = $this->AdministratorsModel->getAdministrators($limit, $page, Input::get());
		$this->data['paginate_msg'] = $this->AdministratorsModel->get_paginate_msg($limit, $page, Input::get());
		$this->data['last_updated'] = $this->AdministratorsModel->getLastUpdated();
		$this->data['curr_url'] = Request::url(). '?' . $_SERVER['QUERY_STRING'];
		
		//Sorting URL Start
		$sortingUrl = url('web88cms/administrators/' . $limit) . '?';
		if(Input::get('email')){
			$sortingUrl .= '&email=' . Input::get('email');
		}
		//Sorting URL End
		
		$CountriesModel = new Countries();
		$this->data['countries'] = $CountriesModel->getCountries();
		$this->data['limit'] = $limit;
		$this->data['page'] = $page;
		$this->data['sorting_url'] = $sortingUrl;
		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;
		
		$this->data['page_title'] = 'Administrators:: Listing';
		
		return view('admin.administrator.index', $this->data);
	}
	
	public function delete($administrator_id){
		$this->AdministratorsModel->deleteAdministrator($administrator_id);
		Session::put('administrator.success', 'Administrator deleted successfully.');
		
		if(Input::get('redirect')){
			return redirect(Input::get('redirect'));
		}
		else{
			return redirect(Input::get('web88cms/administrators'));
		}
	}
	
	public function deleteAllAdministrator(){
		$administrators = Input::get('administrators');
		
		if($administrators && is_array($administrators)){
			foreach($administrators as $administrator_id){
				$this->AdministratorsModel->deleteAdministrator($administrator_id);
			}
		}
		
		Session::put('administrator.success', 'Administrators deleted successfully.');
		$json['success'] = 'TRUE';
		return Response::json($json);
	}	
	
	public function newAdministrator(){
		$json = array();
		
		$validation['first_name'] = 'required';
		$validation['last_name'] = 'required';
		$validation['email'] = 'required|email|unique:users';
		$validation['password'] = 'required|min:6|max:12';
		$validation['password_confirmation'] = 'required|same:password';
		
		if(Input::get('billing_email')){
			$validation['billing_email'] = 'required|email';
		}
		
		if(Input::get('shipping_email')){
			$validation['shipping_email'] = 'required|email';
		}
				
		$validator = Validator::make(Request::all(), $validation);                
	
		if ($validator->fails()) {  
			$json['error'] = $validator->errors()->all(); 
		}
		else
		{
			$this->AdministratorsModel->addAdministrator(Request::all());
			Session::put('administrator.success', 'New administrator added successfuly.');
			$json['success'] = 'TRUE';
		}
		
		return Response::json($json);
	}
	
	public function getStates(){
		$CountriesModel = new Countries();
		$json['states'] = $CountriesModel->getStatesByCountry(Input::get('country_id'));
		return Response::json($json);
	}
	
	public function editAdministrator($administrator_id){
		$json = array();

		$validation['first_name'] = 'required';
		$validation['last_name'] = 'required';
		$validation['email'] = 'required|email|unique:users,email,'.$administrator_id;
		$validation['password'] = 'required|min:6|max:12';
		$validation['password_confirmation'] = 'required|same:password';
		
		if(Input::get('billing_email')){
			$validation['billing_email'] = 'required|email';
		}
		
		if(Input::get('shipping_email')){
			$validation['shipping_email'] = 'required|email';
		}
				
		$validator = Validator::make(Request::all(), $validation);                
	
		if ($validator->fails()) {  
			$json['error'] = $validator->errors()->all(); 
		}
		else
		{
			$this->AdministratorsModel->editAdministrator($administrator_id, Request::all());
			$json['success'] = 'Administrator updated successfuly.';
		}
		
		return Response::json($json);
	}
	
	function csv(){
		$table = DB::table('users')->select('first_name', 'last_name', 'email', 'birth_date', 'status', 'createdate')->where('isSuperAdmin', '=', '0')->get();
		
		$filename = "administrators.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle, array('first_name', 'last_name', 'email', 'birth_date', 'status', 'createdate'));
	
		foreach($table as $row) {
			fputcsv($handle, array($row->first_name, $row->last_name, $row->email, $row->birth_date, $row->status, $row->createdate));
		}
	
		fclose($handle);
	
		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' . $filename . '"',
		);
	
		return Response::download($filename, $filename, $headers);
	}
	
	/**
	 * search site
	 * first search for customer name and than customer email
	 * if customer not found than search for product
	 * if there is no product than set category_id to zero(0) to show no record found page
	 */
	function searchSite()
	{
		//dd(Request::input());
		$keyword = Request::input('keyword');
		
		//search for customers
		// search customer first name
		$result = DB::table('customers')->where('first_name','like','%'.$keyword.'%')->first();
		
		if(count($result) > 0)
			return redirect('/web88cms/customers?customer_name='.$keyword.'&email=');
		
		// search customer email
		$result = DB::table('customers')->where('email','like','%'.$keyword.'%')->first();
		
		if(count($result) > 0)
			return redirect('/web88cms/customers?customer_name=&email='.$keyword.'');
		
		//end search for customers	
		
		// search for products		
		// search for product name
		$result = DB::table('products')->where('product_name','like','%'.$keyword.'%')->first();
		
		if(count($result) > 0)
			return redirect('/web88cms/products/list?product_name='.$keyword.'&product_code=&price_from=&price_to=&brand_id=all&category_id=all');
		
		// search for product code	
		$result = DB::table('products')->where('product_code','like','%'.$keyword.'%')->first();
		
		if(count($result) > 0)
			return redirect('/web88cms/products/list?product_name=&product_code='.$keyword.'&price_from=&price_to=&brand_id=all&category_id=all');	
		
		// search for products by brand	name
		$result = DB::table('brands')->select('brands.id')->leftJoin('products','brands.id','=','products.brand_id')->where('brands.title','like','%'.$keyword.'%')->first();
		
		if(count($result) > 0)
			return redirect('/web88cms/products/list?product_name=&product_code=&price_from=&price_to=&brand_id='.$result->id.'&category_id=all');
		
		// search for products by category name
		$result = DB::table('categories as c')->select('c.id')->leftJoin('product_to_category as pc','c.id','=','pc.category_id')->where('c.title','like','%'.$keyword.'%')->first();
		
		if(count($result) > 0)
			return redirect('/web88cms/products/list?product_name=&product_code=&price_from=&price_to=&brand_id=all&category_id='.$result->id.'');
		
		//default (no record found)
		return redirect('/web88cms/products/list?product_name=&product_code=&price_from=&price_to=&brand_id=all&category_id=0');		
		
	}
}
