<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TokenController extends Controller {
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	function index()
	{		
		return view('admin.token-expired');
	}	
}
