<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Product;
//use App\Http\Models\Admin\Category;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
//use App\Http\Requests\Request;
use Request;

class ProductsController extends Controller {
	private $data = array();
	//private $BrandModel = null;
	//private $CategoryModel = null;
	
	
	
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
		//$this->middleware('auth');
		$this->ProductModel = new Product();	
		//$this->CategoryModel = new Category();	
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}
	
	function listSubcategories(){
				
		//$this->ProductModel->getProductsByCategory($category_id);
		$category_id = array(10,4);
		$subCategories = $this->ProductModel->getSubCategories($category_id);
		
		echo '<pre>'; print_r($subCategories); exit;
	}	
	
	/*function listProducts($category_id, $sort = 'new'){
		
		$this->data['id'] = $category_id;
		$this->data['sort'] = $sort;
		$this->data['item'] = 20;
		$this->data['page'] = 30;
		
		// filters
		$filters = Input::get();
		
		$this->data['category'] = DB::table('categories')->where('id',$category_id)->first();
		
		$this->data['products'] = $this->ProductModel->getProductsByCategory($category_id,$sort,$filters);
		
		//Get product banner of current category
		$this->data['productBanners'] = $this->ProductModel->getProductBanners($category_id);
		
		//Brands in footer		
		$this->data['brands_scroller'] = View::make('front.module.brands');
		
		//Most Buy in left
		$this->data['most_buy'] = View::make('front.module.most_buy');
		
		//Promo banners in left
		$this->data['latest_promo'] = View::make('front.module.latest_promo');
		
		//Banners in left		
		$this->data['banner_left_slider'] = View::make('front.module.banner_left_slider');
		
		// set page title
		$this->data['page_title'] = $this->data['category']->title;
		
		return view('front.products.products_list',$this->data);
	}*/
	
	function listProducts($category_id, $sort = 'new'){
		
		$this->data['id'] = $category_id;
		$this->data['sort'] = $sort;
		$this->data['item'] = 20;
		$this->data['page'] = 30;
		
		// filters
		$filters = Input::get();
		
		if($category_id)
			$this->data['category'] = DB::table('categories')->where('id',$category_id)->first();
		else
			$this->data['category'] = '';
		
		$this->data['products'] = $this->ProductModel->getProductsByCategory($category_id,$sort,$filters);
		
		$this->data['total_records'] = $this->ProductModel->getTotalProductsByCategory($category_id,$sort,$filters);
		
		//Get product banner of current category
		$this->data['productBanners'] = $this->ProductModel->getProductBanners($category_id);
		
		//Brands in footer		
		$this->data['brands_scroller'] = View::make('front.module.brands');
		
		//Most Buy in left
		$this->data['most_buy'] = View::make('front.module.most_buy');
		
		//Promo banners in left
		$this->data['latest_promo'] = View::make('front.module.latest_promo');
		
		//Banners in left		
		$this->data['banner_left_slider'] = View::make('front.module.banner_left_slider');
		
		// set page title
		if($category_id)
			$this->data['page_title'] = $this->data['category']->title;
		else
			$this->data['page_title'] = 'TBM';
		
		return view('front.products.products_list',$this->data);
	}
	
	// switch view type
	function viewType($view_type)
	{
		if($view_type == 'list')
		{
			Session::put('view_type','list_view');
		}
		else
		{
			Session::put('view_type','image_view');
		}
		
		return Redirect::back();
	}
	
	function setPerPage($per_page,$session_key,$redirect_to,$query_string=null)
	{
		Session::put($session_key.'.per_page',$per_page);
		if($query_string && $query_string !='no_qs')
		{
			$redirect_to .= '?'.$query_string;
		}
		//echo str_replace('~','/',$redirect_to); exit;
		return redirect(str_replace('~','/',$redirect_to));
	}
	
	function saveSearchTerm()
	{
		$total_records = $this->ProductModel->getTotalSearchResults('new',Input::get());
		$keyword = Input::get('keyword');
		
		$this->ProductModel->saveSearchTerm($keyword,$total_records);
				
		return Redirect::to('/search/new?keyword='.Input::get('keyword'));	
	}
	
	function search($sort = 'new'){
				
		$this->data['sort'] = $sort;		
		
		// filters
		$filters = Input::get();
				
		$this->data['products'] = $this->ProductModel->searchProducts($sort,$filters);
		
		$this->data['total_records'] = $this->ProductModel->getTotalSearchResults($sort,$filters);
				
		//Brands in footer		
		$this->data['brands_scroller'] = View::make('front.module.brands');
		
		//Most Buy in left
		$this->data['most_buy'] = View::make('front.module.most_buy');
		
		//Promo banners in left
		$this->data['latest_promo'] = View::make('front.module.latest_promo');
		
		//Banners in left		
		$this->data['banner_left_slider'] = View::make('front.module.banner_left_slider');
		
		// set page title
		$this->data['page_title'] = 'Search Result';
		
		return view('front.products.search_results',$this->data);
	}
	
	function categoryProducts()
	{
		$category_id = Request::Input('category_id');
		
		$result = DB::table('products as p')->select('p.*','c.display_order')->leftJoin('product_to_category as c','p.id','=','c.product_id')->where('p.status','1')->where('c.category_id',$category_id)->groupBY('p.id')->get();
		
		if(count($result) > 0)
			echo json_encode(array('products' => $result));
	}
	
	function productColors()
	{
		$product_id = Request::Input('product_id');
		
		$result = DB::table('product_to_color as p')->select('p.*','c.title','c.hex_code')->leftJoin('colors as c','c.id','=','p.color_id')->where('c.status','1')->where('p.product_id',$product_id)->get();
		
		if(count($result) > 0)
			echo json_encode(array('product_colors' => $result));
		else
			echo json_encode(array('product_colors' => 'no_color'));
	}

}
