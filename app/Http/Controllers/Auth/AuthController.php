<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Config;
use Auth;

use Input;

use Validator;
use Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
	
	protected $redirectPath = '/web88cms/dashboard';
	
	

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{		
		$this->auth = $auth;
		//echo '<pre>'; print_r($auth); exit;
		$this->registrar = $registrar;
		

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	public function postLogin(){
		$validator = Validator::make(Request::all(), [
			'email' => 'required|email',
			'password' => 'required',
		]);
	//dd(Input::all());
		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator->errors());
		}
	
	//var_dump(Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'status' => '1']));
	
		if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'status' => '1'])) 
		{
			return redirect()->intended('/web88cms/dashboard');
		}
		else{
			//echo "sdsadasdasd"; exit;
			$validator->errors()->add('field', 'These credentials do not match our records.!');
			return redirect()->back()->withErrors($validator->errors());
		}
	}
}
