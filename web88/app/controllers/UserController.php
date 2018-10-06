<?php

class UserController extends BaseController {

	public function login()
	{
		if( Request::isMethod('post') ){
		
		$data = Input::all();

		$rules = [
			'email' => 'required|email|min:3',
			'password' => 'required|min:3'
		];

		$val = Validator::make($data, $rules);
		if ($val->fails())
		{
			return View::make('login.index')->with(['error' => ['validate' => false]]);
		}
		
		
		$user = User::login($data);
		
		if (!$user){
			
			return View::make('login.index')->with(['error' => ['login' => false]]);
		}
	
		return Redirect::to('login');
		}else{
			return View::make('login.index');
		}
	}

}
