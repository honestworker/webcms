<?php 
namespace App\Http\Controllers\Front;
use App\Http\Models\Front\Banners;
use App\Http\Controllers\Controller;
use App\Http\Models\Front\Categories;
use App\Http\Models\Front\Brands;
use App\Http\Models\Front\Product;
use App\Http\Models\Front\Newsletter;
use View;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;

class HomeController extends Controller {
	private $data = array();
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		/*FOR DEBUG, PLEASE DON'T REMOVE THEESE LINES*/
		// $this->time = 0;
		// $this->queries = 0;
		// \DB::listen(function($sql, $bindings, $time)
		// {
		// 	$this->queries++;
		// 	$this->time+=$time;
		//     file_put_contents('php://stdout', "time:\t{$this->time} milliseconds\n-------------{$this->queries}----------------\n\n\n");
		// });
		$this->CategoriesModel = new Categories();
		$this->BrandsModel = new Brands();
		$this->BannersModel = new Banners(); 
		$this->ProductModel = new Product();
		$this->NewsletterModel = new Newsletter();
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

		//Load module
		$shopCategories = $this->CategoriesModel->getAll();
		$this->data['categories'] = $shopCategories;
		
		
		$brands = $this->BrandsModel->getAllBrands();
		$this->data['brands'] = $brands;
		
		
		// get brands with most products listed
		$this->data['topSellingBrands'] = $this->BrandsModel->getAllTopSellingBrands();
		
		$latest_arrivals = $this->CategoriesModel->getcategory_home_list_enabletab();
		$this->data['latest_arrivals'] = $latest_arrivals;
		
		$homeCategoryWithoutTab = $this->CategoriesModel->getcategory_home_list_disabletab();
		$this->data['homeCategoryWithoutTab'] = $homeCategoryWithoutTab;
		
		
		$banner4 = $this->BannersModel->getLatestPromoLeftBanner();
		$this->data['bannerslatestpromo'] = $banner4;
		
		$banner5 = $this->BannersModel->getMidlleBottomBanner();
		$this->data['bannersbottom'] = $banner5;
		
		
		$banner1 = $this->BannersModel->getLeftBanner();
		$this->data['bannersleft'] = $banner1;
		
		$banner2 = $this->BannersModel->getMiddleTopBanner(); 
		$this->data['bannerslmiddletop'] = $banner2;
		
		$banner3 = $this->BannersModel->getTopBanner();
		$this->data['banners'] = $banner3;
		
		//New Arrivals & Bestsellers
		$this->data['newArrivals'] = $this->ProductModel->getNewArrivals(16);
		$this->data['bestsellers'] = $this->ProductModel->getBestsellers(16);
		return view('front.home.home', $this->data);
	}
	
	public function search_result()
	{
		//echo "sxcdsadcascas";
		return view('front.home.search_result');
	}
	
	public function searchdata()
	{
		/*echo "<pre>";
		print_r($_POST);*/
		$post=$_POST;
		if(isset($post['searchbox'])&& ($post['searchbox']!=''))
		{
			
			$data['keyword'] = $post['searchbox'];
			
			$data['searchdata'] =DB::select("SELECT * FROM products WHERE product_name='".$post['searchbox']."'"); 
		}
		return view('front.home.search_result', $data);
		
	}
	
	
	/**
	 * Add Subscriber
	 */
	function addSubscriber()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
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

}
