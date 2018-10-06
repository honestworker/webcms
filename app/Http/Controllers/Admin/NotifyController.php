<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Notify;
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

class NotifyController extends Controller {
	private $data = array();
	private $NotifyModel = null;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->NotifyModel = new Notify();
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
		
		$this->data['success'] = Session::get('notify.success');
		Session::forget('notify.success');
		$this->data['warning'] = Session::get('notify.warning');
		Session::forget('notify.warning');

		$this->data['notifys'] = $this->NotifyModel->getNotify($limit, $page, Input::get());
		$this->data['paginate_msg'] = $this->NotifyModel->get_paginate_msg($limit, $page, Input::get());
		$this->data['last_updated'] = $this->NotifyModel->getLastUpdated();
		$this->data['curr_url'] = Request::url(). '?' . $_SERVER['QUERY_STRING'];
		
		//Sorting URL Start
		$sortingUrl = url('web88cms/notify/' . $limit) . '?';
		//Sorting URL End
		
		$this->data['limit'] = $limit;
		$this->data['page'] = $page;
		$this->data['sorting_url'] = $sortingUrl;
		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;
		
		$this->data['page_title'] = 'Notify:: Listing';
		
		return view('admin.notify.index', $this->data);
	}
	
	public function deleteAllNotify(){
		$notify = Input::get('notify');
		
		if($notify && is_array($notify)){
			$this->NotifyModel->deleteNotify($notify);
		}
		
		Session::put('notify.success', 'Notify users deleted successfully.');
		$json['success'] = 'TRUE';
		return Response::json($json);
	}
	
	function csv(){
		$table = DB::table('notify_me as nm');
		$table->select('nm.*', 'p.id as product_id', 'p.product_name', 'p.product_code');
		$results = $table->leftjoin('products as p','p.id', '=','nm.product_id')->get();

		$filename = "notify-me.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle, array('name', 'email', 'product', 'product_code', 'Notify User', 'createdate'));
	
		foreach($results as $row) {
			fputcsv($handle, array($row->name, $row->email, $row->product_name, $row->product_code, $row->mail_send, $row->createdate));
		}
	
		fclose($handle);
	
		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="' . $filename . '"',
		);
	
		return Response::download($filename, $filename, $headers);
	}
}
