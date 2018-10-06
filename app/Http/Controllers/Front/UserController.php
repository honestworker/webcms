<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Users;
use App\Http\Models\Countries;
use App\Http\Controllers\Customers;
use App\Http\Models\Front\Categories;
use App\Http\Models\Front\Product;
use App\Models\Customer;

use Session;
use Input;
use URL;
use Illuminate\Http\RedirectResponse;
//use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;
use Response;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {
	private $data = array();

	/**
	 * Create a user controller instance.
	 *
	 * @return void
	*/
	public function __construct()
	{
		//// make object for Users class to use user model
		$this->UsersModel = new Users();
		$this->CategoriesModel = new Categories();
	}

	/**
	 * Index page
	 *
	 * @return Response
	 */
	public function index(){
	}


	///// creatte an account form page
	public function create_account()
	{
		$this->data['page_title'] = 'Create an Account';
		$CountriesModel = new Countries();
		$this->data['countries'] = DB::table('countries')->orderBy('name', 'ASC')->get();

		$this->data['customCategories'] = $this->CategoriesModel->getCategories(0);

		return view('front.user.create_account', $this->data);
	}


	/////// create an account after post and insert value in DB table
	public function create_account_register()
	{



		$post=$_POST;
		$file= $_FILES;

		//dd(Request::input());
		if(Request::isMethod('post'))
		{
			/*//create password format validation rule
			Validator::extend('passwordFormat', function($field,$value,$parameters){
					if(preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[*@$!+%~]).{8,12}$/', $value)==true){
						return true;
					}else{
						return false;
					}
			});*/
			$messages = [
				'password_format' => 'Password length should be between 8-12 characters with combination of numeric',
			];

				$validator = Validator::make(Request::all(),[
				'billing_first_name' => 'required',
				'billing_last_name' => 'required',
				'billing_telephone' => 'required',
				'birth_date' => 'required',
				'billing_email' => 'required',
				'password' =>'required|min:8|max:12|',
				'passconf' => 'required',
				'newsletter_subscription' => 'required',
				'agree' => 'required',
				'billing_address' => 'required',
				'billing_city' => 'required',
				'billing_post_code' => 'required',
				//'billing_state' => 'required',
				'billing_country' => 'required',
				//'g-recaptcha-response' => 'required',
			],$messages);

			if ($validator->fails()) {
				$errors = $validator->errors()->all() ;
				return Redirect::to('create_account')->withInput()->with('error', 'Oops! Your account hasn\'t been created yet. Please check and correct the errors below.')->with('errors', $errors);
			}else{
				$results = DB::table('customers')->where('email',$post['billing_email'])->get();
				if( count($results) > 0 ) {
					return Redirect::to('create_account')->withInput()->with('error','This email  is address already registered .');
				}else {
					$this->UsersModel->insertregistereddata(Request::input());
					 return Redirect::to('create_account')->withInput()->with('success','Account  has been created successfully..');
				}
			}
		}

		return view('front.user.create_account');
	}


	///// Login page form
	public function login()
	{
		Session::forget('success');
		$this->data['page_title'] = 'Login';
		$this->data['customCategories'] = $this->CategoriesModel->getCategories(0);
		return view('front.user.login', $this->data);
	}

	////// login logic after post value from login page
	public function logincustomers() {
		Session::forget('success');
        $post = $_POST;
        $password = Hash::make($post['password']);
        $a = Hash::check($post['password'], $password);
        // print_r($post);
        $results = DB::table('customers')->where('email', $post['email'])->where('status', 1)->get();
        // print_r($results);die;
        if (count($results) > 0) {
            foreach ($results as $res) {
                $pw = $res->password;
                $b = Hash::check($post['password'], $pw); // true
            }

            if ($a == $b) {
                Session::put('userId', $res->id);
                Session::put('userEmail', $res->email);
                Session::put('userFirstName', $res->first_name);
                Session::put('userLastName', $res->last_name);

                if ($post['redirect'] == 'checkout') {
                    //return Redirect::intended('dashboard');
                    return redirect('/checkout');
                } else {
                    return Redirect::to('dashboard')->withInput();
                }
            }
            else {
                if ($post['redirect'] == 'checkout') {
                    return Redirect::to('/checkout')->withInput()->with([
                                'error' => 'Oops! You have entered wrong User ID or Password. Please try again.',
                                'errorType' => 'password'
                            ]);
                } else {
                    return Redirect::to('login')->withInput()->with('error', 'Oops! You have entered wrong User ID or Password. Please try again.');
                }
            }
        }
        else {

            if ($post['redirect'] == 'checkout') {
                    return Redirect::to('/checkout')->withInput()->with([
                        'error' => 'We are sorry! Your account does not exist. If you don\'t have an account with us, please proceed to registration page.',
                        'errorType'=>'account'
                        ] );
                }
            else {
                    return Redirect::to('login')->withInput()->with('error', 'We are sorry! Your account does not exist. If you don\'t have an account with us, please proceed to registration page.');
                }
        }
    }
	///// logout form account
	public function logout()
	{	Session::forget('userId');
		Session::forget('userEmail');
		Session::forget('userFirstName');
		Session::forget('userLastName');
		Session::forget('cart');
		//return Redirect::to('login')->withInput()->with('success','Logged Out.');
		return redirect(\URL::previous())->withInput()->with('success','Logged Out.');
	}

	////// dashboard after login
	public function dashboard()
	{
		$this->data['page_title'] = 'Account Dashboard';
		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
			//Load left
			$this->data['user_left'] = view('front.user.userLeft');

			///Get user detail
			$this->data['userDetail'] = $this->UsersModel->getUserById(Session::get('userId'));

			///Get order of user
			$this->data['userOrders'] = $this->UsersModel->getUserOrder(Session::get('userId'));

			////Get newsletter subscribation status
			$this->data['newsletterStatus'] = $this->UsersModel->getNewsletterStatus(Session::get('userEmail'));
			$this->data['customCategories'] = $this->CategoriesModel->getCategories(0);

			return view('front.user.dashboard', $this->data);
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}

	/////// view account information and edit
	public function accountEdit()
	{
		if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() != "accountedit")
		{
			Session::forget('success');
		}
		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
			$this->data['page_title'] = 'Account Edit';

			////// After POST data
			$post=$_POST;
			$file= $_FILES;
			if(Request::isMethod('post'))
			{
				//create password format validation rule
				Validator::extend('passwordFormat', function($field,$value,$parameters){
						if(preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[*@$!+%~]).{8,12}$/', $value)==true){
							return true;
						}else{
							return false;
						}
				});

				$messages = [
					'password_format' => 'Password length should be between 8-12 characters with combination of alphabet letters, digits & special characters (eg. *@$!+%~).',
				];

				$validator = Validator::make(Request::all(),[
					'billing_first_name' => 'required',
					'billing_last_name'  => 'required',
					'billing_telephone'  => 'required',
					// 'birth_date'         => 'required',
					'billing_email'      => 'required|email',
					'current_password'   =>'required',
					'password'           =>'passwordFormat',
					'billing_address'    => 'required',
					'billing_city'       => 'required',
					'billing_post_code'  => 'required',
					//'billing_state'    => 'required',
					'billing_country'    => 'required',
				],
											$messages);

				if ($validator->fails()) {
					$errors = $validator->errors()->all() ;
					return Redirect::to('accountedit')->withInput()->with('error', 'Oops! Your account information hasn\'t been updated yet. Please check and correct the errors below.')->with('errors', $errors);
				}else{
					///// check password and confirm password are match or not
					if($post['password']!=$post['passconf']){
						return Redirect::to('accountedit')->withInput()->with('error','Password and Confirm Password are not match!');
					}

					///// check password is correct?
					$password =  Hash::make($post['current_password']);
					$a= Hash::check($post['current_password'], $password);

					$results = DB::table('customers')->where('id','=', $post['userId'])->get();

					if( count($results) > 0 ) {

						foreach($results as $res){
							$pw= $res->password;
							$b =Hash::check($post['current_password'], $pw); // true
						}

						if($a==$b){
							$results = DB::table('customers')->where('email',$post['billing_email'])->where('id','!=', $post['userId'])->get();
							if( count($results) > 0 ) {
								return Redirect::to('accountedit')->withInput()->with('error','This email address is already in use.');
							}else {
								$this->UsersModel->updateAccount(Request::input());
								 return Redirect::to('accountedit')->withInput()->with('success','Account information has been updated successfully..');
							}
						}else{
							return Redirect::to('accountedit')->withInput()->with('error','Current password is not matched.Please check');
						}
					}
				}
			}


			//Load left
			$this->data['user_left'] = view('front.user.userLeft');

			///Get user detail
			$this->data['userDetail'] = $this->UsersModel->getUserById(Session::get('userId'));

			//Country
			$CountriesModel = new Countries();
			$this->data['countries'] = DB::table('countries')->orderBy('name', 'ASC')->get();

			//States of current country
			$CountriesModel = new Countries();
			$this->data['states'] = $CountriesModel->getStatesByCountry($this->data['userDetail'][0]->billing_country);

			$this->data['customCategories'] = $this->CategoriesModel->getCategories(0);

			return view('front.user.accountEdit', $this->data);
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}

	//// Get and update billing info
	public function billingaddress(){
		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
			$this->data['page_title'] = 'Billing Address';

			////// After POST data
			$post=$_POST;
			$file= $_FILES;
			if(Request::isMethod('post'))
			{
				$validator = Validator::make(Request::all(),[
					'billing_first_name' => 'required',
					'billing_last_name' => 'required',
					'billing_telephone' => 'required',
					'billing_email' => 'required|email',
					'billing_address' => 'required',
					'billing_city' => 'required',
					'billing_post_code' => 'required',
					//'billing_state' => 'required',
					'billing_country' => 'required',
				]);

				if ($validator->fails()) {
					$errors = $validator->errors()->all() ;
					return Redirect::to('billingaddress')->withInput()->with('error', 'Oops! Your billing information hasn\'t been updated yet. Please check and correct the errors below.')->with('errors', $errors);
				}else{
					$this->UsersModel->updateBillingInfo(Request::input());
					return Redirect::to('billingaddress')->withInput()->with('success','Billing information has been updated successfully..');
				}
			}


			//Load left
			$this->data['user_left'] = view('front.user.userLeft');

			///Get user detail
			$this->data['userDetail'] = $this->UsersModel->getUserById(Session::get('userId'));

			//Country
			$CountriesModel = new Countries();
			$this->data['countries'] = DB::table('countries')->orderBy('name', 'ASC')->get();

			//States of current country
			$CountriesModel = new Countries();
			$this->data['states'] = $CountriesModel->getStatesByCountry($this->data['userDetail'][0]->billing_country);

			return view('front.user.billingaddress', $this->data);
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}

	//// Get and update shipping info
	public function shippingaddress(){
		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
			$this->data['page_title'] = 'Shipping Address';

			////// After POST data
			$post=$_POST;
			$file= $_FILES;
			if(Request::isMethod('post'))
			{
				$validator = Validator::make(Request::all(),[
					'shipping_first_name' => 'required',
					'shipping_last_name' => 'required',
					'shipping_telephone' => 'required',
					'shipping_email' => 'required|email',
					'shipping_address' => 'required',
					'shipping_city' => 'required',
					'shipping_post_code' => 'required',
					//'shipping_state' => 'required',
					'shipping_country' => 'required',
				]);

				if ($validator->fails()) {
					$errors = $validator->errors()->all() ;
					return Redirect::to('shippingaddress')->withInput()->with('error', 'Oops! Your shipping information hasn\'t been updated yet. Please check and correct the errors below.')->with('errors', $errors);
				}else{
					$this->UsersModel->updateShippingInfo(Request::input());
					return Redirect::to('shippingaddress')->withInput()->with('success','Shipping information has been updated successfully..');
				}
			}


			//Load left
			$this->data['user_left'] = view('front.user.userLeft');

			///Get user detail
			$this->data['userDetail'] = $this->UsersModel->getUserById(Session::get('userId'));

			//Country
			$CountriesModel = new Countries();
			$this->data['countries'] = DB::table('countries')->orderBy('name', 'ASC')->get();

			//States of current country
			$CountriesModel = new Countries();
			$this->data['states'] = $CountriesModel->getStatesByCountry($this->data['userDetail'][0]->shipping_country);

			return view('front.user.shippingaddress', $this->data);
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}

	////user subscribe or unsubscribe
	public function newsletter(){
		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
				////// After POST data
				$post=$_POST;
				if(Request::isMethod('post'))
				{
					if(isset($post['nwslttr']) and $post['nwslttr']!='' and $post['nwslttr']=='subscribe'){
						$this->UsersModel->newsletter(Request::input());
						return Redirect::to('dashboard')->withInput()->with('success','Subscribed successfully..');
					}else{
						$this->UsersModel->newsletter(Request::input());
						return Redirect::to('dashboard')->withInput()->with('success','Unsubscribed successfully..');
					}
				}
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}

	////// My Order History
	public function orderhistory($sort='all', $page='1')
	{
		$this->data['sort'] = $sort;
		$this->data['page'] = $page;
		$this->data['item'] = 10;

		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
			$this->data['page_title'] = 'Order History';

			//Load left
			$this->data['user_left'] = view('front.user.userLeft');

			///Get all order of user
			$this->data['userOrders'] = $this->UsersModel->getUserAllOrder(Session::get('userId'), $sort, $page, $this->data['item']);

			//// Total orders
			// $totalOrders = DB::table('orders')->where('customer_id',Session::get('userId'))->orderBy('id','desc')->get();

			//get total order by sort
			$totalOrders =  $this->UsersModel->getUserAllSortOrder(Session::get('userId'), $sort);
			$this->data['countOrders'] = count($totalOrders);

			$this->data['customCategories'] = $this->CategoriesModel->getCategories(0);

			return view('front.user.orderhistory', $this->data);
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}

	////Get order detail
	public function orderdetails($id){
		if(Session::get('userId')!='' and Session::get('userEmail')!=''){
			$this->data['page_title'] = 'Order Detail';

			//Load left
			$this->data['user_left'] = view('front.user.userLeft');

			///Get all order of user
			$this->data['userOrderDetails'] = $this->UsersModel->getOrderDetail($id);

			$this->data['orderProducts'] = $this->UsersModel->getOrderToProduct($id);
			return view('front.user.orderdetails', $this->data);
		}else{
			return Redirect::intended('login')->withInput()->with('error','Oops! You have to need login to access for this section.');
		}
	}


	////// get states for a country
	public function getStates(){
		$CountriesModel = new Countries();
		$json['states'] = $CountriesModel->getStatesByCountry(Input::get('country_id'));
		return Response::json($json);
	}

	////////////////////////////////////////////////////
	/////////////reset password

	public function resetmail(Request $request)
	{
		$post=$_POST;
		$email= $post['email'];
		//echo $email;
		$recordSet = DB::table('customers')->where('email',$email)->get();

		$total=count($recordSet);
		if($total == 0)
		{
			$response = 'Email does not exist.';
		}
		else
		{
			// Get user details
			$userData = $recordSet;
			// dd($userData);
			$formData = $userData[0];
			$code=  rand(0,99999);
			$data['code'] = $code;
			DB::table('customers')->where('email', $email)->update($data);

			// send mail
			$to = $email;
			$to_name = $formData->first_name;

			$subject = "Password Recovery";

			$to = $formData->email;
			$to_name = $formData->first_name;
			$from = 'Reset Password in Ritz Garden Hotel <passwordreset@ritzgardenhotel.com>';
			$from_name = 'Password Reset';
			$subject = "Reset Password in Ritz Garden Hotel";

            $data = [
                'to' => $to,
                'to_name' => $to_name,
                'reset_link' => "http://" . Request::getHttpHost() . "/passwordreset?email=" . $to . "&code=" . $code,
                'logo_link' => 'http://'.Request::getHttpHost().'/public/front/images/index/logo.png'
            ];

            $message = view('emails.password', $data)->render();

			$headers = "From:".$from . "\r\n" ;
			$headers .= "MIME-Version: 1.0" . "\r\n";
        	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail($to,$subject,$message,$headers);

			/*Mail::send('emails.password', $data, function($message) use ($formData)
			{
				$message->from('passwordreset@ritzgardenhotel.com','Password Reset');
				$message->subject("Reset Password in Ritz Garden Hotel");
				$message->to($formData->email);
			});*/

			$response = 'Password has been sent to '.$email.' Kindly  check your email ';

		}
		//return $response;
		 return Redirect::to('login')->withInput()->with('success',$response);

	}
/************************************************/
	function passwordreset()
	{
		$this->data['page_title'] = 'Reset Password';
		return view('front.user.passwordreset', $this->data);
	}

/************************************************/
	function passwordresetpost()
	{
		$post= $_POST;
		$email= $post['email'];
		$code= $post['code'];
		$password= $post['password'];

		if(Request::isMethod('post'))
		{
			//create password format validation rule
			Validator::extend('passwordFormat', function($field,$value,$parameters){
					if(preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[*@$!+%~]).{8,12}$/', $value)==true){
					// if(preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{2,20}$/', $value)==true){
						return true;
					}else{
						return false;
					}
			});
			$messages = [
				'password_format' => 'Password length should be between 8-12 characters with combination of alphabet letters, digits & special characters (eg. *@$!+%~).',
			];
			$a = Request::all();
				$validator = Validator::make(Request::all(),[

				'password' =>'required|passwordFormat',
				// 'passconf' => 'required',
			],$messages);

			if ($validator->fails()) {
				$errors = $validator->errors()->all() ;
				return Redirect::to(Request::url()."?email=".$email."&code=".$code."" )->withInput()->with('error', 'Password length should be between 8-12 characters with combination of alphabet letters, digits & special characters (eg. *@$!+%~).')->with('errors', $errors);
			}else{
				$recordSet =DB::table('customers')->where('email',$email)->where('code',$code)->get();

				$total=count($recordSet);
				if($total == 0)
				{
					$response = 'Retry to reset your password.';
				}
		else
		{
				$data['password'] = Hash::make($password);
				$data['code'] = '';
				DB::table('customers')->where('email', $email)->update($data);

					//  return Redirect::to('login')->withInput()->with('success','Welcome back Dear "'.$email.'" ');
					 return Redirect::to(Request::url()."?email=".$email."&code=".$code."" )->with('success','You have successfully reset your password. Now you can use your new password to log in.');

			}
		}
	}
	}

	function sendemail(){
		// return(Request::all());

		$data = Request::get('invoice');
		$email = Request::get('email');

        $customerArr = Customer::where('id',$data['orderDetail'][0]['customer_id'])->first();

        // return($customerArr['id']);

        $id = $data['orderDetail'][0]['id'];

        $order = $this->UsersModel->getOrderDetail($id);

        $order_to_products =  $this->UsersModel->getOrderToProduct($id);

        // return $customerArr;
		$countryModel = new Countries();
	 	$billingInfo = ([ 'country' => $countryModel->getCountry($customerArr['billing_country']), 'state' => DB::table('states')->where('zone_id', '=', $customerArr['billing_state'])->get()[0] ]);
        // $shippingInfo = ([ 'country' => $countryModel->getCountry($customerArr['shipping_country']), 'state' =>  DB::table('states')->where('zone_id', '=', $customerArr['shipping_state'])->get()[0] ]);

        $invoice = array(
			'order' => $order[0],
			'order_to_products' => $order_to_products
		);
;

		$total = 0;
		$discount = 0;

    	$ProductsModel = new Product();

    	foreach ($invoice['order_to_products'] as $key => $value) {
    		$total += $value->sale_price*$value->quantity;
    		$discount += $value->quantity_discount*$value->quantity;
    	}

    	$invoice['promo'] = $ProductsModel->getDiscount(Session::get('_token'), $invoice['order_to_products'][0]->product_id);
    	$invoice['discount'] = $discount;
    	$invoice['billing_info'] = $billingInfo;
    	// $invoice['shipping_info'] = $shippingInfo;

    	$messageData = [
			'fromEmail' => 'registration@ritzgardenhotel.com',
			'fromName' => 'Ritz Garden Hotel Online Booking',
			'toEmail' => $email,
			'toName' => $invoice['order']->billing_first_name . ' ' . $invoice['order']->billing_last_name,
			'subject' => 'Ritz Garden Hotel::Order #' . $invoice['order']->order_id];

		Mail::send('invoice.admin-invoice-html', $invoice, function ($message) use ($messageData) {
			$message->from($messageData['fromEmail'], $messageData['fromName']);
			$message->to($messageData['toEmail'], '');
			$message->subject($messageData['subject']);
		});

		return json_encode(['success' => 'Email sent successfuly']);

	}

}
