<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Newsletter;
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

class NewsletterController extends Controller {
	private $data = array();
	
	/*
	|--------------------------------------------------------------------------
	| Newsletter Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "Newslettr Subscribers".
	|
	*/

	/**
	 * construct
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->NewsletterModel = new Newsletter();
	}


	/**
	 * Dashboard Page for Newsletter
	 */
	function index($item=10, $page=1)
	{
		$this->data['page'] = $page;
		$this->data['item'] = $item;
		
		$lastUpdated = $this->NewsletterModel->getLastUpdated();
		
		$subscribers = $this->NewsletterModel->getSubscribers($item, $page);
		
		//// Total user groups
		$totalSubscribers = DB::table('newsletter')->orderBy('id','desc')->get();
		$this->data['countSubscribers'] = count($totalSubscribers);
		
		$this->data['lastUpdated'] = $lastUpdated;
		
		$this->data['subscribers'] = $subscribers;
		
		$this->data['success'] = Session::get('response');
		Session::forget('response');
		
		$this->data['page_title']='Newsletter Subscribers:: Listing';
		
		if($this->data['countSubscribers'] < $item and $page!=1){
			return Redirect::to('web88cms/newsletter/'.$item.'/1');
		}
		
		return view('admin.newsletter.newsletter_list', $this->data);
	}
	
	
	/**
	 * Add Subscriber
	 */
	function addSubscriber()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'subscriberName' => 'required',
				'email' => 'required|email'
			]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->NewsletterModel->addSubscriber(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
	}
	
	
	/**
	 * Edit Subscriber
	 */
	function editSubscriber()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'subscriberName' => 'required',
				'email' => 'required|email'
			]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->NewsletterModel->updateSubscriber(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
		
	}
	
	
	/**
	 * Delete Subscriber
	 */
	function deleteSubscriber()
	{
		if(Request::isMethod('post'))
		{
			$this->NewsletterModel->deleteSubscribers(Request::input());
				
			return Redirect::to('web88cms/newsletter')->withFlashMessage('Subscriber(s) has been deleted successfully..');
		}
	}
	
	
	/**
	 * Delete All Subscriber
	 */
	function deleteAll()
	{
		$this->NewsletterModel->deleteAll();
				
		return Redirect::to('web88cms/newsletter')->withFlashMessage('All Subscribers has been deleted successfully..');
	}
	
	
	
	/**
	 * Export Newsletter Subscribers Table into CSV file
	 */
	function csv(){
		$table = DB::table('newsletter')->get();
		
		$filename = "subscribers.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle, array('name', 'email'));
	
		foreach($table as $row) {
			fputcsv($handle, array($row->name, $row->email));
		}
	
		fclose($handle);
	
		$headers = array(
			'Content-Type' => 'text/csv',
			'Content-Disposition' => 'attachment; filename="subscribers.csv"',
		);
	
		return Response::download('subscribers.csv', 'subscribers.csv', $headers);
	}

}
