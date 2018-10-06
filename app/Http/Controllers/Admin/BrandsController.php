<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Brand;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
//use App\Http\Requests\Request;
use Request;

class BrandsController extends Controller {
	private $data = array();
	private $BrandModel = null;
	
	
	
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
		$this->BrandModel = new Brand();
		
		// custom validtion rules
		Validator::extend('dimension_max', function($attribute, $value, $parameters)
		{
			if(function_exists('getimagesize'))
			{
				//$file = Input::file($attribute);
				$file = $_FILES[$attribute];
				//print_r($parameters); exit;
				$image_info = getimagesize($file['tmp_name']);
				$image_width = $image_info[0];
				$image_height = $image_info[1];
				if( (isset($parameters[0]) && $parameters[0] != 0) && $image_width <= $parameters[0]) return true;
				if( (isset($parameters[1]) && $parameters[1] != 0) && $image_height <= $parameters[1] ) return true;
				return false;
			}
		},'Invalid image dimensions.');
			
		Validator::extend('dimension_exact', function($attribute, $value, $parameters)
		{
			if(function_exists('getimagesize'))
			{
				//$file = Input::file($attribute);
				$file = $_FILES[$attribute];
				//print_r($parameters); exit;
				$image_info = getimagesize($file['tmp_name']);
				$image_width = $image_info[0];
				$image_height = $image_info[1];
				if( (isset($parameters[0]) && $parameters[0] != 0) && $image_width == $parameters[0]) return true;
				if( (isset($parameters[1]) && $parameters[1] != 0) && $image_height == $parameters[1] ) return true;
				return false;
			}
		},'Invalid image dimensions.');
		
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}
	
	function listBrands(){
		//$brandModel = new Brand();
		$brands = $this->BrandModel->getBrands();
		//$categoriesHtml = $CategoryModel->createTreeHtml($categories);
		
		$this->data['brands'] = $brands;
		
		$this->data['success'] = Session::get('response');
		Session::forget('response');
		
		// get last updated
		$this->data['last_modified'] = DB::table('brands')->orderBy('last_modified','desc')->pluck('last_modified');

		// set page title
		$this->data['page_title'] = 'List Brands';
		
		return view('admin.brands.brands_list', $this->data);
	}
	
	function addBrand()
	{
		if(Request::isMethod('post'))
		{			
			$messages = [
					//'required' => 'The :attribute field is required.',
					'max' => 'Max file size should be less than 1MB.',
				];
										
			$validator = Validator::make(	Request::all(),[
												'title' => 'required',
												'brandImage' => 'required|image|mimes:png|max:1000|dimension_exact:160,60'
											],
											$messages
										); 			        
	
		  if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;				
				
			}
			else
			{
				$imageName = null;
				if(isset($_FILES['brandImage']['name']) && $_FILES['brandImage']['name']!='')
				{
					
					$imageName = time().'_'.$_FILES['brandImage']['name'];
					Request::file('brandImage')->move(
						base_path() . '/public/admin/brands/', $imageName
					);
				}
				
				$this->BrandModel->addBrand(Request::input(),$imageName);
				
				Session::put('response', 'Brand added successfully.');
				
				echo json_encode(array('success' => 'success'));
			}			
		}		
	}
	
	function updateBrand()
	{
		if(Request::isMethod('post'))
		{
			
			$messages = [
					//'required' => 'The :attribute field is required.',
					'max' => 'Max file size should be less than 1MB.',
				];
			$validation_rules = array();
			if(isset($_FILES['brandImage']['name']) && $_FILES['brandImage']['name']!='')
			{
				
				$validation_rules = array('brandImage' => 'required|image|mimes:png|max:1000|dimension_exact:160,60');
			}
			
			$validation_title = array('title' => 'required');
			
			$validation_rules = array_merge($validation_rules,$validation_title);
			
			//print_r($validation_rules); exit;
			//echo json_encode(array('error' => $validation_rules)); exit;
			
			$validator = Validator::make(	Request::all(),
												//'title' => 'required'
												$validation_rules
											,
											$messages
										); 
			/*$validator = Validator::make(	Request::all(),[
												//'title' => 'required'
												$validation_rules
											],
											$messages
										); */               
	
		  if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
				//return Redirect::back()->withErrors($validator);
				//echo Redirect::back()->withErrors($validator); exit;
				
			}
			else
			{
				$imageName = null;
				if(isset($_FILES['brandImage']['name']) && $_FILES['brandImage']['name']!='')
				{
					
					$imageName = time().'_'.$_FILES['brandImage']['name'];
					Request::file('brandImage')->move(
						base_path() . '/public/admin/brands/', $imageName
					);
				}
				
				$this->BrandModel->updateBrand(Request::input(),$imageName);
				echo json_encode(array('success' => 'success'));
			}
			
			//echo json_encode(array('error' => $_POST));
			//exit;	
			
						
			
		}
		
	}
	
	function deleteBrands()
	{
		$brands = $this->BrandModel->deleteBrands($_POST['item_id']);
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
