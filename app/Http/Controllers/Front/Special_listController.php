<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\SpecialList;
use App\Http\Models\Front\Product;
use App\Http\Models\Countries;
use App\Http\Models\Admin\Category;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Request;
use Cookie;

class Special_listController extends Controller {
	private $data = array();
	//private $BrandModel = null;
	private $CategoryModel = null;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
		$this->SpecialListModel = new SpecialList();
		$this->ProductsModel = new Product();	
		$this->CategoryModel = new Category();	
	}

	function index()
	{
		return redirect('/dashboard');
	}
	
	function loginRequired()
	{
		if(Session()->has('data.message'))
			$this->data['errors'][] = Session('data.message');
		else
			$this->data['errors'][] = 'Please login to continue';
			
		return view('errors.404',$this->data);	
	}
	
	function createEvent()
	{	
				
		if(Request::isMethod('post'))
		{
			//dd(Request::input());
			
			$validation_set = array(	'event_type' => 'required',
										'event_date' => 'required',
										'registrant_first_name' => 'required',
										'registrant_last_name' => 'required',
										'registrant_telephone' => 'required',												
										'registrant_birth_date' => 'required',
										'registrant_address' => 'required',
										'registrant_city' => 'required',
										'registrant_post_code' => 'required',
										//'registrant_state' => 'required',
										'registrant_country' => 'required',
										'co_registrant_first_name' => 'required',
										'co_registrant_last_name' => 'required',
										'co_registrant_telephone' => 'required',
										'co_registrant_address' => 'required',
										'co_registrant_city' => 'required',
										'co_registrant_post_code' => 'required',
										//'co_registrant_state' => 'required',
										'co_registrant_country' => 'required',
										//'preferred_state' => 'required',
										'preferred_store' => 'required');
										
								
			if(Request::input('send_gift_to') == 'other_address')
			{
				$new_rules = array(	'recipient_address' => 'required',
									'recipient_city' => 'required',
									'recipient_post_code' => 'required',
									//'recipient_state' => 'required',
									'recipient_country' => 'required');
				$validation_set = array_merge($validation_set, $new_rules);
			}
			
			if(Request::input('use_future_shipping_address'))
			{
				$new_rules = array(	'future_shipping_date' => 'required');
				$validation_set = array_merge($validation_set, $new_rules);
			}
			
			if(Request::input('future_shipping_address') == 'other_address')
			{
				$new_rules = array(	'future_shipping_recipient_address' => 'required',
									'future_shipping_recipient_city' => 'required',
									'future_shipping_recipient_post_code' => 'required',
									//'future_shipping_recipient_state' => 'required',
									'future_shipping_recipient_country' => 'required');
				$validation_set = array_merge($validation_set, $new_rules);
			}
			
			//dd($validation_set);
			
			$validator = Validator::make(	Request::all(),$validation_set); 			        
	
		  	if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				//echo json_encode($json);
				//return Redirect::back()->withErrors($validator);
				return Redirect::back()->withInput()->withErrors($validator);
				exit;
			}
			else
			{
				//dd(Request::input());
				
				$formData = Request::input();
				
				unset($formData['_token']);
				
				$formData['user_id'] = Session::get('userId');
				
				$formData['event_date'] = date('y-m-d', strtotime(str_replace(',','',$formData['event_date'])));				
				$formData['registrant_birth_date'] = date('y-m-d', strtotime(str_replace(',','',$formData['registrant_birth_date'])));
				
				if(isset($formData['same_registrant_address']))
				{
					unset($formData['same_registrant_address']);
					
					$formData['co_registrant_telephone'] = $formData['registrant_telephone'];
					$formData['co_registrant_address'] = $formData['registrant_address'];
					$formData['co_registrant_city'] = $formData['registrant_city'];
					$formData['co_registrant_post_code'] = $formData['registrant_post_code'];
					//$formData['co_registrant_state'] = $formData['registrant_state'];
					$formData['co_registrant_country'] = $formData['registrant_country'];
				}
				
				$formData['use_future_shipping_address'] = (isset($formData['use_future_shipping_address'])) ? 1 : 0;
				
				if($formData['use_future_shipping_address'])
					$formData['future_shipping_date'] = date('y-m-d', strtotime(str_replace(',','',$formData['future_shipping_date'])));
					
				$formData['token'] = md5(time());	
				$formData['last_modified'] = date('Y-m-d H:i:s');
				$formData['created'] = date('Y-m-d H:i:s');
				
				DB::table('special_events')->insert($formData);
				
				$this->data['success'] = 'Event saved successfully.';
				
				return Redirect::back()->with('data',$this->data);
					
			}// end else
			
		}
		
		// check logged in		
		if(Session('userId'))
		{	
			// get user data
			$this->data['user_data'] = DB::table('customers')->where('id', Session('userId'))->first();
			
				
			$CountriesModel = new Countries();
			$this->data['countries'] = $CountriesModel->getCountries();
			
			$this->data['list_states'] = $CountriesModel->getStates();
			$this->data['registrant_states'] = $CountriesModel->getStatesByCountry($this->data['user_data']->billing_country);
			
			
			$this->data['page_title'] = 'My Special List:: Create Event';
			return view('front.special_list.create_event',$this->data);	
		}
		else
		{		
			$msg = array('message' => 'Un-authorized access. Please login to continue.');
			return redirect('loginRequired')->with('data',$msg);	
		}
	}	
	
	function events()
	{
		// check logged in		
		if(Session('userId'))
		{
			$user_id = Session::get('userId');
			
			if(Input::get('sort_by'))
				$sort_by = Input::get('sort_by');
			else
				$sort_by = 'date';
			
			// get list of events
			$this->data['list_events'] = $this->SpecialListModel->getEvents($user_id,$sort_by);
			
			$this->data['page_title'] = 'My Special List';
			return view('front.special_list.events',$this->data);
		}
		else
		{		
			$msg = array('message' => 'Un-authorized access. Please login to continue.');
			return redirect('loginRequired')->with('data',$msg);	
		}
	}
	
	function deleteEvent()
	{
		$formData = Request::input();
		unset($formData['_token']);
		
		// delete wishlist
		DB::table('special_events')->where('id',$formData['delete_event_id'])->delete();
				
		$this->data['success'] = 'Event deleted successfully.';
		return Redirect::to('/events')->with('data',$this->data);		
		
	}
	
	function eventDetails($event_id)
	{
		// check logged in		
		if(Session('userId'))
		{			
			$user_id = Session::get('userId');		
			
			// event details
			$this->data['event_details'] = $this->SpecialListModel->eventDetails($event_id);
			
			// event items
			$this->data['event_items'] = $this->SpecialListModel->eventItems($event_id);
			
			// get category list
			$this->data['categories'] = $this->CategoryModel->getCategoriesTree();			
			
			$this->data['page_title'] = 'My Special List';
			return view('front.special_list.event_details',$this->data);
		}
		else
		{		
			$msg = array('message' => 'Un-authorized access. Please login to continue.');
			return redirect('loginRequired')->with('data',$msg);	
		}	
	}
	
	
	function deleteEventItem()
	{
		$formData = Request::input();
		unset($formData['_token']);
		
		// delete wishlisted items
		DB::table('special_events_items')->where('id',$formData['delete_event_item_id'])->delete();
		
		$this->data['success'] = 'Product deleted successfully.';
		return Redirect::back()->with('data',$this->data);		
		
	}

	
	function shareEvent()
	{
		$formData = Request::input();
		unset($formData['_token']);
		
		if(count($formData['share_to_email']) > 0)
		{
			foreach($formData['share_to_email'] as $recipient_email)
			{
				$mail = $recipient_email;
				$to = $recipient_email;
				$to_name = $recipient_email;
				$from = 'shop@tbm.com.my';
				$from_name = 'SHOP TBM';
				$subject = "Please have a look at my special list on TBM.";
				$message = "Please click on link below to see my special list.<br/><br/>";
				$message .= "<a href='".$formData['share_link_url']."'>".$formData['share_link_url']."</a>";
						
				$message .= "<br><br>Thank you<br>
				Best regards,<br>
				TBM Online Registration Manager<br>
				TAN BOON MING SDN BHD (494355-D)<br>
				PS 4,5,6 & 7, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.<br>
				Tel: (603) 7983-2020 (Hunting Lines)<br>
				Fax: (603) 7982-8141<br>
				info@tbm.com.my<br>
				Business Hours:<br>
				Mon. - Sat.: 9.30am - 9.00pm<br>
				Sun.: 10.00am - 9.00pm <br/>";
				
				$headers = "From:".$from . "\r\n" ;
				$headers .= "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				mail($to,$subject,$message,$headers);
			}
			
			$this->data['success'] = 'Special list shared successfully.';
			return Redirect::back()->with('data',$this->data);
		}
		else
		{			
			return Redirect::back();	
		}		
		
	}
	
	// view shared event
	function viewEvent()
	{
		$token = Input::get('token');
		$event_id = DB::table('special_events')->where('token',$token)->pluck('id');
		
		if($event_id)
		{
			// event details
			$this->data['event_details'] = $this->SpecialListModel->eventDetails($event_id);
			
			// event items
			$this->data['event_items'] = $this->SpecialListModel->eventItems($event_id);
			
			//Get Recent View Products
			$cookie = Cookie::get('recentViewProducts');
			$this->data['recentViewProducts'] = array();
			
			if($cookie){
				$explode = explode(',', $cookie);
				$this->data['recentViewProducts'] = $this->ProductsModel->getRecentViewProducts($explode);
			}
			//End
			
			
			$this->data['page_title'] = 'My Special List Details';
			return view('front.special_list.shared_event_details',$this->data);
		}
		else
		{
			$this->data['errors'][] = 'Wishlist not found.';
			return view('errors.404',$this->data);
			//return view('errors.404');
		}
	}
	
	function editEvent($event_id)
	{			
		if(Request::isMethod('post'))
		{
			//dd(Request::input());
			
			$validation_set = array(	'event_type' => 'required',
										'event_date' => 'required',
										'registrant_first_name' => 'required',
										'registrant_last_name' => 'required',
										'registrant_telephone' => 'required',												
										'registrant_birth_date' => 'required',
										'registrant_address' => 'required',
										'registrant_city' => 'required',
										'registrant_post_code' => 'required',
										//'registrant_state' => 'required',
										'registrant_country' => 'required',
										'co_registrant_first_name' => 'required',
										'co_registrant_last_name' => 'required',
										'co_registrant_telephone' => 'required',
										'co_registrant_address' => 'required',
										'co_registrant_city' => 'required',
										'co_registrant_post_code' => 'required',
										//'co_registrant_state' => 'required',
										'co_registrant_country' => 'required',
										//'preferred_state' => 'required',
										'preferred_store' => 'required');
										
			
			if(Request::input('send_gift_to') == 'other_address')
			{
				$new_rules = array(	'recipient_address' => 'required',
									'recipient_city' => 'required',
									'recipient_post_code' => 'required',
									//'recipient_state' => 'required',
									'recipient_country' => 'required');
				$validation_set = array_merge($validation_set, $new_rules);
			}
			
			if(Request::input('use_future_shipping_address'))
			{
				$new_rules = array(	'future_shipping_date' => 'required');
				$validation_set = array_merge($validation_set, $new_rules);
			}
			
			if(Request::input('future_shipping_address') == 'other_address')
			{
				$new_rules = array(	'future_shipping_recipient_address' => 'required',
									'future_shipping_recipient_city' => 'required',
									'future_shipping_recipient_post_code' => 'required',
									//'future_shipping_recipient_state' => 'required',
									'future_shipping_recipient_country' => 'required');
				$validation_set = array_merge($validation_set, $new_rules);
			}
			
			//dd($validation_set);
			
			$validator = Validator::make(	Request::all(),$validation_set); 			        
	
		  	if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				//echo json_encode($json);
				//return Redirect::back()->withErrors($validator);
				return Redirect::back()->withInput()->withErrors($validator);
				exit;
			}
			else
			{
				//dd(Request::input());
				
				$formData = Request::input();
				
				unset($formData['_token']);			
				
				$formData['user_id'] = Session::get('userId');
				
				$formData['event_date'] = date('Y-m-d', strtotime(str_replace(',','',$formData['event_date'])));	
						
				$formData['registrant_birth_date'] = date('Y-m-d', strtotime(str_replace(',','',$formData['registrant_birth_date'])));
				
				if(isset($formData['same_registrant_address']))
				{
					unset($formData['same_registrant_address']);
					
					$formData['co_registrant_telephone'] = $formData['registrant_telephone'];
					$formData['co_registrant_address'] = $formData['registrant_address'];
					$formData['co_registrant_city'] = $formData['registrant_city'];
					$formData['co_registrant_post_code'] = $formData['registrant_post_code'];
					//$formData['co_registrant_state'] = $formData['registrant_state'];
					$formData['co_registrant_country'] = $formData['registrant_country'];
				}
				
				$formData['use_future_shipping_address'] = (isset($formData['use_future_shipping_address'])) ? 1 : 0;
				
				if($formData['use_future_shipping_address'])
					$formData['future_shipping_date'] = date('Y-m-d', strtotime(str_replace(',','',$formData['future_shipping_date'])));
					
				//$formData['token'] = md5(time());	
				$formData['last_modified'] = date('Y-m-d H:i:s');
				//$formData['created'] = date('Y-m-d H:i:s');
				
				DB::table('special_events')->where('id',$event_id)->update($formData);
				
				$this->data['success'] = 'Changes saved successfully.';
				
				return Redirect::back()->with('data',$this->data);
					
			}// end else
			
		}
		
		// check logged in		
		if(Session('userId'))
		{		
			// event details
			$this->data['event_details'] = $this->SpecialListModel->eventDetails($event_id);
		
			$CountriesModel = new Countries();
			$this->data['countries'] = $CountriesModel->getCountries();
			
			$this->data['list_states'] = $CountriesModel->getStates();
			
			$this->data['registrant_states'] = $CountriesModel->getStatesByCountry($this->data['event_details']->registrant_country);
			$this->data['co_registrant_states'] = $CountriesModel->getStatesByCountry($this->data['event_details']->co_registrant_country);
			$this->data['recipient_states'] = $CountriesModel->getStatesByCountry($this->data['event_details']->recipient_country);
			$this->data['future_shipping_recipient_states'] = $CountriesModel->getStatesByCountry($this->data['event_details']->future_shipping_recipient_country);
			
			
			$this->data['page_title'] = 'My Special List:: Edit Event';
			return view('front.special_list.edit_event',$this->data);	
		}
		else
		{		
			$msg = array('message' => 'Un-authorized access. Please login to continue.');
			return redirect('loginRequired')->with('data',$msg);	
		}
	}
	
	function addGift()
        { 
            if(isset($_POST['color_id'])){
            $itemData['color_id'] = Input::get('color_id');
           }else{
               $itemData['color_id'] = 99999999;
           }
		$itemData['product_id'] = Input::get('product_id');
		
		$itemData['event_id'] = Input::get('event_id');
		$itemData['would_love'] = Input::get('would_love');
		$itemData['still_need'] = Input::get('would_love');
		$itemData['last_modified'] = date('Y-m-d H:i:s');
		
		// check if product with same color exist in event
		$event_item = DB::table('special_events_items')->where('product_id',$itemData['product_id'])->where('color_id',$itemData['color_id'])->where('event_id',$itemData['event_id'])->first();
		
		if($event_item)
		{
			$itemData['would_love'] = $itemData['would_love'] + $event_item->would_love;
			$itemData['still_need'] = $itemData['still_need'] + $event_item->still_need;
			
			DB::table('special_events_items')->where('id',$event_item->id)->update($itemData);	
		}
		else
		{
			DB::table('special_events_items')->insert($itemData);
		}	
		
		echo json_encode(array('response'=>'success'));		
	}	
}
