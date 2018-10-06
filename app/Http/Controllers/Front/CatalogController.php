<?php 
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Models\Front\CategoryPage;
use App\Http\Models\Front\Banners;
//use App\Http\Models\Front\Brands;
use View;
use Input;

class CatalogController extends Controller {
	private $data = array();
	
	/**
	 * Create a category controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->CategoryPageModel = new CategoryPage();
		//$this->BrandsModel = new Brands();
		$this->BannersModel = new Banners(); 
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index($id, $sort, $item, $page)
	{
		$this->data['id'] = $id;
		$this->data['sort'] = $sort;
		$this->data['item'] = $item;
		$this->data['page'] = $page;
		
		
		//Get current category detail
		$category = $this->CategoryPageModel->getCategory($id);
		$this->data['category'] = $category;
		
		//Sub Categories of Current Category
		$subCategories = $this->CategoryPageModel->getSubCategories($id);
		$this->data['subCategories'] = $subCategories;
		$this->data['sub_categories'] = View::make('front.catalog.module.sub_categories', $this->data);
		
		
		//Get product of current category
		$products = $this->CategoryPageModel->getProducts($id, $sort, $item, $page);
		$this->data['products'] = $products;
		
		//Get product banner of current category
		$productBanners = $this->CategoryPageModel->getProductBanners($id);
		$this->data['productBanners'] = $productBanners;
		
		
		//Brands in footer
		//$brands = $this->BrandsModel->getBrands();
		//$this->data['brands'] = $brands;
		$this->data['brands_scroller'] = View::make('front.module.brands');
		
		//Most Buy in left
		$this->data['most_buy'] = View::make('front.module.most_buy');
		
		
		//Promo banners in left
		$banner4 = $this->BannersModel->getLatestPromoLeftBanner();
		$this->data['bannerslatestpromo'] = $banner4;
		$this->data['latest_promo'] = View::make('front.module.latest_promo', $this->data);
		
		//Banners in left
		$banner1 = $this->BannersModel->getLeftBanner();
		$this->data['bannersleft'] = $banner1;
		$this->data['banner_left_slider'] = View::make('front.module.banner_left_slider', $this->data);
		
		
		return view('front.catalog.home', $this->data);
	}

}
