<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Product;
use App\Http\Models\Front\Checkout;
use App\Http\Models\Front\Brands;
use App\Http\Models\Countries;
use App\Http\Models\ShippingMethod;

use Helper;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use View;

use Request;
use Response;
use Cookie;

class CartController extends Controller {
	private $data = array();
	private $ProductModel = null;
	private $CountriesModel = null;
	private $ShippingModel = null;

	public function __construct()
	{
		$this->ProductsModel = new Product();
		$this->BrandsModel = new Brands();
		$this->CountriesModel = new Countries();
		$this->ShippingModel = new ShippingMethod();
	}

	function index()
	{
		$cart = Session::get('cart');
		$cart_info = Helper::getCartInfo();
		$estimateShipping = Session::get('estimateShipping');
		$promocode = Session::get('promocode');

		if (Request::isMethod('post') && Input::get('quantity'))
		{
			$quantity = Input::get('quantity');

			foreach($quantity as $key => $value){
				if(isset($cart[$key])){
					if($value){
						$cart[$key]['quantity'] = $value;
					}
					else{
						unset($cart[$key]);
					}
				}
			}

			Session::put('cart', $cart);
			Session::put('success', 'Cart successfully updated.');

			return redirect('/cart');
		}

		$this->data['success'] = Session::get('success');
		Session::forget('success');

		$this->data['cartProducts'] = $this->ProductsModel->getCartProducts($cart, $promocode);
		//echo '<pre>';print_r($this->data['cartProducts']);exit;
		//Get Recent View Products
		$cookie = Cookie::get('recentViewProducts');
		$this->data['recentViewProducts'] = array();

		if($cookie){
			$explode = explode(',', $cookie);
			$this->data['recentViewProducts'] = $this->ProductsModel->getRecentViewProducts($explode);
		}
		//End

		$brands = $this->BrandsModel->getBrands();
		$this->data['brands'] = $brands;
		$this->data['brands_scroller'] = View::make('front.module.brands', $this->data);

		//Get Country
		$this->data['countries'] = $this->CountriesModel->getCountries();
		$this->data['states'] = array();

		if(isset($estimateShipping['country']))
		{
			$this->data['states'] = $this->CountriesModel->getStatesByCountry($estimateShipping['country']);
			if ($estimateShipping['country'] == $this->CountriesModel->getCountryIdByName('Malaysia')) {
				$this->data['states'] = $this->CountriesModel->getStatesByCountry();
			}
		}

		if (isset($estimateShipping['state']) && is_numeric($estimateShipping['state'])) {
			$this->data['shipping_options'] = $this->ShippingModel->getAvailableCsvShipping($cart_info['total_weight'], $estimateShipping['state']);
		}

		//Estimate Shipping
		$this->data['shipping_method_id'] = (isset($estimateShipping['shipping_method_id']) ? $estimateShipping['shipping_method_id'] : '0');
		$this->data['shipping_estimate_country'] = (isset($estimateShipping['country']) ? $estimateShipping['country'] : '');
		$this->data['shipping_estimate_state'] = (isset($estimateShipping['state']) ? $estimateShipping['state'] : '');
		$this->data['total_weight'] = $cart_info['total_weight'];

		$this->data['page_title'] = 'Cart';
		return view('front.cart.cart',$this->data);
	}

	function cartHtml(){
		return view('front.cart.cart_header',$this->data);
	}

	public function addToCart(){
		$cart = Session::get('cart');
		$isExist = false;

		$product_id = Input::get('product_id');
		$color_id = (Input::get('color_id')) ? Input::get('color_id') : '';
		$quantity = Input::get('quantity');
		$special_event_id = Input::get('special_event_id');

		if($cart){
			foreach($cart as $key => $value){
				if ((Input::has('pwp_product_id') && isset($value['pwp_product_id'])
					&& $value['pwp_product_id'] == Input::get('pwp_product_id'))
					|| (!Input::has('pwp_product_id') && $value['product_id'] == $product_id
						&& $value['color_id'] == $color_id )) {

					$cart[$key]['quantity'] += $quantity;
					$isExist = true;
					break;
				}
			}
		}

		if(!$isExist){
			$key = $product_id . '-'.$color_id . time();

			$cart[$key] = array(
				'key'				=> $key,
				'product_id'		=> $product_id,
				'quantity'			=> $quantity,
				'color_id'			=> $color_id,
				'special_event_id'	=> $special_event_id,
			);

			if (Input::has('pwp_product_id')) {
				$cart[$key]['pwp_product_id'] = Input::get('pwp_product_id');
				$cart[$key]['pwp_price'] = Input::get('pwp_price');
			}
		}

		Session::put('cart', $cart);

		$json['success'] = 'Item successfully added to cart.';
		return Response::json($json);
	}

	public function deleteToCart(){
		$cart = Session::get('cart');
		$cartKey = Input::get('cartKey');

		if(isset($cart[$cartKey])){
			unset($cart[$cartKey]);
		}
		Session::put('cart', $cart);

		$json['success'] = 'TRUE';
		return Response::json($json);
	}

	public function removeItem($cartKey){
		$cart = Session::get('cart');

		if(isset($cart[$cartKey])){
			unset($cart[$cartKey]);
		}

		Session::put('cart', $cart);
		Session::put('success', 'Item successfully removed to cart.');

		return redirect('/cart');
	}

	public function addAllToCart(){
		$cart = Session::get('cart');

		$cartData = Input::get('cart');

		if($cartData)
		{
			foreach($cartData as $row)
			{
				$isExist = false;

				$product_id = $row['product_id'];
				$color_id = ($row['color_id']) ? $row['color_id'] : '' ;
				$quantity = $row['quantity'];
				$special_event_id = (isset($row['special_event_id']) ? $row['special_event_id'] : '0');

				if($cart){
					foreach($cart as $key => $value){
						if($value['product_id'] == $product_id && $value['color_id'] == $color_id ){
							$cart[$key]['quantity'] += $quantity;
							$isExist = true;
							break;
						}
					}
				}

				if(!$isExist){
					$key = $product_id . '-'.$color_id . time();

					$cart[$key] = array(
						'key'				=> $key,
						'product_id'		=> $product_id,
						'quantity'			=> $quantity,
						'color_id'			=> $color_id,
						'special_event_id'	=> $special_event_id,
					);
				}
			}

		}

		Session::put('cart', $cart);

		$json['success'] = 'Item successfully added to cart.';
		return Response::json($json);
	}

	public function applyCouponCode(){
		$json = array();
		$cart = Session::get('cart');
		$promo_code = Input::get('promo_code');

		if($promo_code && $cart){
			$products = array();

			foreach($cart as $row){
				$products[] = $row['product_id'];
			}

			if($products){
				$CheckoutModel = new Checkout();
				$cartProducts = $this->ProductsModel->getCartProducts(Session::get('cart'));

				$promocode = $CheckoutModel->getPromoCodes($promo_code	);

				if(isset($promocode['warning'])){
					$json['warning'] = $promocode['warning'];
				}
				else{
					Session::put('promocode', $promocode);
					Session::put('success', 'Promo code added successfully.');
					$json['success'] = 'true';
				}
			}
		}
		else{
			$json['warning'] = 'Invalid promo code!';
		}

		return Response::json($json);
	}

	//Get Shipping Estimate
	public function applyEstimateShipping(){
		$validation['country'] = 'required';
		//$validation['state'] = 'required';
		$validation['shipping_method'] = 'required';

		$validator = Validator::make(Request::all(), $validation);

		if ($validator->fails()) {
			$json['error'] = $validator->errors()->all();
		}
		else
		{
			$data['country'] = Input::get('country');
			$data['state'] = Input::get('state');
			if (Input::get('shipping_method') == '0') {
				$data['shipping_method'] = 'Self Collection';
			} else {
				$ship = shippingMethod::getById(Input::get('shipping_method'));
				$data['shipping_method'] = $ship->title;
			}
			$data['shipping_method_id'] = Input::get('shipping_method');

			if (Session::has('estimateShipping')) {
				Session::forget('estimateShipping');
			}
			Session::put('estimateShipping', $data);
			Session::put('success', 'Estimate shipping applied successfully.');

			$json['success'] = 'TRUE';
		}

		return Response::json($json);
	}
}
