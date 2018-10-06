<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Promocodes;
use App\Http\Models\Admin\Category;
use App\Http\Models\Admin\Orders;

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

class PromocodesController extends Controller {
	private $data = array();
	private $PromocodesModel = null;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->PromocodesModel = new Promocodes();
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
		
		$this->data['success'] = Session::get('promocode.success');
		Session::forget('promocode.success');
		if(isset($this->data['promocode'])){
			$this->data['promocode'] = true;
		}
		$this->data['warning'] = Session::get('promocode.warning');
		Session::forget('promocode.warning');

		$this->data['promocodes'] = $this->PromocodesModel->getPromocodes($limit, $page, Input::get());
		$this->data['paginate_msg'] = $this->PromocodesModel->get_paginate_msg($limit, $page, Input::get());
		$this->data['last_updated'] = $this->PromocodesModel->getLastUpdated();
		$this->data['curr_url'] = Request::url(). '?' . $_SERVER['QUERY_STRING'];
		
		//Sorting URL Start
		$sortingUrl = url('web88cms/promocodes/' . $limit) . '?';
		if(Input::get('promocode_name')){
			$sortingUrl .= '&promocode_name=' . Input::get('promocode_name');
		}
		if(Input::get('email')){
			$sortingUrl .= '&email=' . Input::get('email');
		}
		//Sorting URL End
		
		$this->data['limit'] = $limit;
		$this->data['page'] = $page;
		$this->data['sorting_url'] = $sortingUrl;
		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;
		
		$this->data['page_title'] = 'Promo Codes/Global Coupons:: Listing';


		return view('admin.promocode.index', $this->data);
	}
	
	public function deleteAllPromocode(){
		$promocodes = Input::get('promocode');
		
		if($promocodes && is_array($promocodes)){
			foreach($promocodes as $promocode_id){
				$this->PromocodesModel->deletePromocode($promocode_id);
			}
		}
		
		Session::put('promocode.success', 'Promocodes deleted successfully.');
		$json['success'] = 'TRUE';
		return Response::json($json);
	}
	
	public function delete($promocode_id){
		$this->PromocodesModel->deletePromocode($promocode_id);
		Session::put('promocode.success', 'Promocode deleted successfully.');
		
		if(Input::get('redirect')){
			return redirect(Input::get('redirect'));
		}
		else{
			return redirect(Input::get('web88cms/promocodes'));
		}
	}
	
	public function addNew(){
		$this->data['errors'] = false;
		
		if (Request::isMethod('post'))
		{
			$validation['campaign_name'] = 'required';
			$validation['promo_code'] = 'required';
			
			$validator = Validator::make(Request::all(), $validation);
		
			if ($validator->fails()) {  
				$this->data['errors'] = $validator->errors('<p>:message</p>')->all(); 
			}
			else
			{
				Session::put('promocode.success', 'New promo code has been created successfully');
				$id = $this->PromocodesModel->addNewPromoCode(Input::get());				
				return redirect('/web88cms/promocodes/editPromoCode/' . $id);
			}
		}
		
		$this->data['success'] = Session::get('promocode.success');
		Session::forget('promocode.success');
		$this->data['warning'] = Session::get('promocode.warning');
		Session::forget('promocode.warning');
		
		$this->data['page_title'] = 'Promo Codes/Global Coupons:: Add New<';
		
		return view('admin.promocode.addNew', $this->data);
	}
	
	public function editPromoCode($id){
		$this->data['errors'] = false;
		if (Request::isMethod('post'))
		{
			$validation['campaign_name'] = 'required';
			$validation['promo_code'] = 'required';
			
			$validator = Validator::make(Request::all(), $validation);
		
			if ($validator->fails()) {  
				$this->data['errors'] = $validator->errors('<p>:message</p>')->all(); 
			}
			else
			{
				Session::put('promocode.success', 'Promo code has been updated successfully');
				$this->PromocodesModel->editPromoCode($id, Input::get());				
				return redirect('/web88cms/promocodes/editPromoCode/' . $id);
			}
		}
		
		$this->data['page_title'] = 'Promo Codes/Global Coupons:: Edit';
		
		$this->data['success'] = Session::get('promocode.success');
		Session::forget('promocode.success');
		$this->data['warning'] = Session::get('promocode.warning');
		Session::forget('promocode.warning');
		$this->data['from_promocode'] = false;
		if((Session::get('from_promocode'))){
			$this->data['from_promocode'] = true;
			Session::forget('from_promocode');
		}

		$promocode = $this->PromocodesModel->getPromocode($id);
		
		$this->data['promocode'] = $promocode;
		
		$CategoryModel = new Category();
		$this->data['categories'] =  $CategoryModel->getCategoriesTree();
		$this->data['promocodeCategories'] =  $this->PromocodesModel->getPromocodeCategories($id);
		$this->data['promocodeProducts'] =  $this->PromocodesModel->getPromocodeProducts($id);
		
		//Order
		$page = 0;
		$limit = 20;
		
		if(Input::get('page')){
			$page = Input::get('page');
		}
		if(Input::get('sort')){
			$sort = Input::get('sort');
		}
		else{
			$sort = 'DESC';
		}
		if(Input::get('sort_by')){
			$sort_by = Input::get('sort_by');
		}
		else{
			$sort_by = 'createdate';
		}
		
		//Sorting URL Start
		$sortingUrl = url('web88cms/promocodes/editPromoCode/' . $id) . '?';
		//Sorting URL End
		
		$OrdersModel = new Orders();
		$data = array(
			'promocode_id' 	=> $id,
			'sort'			=> $sort,
			'sort_by'		=> $sort_by
		);
		
		$this->data['orders'] = $OrdersModel->getOrders($limit, $page, $data);
		$this->data['paginate_msg'] = $OrdersModel->get_paginate_msg($limit, $page, $data);
		$this->data['curr_url'] = Request::url(). '?' . $_SERVER['QUERY_STRING'];
		$this->data['page'] = $page;
		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;
		$this->data['sorting_url'] = $sortingUrl;
		//End
		
		// if((Session::get('from_promocode'))){
		// 	dd($this->data);
		// }
		return view('admin.promocode.editPromoCode', $this->data);
	}
	
	public function addPromoCodeCategory($id){
		$json = array();
		
		if(Input::get('category_id')){
			$this->PromocodesModel->addPromoCodeCategory($id, Input::get('category_id'));

			Session::put('promocode.success', 'Category added to promocode successfuly.');
			Session::put('from_promocode', true);
			
			$json['success'] = 'Category added to promocode successfuly.';
		}
		
		return Response::json($json);
	}
	
	public function addPromoCodeProduct($id){
		$json = array();
		
		if(Input::get('product_id')){
			$this->PromocodesModel->addPromoCodeProduct($id, Input::get('product_id'));

			Session::put('promocode.success', 'Products added to promocode successfuly.');
			Session::put('from_promocode', true);
			
			$json['success'] = 'Products added to promocode successfuly.';
		}
		
		return Response::json($json);
	}
	
	public function deletePromocodeToCategory($id){
		$category = Input::get('category');
		
		if($category && is_array($category)){
			$this->PromocodesModel->deletePromoCodeCategory($id, $category);
		}
		
		if (Request::isMethod('post'))
		{
			$json['success'] = 'Category deleted to promocode successfuly.';

			Session::put('promocode.success', 'Category deleted to promocode successfuly.');
			Session::put('from_promocode', true);
			
			return Response::json($json);
		}
		else{
			return redirect('web88cms/promocodes/editPromoCode/' . $id);
		}
	}
	
	public function deletePromocodeToProduct($id){
		$product = Input::get('product');

		if($product && is_array($product)){
			$this->PromocodesModel->deletePromoCodeProduct($id, $product);
			// Session::put('promocode.success', 'Product deleted to promocode successfuly.');
		}
		
		if (Request::isMethod('post'))
		{
			$json['success'] = 'Product deleted to promocode successfuly.';

			Session::put('promocode.success', 'Product deleted to promocode successfuly.');
			Session::put('from_promocode', true);

			return Response::json($json);
		}
		else{
			return redirect('web88cms/promocodes/editPromoCode/' . $id);
		}
	}
}