<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Filter;
use App\Http\Models\Admin\Category;
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

class FiltersController extends Controller {
	private $data = array();
	private $BrandModel = null;
	private $CategoryModel = null;
	
	
	
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
		$this->FilterModel = new Filter();	
		$this->CategoryModel = new Category();	
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}
	
	function listFilters(){
				
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(	Request::all(),[
												'title' => 'required',												
											]
										); 			        
	
		  if ($validator->fails()) {  
				$validator->errors()->all(); 
				return Redirect::back()->withErrors($validator);
				exit;				
				
			}
			else
			{
				$form_data = Request::input();							
				
				$formData['status'] = (isset($form_data['status'])) ? '1' : '0';
				$formData['title'] = $form_data['title'];
				$formData['applied_to_categories'] = implode(',',$form_data['category_id']);				
				
				$this->FilterModel->updateFilter($formData,$form_data['id']);
				
				$this->data['success'] = 'Changes saved successfully.';
				return Redirect::back()->with('data', $this->data);
			}
		}
				
		$filters = $this->FilterModel->getFilters();
		
		$this->data['filters'] = $filters;	
	
		$this->data['filter_categories'][0] = $this->CategoryModel->getSelectedCategoriesTree(explode(',',$filters[0]->applied_to_categories));
		$this->data['filter_categories'][1] = $this->CategoryModel->getSelectedCategoriesTree(explode(',',$filters[1]->applied_to_categories));
		$this->data['filter_categories'][2] = $this->CategoryModel->getSelectedCategoriesTree(explode(',',$filters[2]->applied_to_categories));	
				
		// get last updated
		$this->data['last_modified'] = DB::table('filters')->orderBy('last_modified','desc')->pluck('last_modified');
		
		// set page title
		$this->data['page_title'] = 'List Filters';
		
		return view('admin.filters.filters_list', $this->data);
	}	
	

}
