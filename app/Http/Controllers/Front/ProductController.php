<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use View;

use App\Http\Models\Front\Product;
use App\Http\Models\Front\Brands;

use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Redirect;

//use App\Http\Requests\Request;
use Request;
use Response;
use Cookie;
use DB;

use Helper;
use App\Http\Models\ShippingMethod;
use App\Http\Models\PwpProduct;

class ProductController extends Controller {
	private $data = array();
	private $ShippingModel;

	public function __construct()
	{
		$this->ProductModel = new Product();
		$this->BrandsModel = new Brands();
		$this->ShippingModel = new ShippingMethod();
	}

	function index($product_id = 0)
	{
		//Session::forget('cart');; print_r(Session::get('cart'));
		$product_id = (int)$product_id;
		if(!$product_id){
			$this->data['page_title'] = 'Product not found';
			return view('front.products.product-404',$this->data);
		}
		else{
			//Cookies Start
			$cookie = Cookie::get('recentViewProducts');
			$recentViewProducts = array();

			if($cookie){
				$recentViewProducts = explode(',', $cookie);
			}

			if(in_array($product_id, $recentViewProducts)){
				$key = (int)array_search($product_id, $recentViewProducts);
				unset($recentViewProducts[$key]);
			}

			array_unshift($recentViewProducts, $product_id);
			$newCookie = implode(',', $recentViewProducts);
			Cookie::queue(Cookie::forever('recentViewProducts', $newCookie));
			//exit;

			//Cookies End

			$productInfo = $this->ProductModel->getProduct($product_id);
			//echo '<pre>';print_r($productInfo);exit;
			if($productInfo){

				$this->data['breadcrumb'] = array();
				$categories = Input::get('category');

				if($categories && is_array($categories)){
					foreach($categories as $category_id){
						$category = $this->ProductModel->getBreadcrumbCategory($category_id);
						if($category){
							$this->data['breadcrumb'][] = $category;
						}
					}
				}
				if(empty($this->data['breadcrumb'])){
					$getcatdata=DB::select("SELECT * FROM product_to_category WHERE product_id=".$product_id);
					$cat = $getcatdata[0]->category_id;

					$this->parentCat($cat);

					ksort($this->data['breadcrumb']);
				}

				$this->data['page_title'] = $productInfo->product_name;
				$this->data['productInfo'] = $productInfo;
				$this->data['productImages'] = $this->ProductModel->getProductImages($productInfo->id);
				$this->data['productColors'] = $this->ProductModel->getProductColors($productInfo->id);
				$this->data['relatedBrandProducts'] = $this->ProductModel->getRelatedProducts($productInfo->id, $productInfo->brand_id);
				$this->data['relatedDiffBrandProducts'] = $this->ProductModel->getRelatedProducts($productInfo->id, $productInfo->brand_id, false);

				$brands = $this->BrandsModel->getBrands();
				$this->data['brands'] = $brands;
				$this->data['brands_scroller'] = View::make('front.module.brands', $this->data);

				//Get shipping options
				$destination = Helper::getDestinationInfo();
				if ($destination) {
					$product_weight = (float) $productInfo->weight;
					$this->data['ship_options'] = $this->ShippingModel->getAvailableCsvShipping($product_weight, $destination['state']);
				}

				//Get pwp products
				$this->data['pwp_products'] = PwpProduct::getByProductId($product_id);

				return view('front.products.product-detail',$this->data);
			}
			else{
				$brands = $this->BrandsModel->getBrands();
				$this->data['brands'] = $brands;
				$this->data['brands_scroller'] = View::make('front.module.brands', $this->data);

				$this->data['page_title'] = 'Product not found';
				return view('front.products.product-404',$this->data);
			}
		}
	}

	function parentCat($cat){
		//echo $cat;
		$getparentcatdata=DB::select("SELECT id,parent_id FROM categories WHERE id=".$cat);

		//dd($getparentcatdata);
		if(sizeof($getparentcatdata) > 0)
		{
			$category = $this->ProductModel->getBreadcrumbCategory($getparentcatdata[0]->id);
			if($category){
				$this->data['breadcrumb'][$cat] = $category;
			}

			if($getparentcatdata[0]->parent_id!=0){
				$this->parentCat($getparentcatdata[0]->parent_id);
			}
		}
	}











	public function notifyMe(){
		$json = array();

		$validation['name'] = 'required';
		$validation['email'] = 'required|email';

		$validator = Validator::make(Request::all(), $validation);

		if ($validator->fails()) {
			$json['error'] = $validator->errors()->all();
		}
		else
		{
			$product_id = Input::get('product_id');
			$name = Input::get('name');
			$email = Input::get('email');

			$this->ProductModel->addNotifyMe($product_id, $name, $email);
			$json['success'] = 'You will be informed when product will be available.';
		}

		return Response::json($json);
	}
}
