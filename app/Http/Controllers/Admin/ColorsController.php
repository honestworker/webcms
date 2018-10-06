<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Color;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;

class ColorsController extends Controller {
	private $data = array();
	private $ColorModel = null;
	
	
	
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->ColorModel = new Color();
		
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}
	
	function listColors(){
				
		$this->data['colors'] = $this->ColorModel->getColors();
		
		// response variable is set when item is deleted
		$this->data['success'] = Session::get('response');
		Session::forget('response');
		
		// get last updated
		$this->data['last_modified'] = DB::table('colors')->orderBy('last_modified','desc')->pluck('last_modified');
		
		// set page title
		$this->data['page_title'] = 'List Colors';
		
		return view('admin.colors.colors_list', $this->data);
	}
	
	function addColor()
	{
		if(Request::isMethod('post'))
		{					
			$messages = ['hex_code.required' => 'The color code field is required.'];						
			$validator = Validator::make(	Request::all(),[
												'title' => 'required',
												'hex_code' => 'required',
											],
											$messages										
										); 			        
	
		  if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				//echo json_encode($json);
				return Redirect::back()->withErrors($validator);
				//exit;
			}
			else
			{
				$this->ColorModel->addColor(Request::input());
				
				//Session::put('response', 'Color added successfully.');
				$this->data['success'] = 'Color added successfully.';
				
				//redirect('web88cms');
				Redirect::back()->with('data', $this->data);
				
			}			
		}	
		
		// get last updated
		$this->data['last_modified'] = DB::table('colors')->orderBy('last_modified','desc')->pluck('last_modified');
		
		// set page title
		$this->data['page_title'] = 'Add Color';
		
		return view('admin.colors.add_color',$this->data);	
	}
	
	function updateColor($color_id)
	{
		if(Request::isMethod('post'))
		{
			
			$messages = ['hex_code.required' => 'The color code field is required.'];						
			$validator = Validator::make(	Request::all(),[
												'title' => 'required',
												'hex_code' => 'required',
											],
											$messages										
										); 			        
	
		  if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				//echo json_encode($json);
				return Redirect::back()->withErrors($validator);
				//exit;
			}
			else
			{
				$this->ColorModel->updateColor(Request::input(),$color_id);
				
				$this->data['success'] = 'Color updated successfully.';
				
				Redirect::back()->with('data', $this->data);
				
			}
		}
		
		// get last updated
		$this->data['last_modified'] = DB::table('colors')->orderBy('last_modified','desc')->pluck('last_modified');
		
		$this->data['colorDetails'] = $this->ColorModel->getDetails($color_id);
		
		// set page title
		$this->data['page_title'] = 'Edit Color';
		
		return view('admin.colors.edit_color',$this->data);
		
	}
	
	function deleteColors()
	{
		$brands = $this->ColorModel->deleteColors($_POST['item_id']);
		Session::put('response', 'Item(s) deleted successfully.');
	}
	
	/*function listCategories()
	{
		//$categories = DB::table('categories')->get();
		$category = new Category();
		echo '<pre>';// print_r($category->getCategories());
		print_r($category->getCategoriesTree());
			exit;
	}*/
	
	/*function getUserDetails($id)
	{
		$user = new User();
		$data['userDetails'] = $user->getUser($id);
		return view('admin.profile', $data);
	}
	
	function getAlbums()
	{
		$user = new User();
		$data['albums'] = $user->getAlbums();
		return view('admin.albums', $data);
	}
	
	public function checkSession()
	{
		Session::put('session_key', 'sad adl lasdla');
		echo Session::get('session_key');
		exit;
		//return view('admin.dashboard');
	}*/

}
