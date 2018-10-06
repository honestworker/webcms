<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
use Session;
use App\Http\Library\Image_lib;
use Helper;

use App\Models\Order;
use App\Http\Models\Admin\Promocodes;
use Carbon\Carbon;

class Product extends Model{

	protected $table = 'products';

	public $timestamps = false;

	/**
	 * get all active sub category childs by category id
	*/
	function getSubCategories($category_id = array(),$arr_categories = array())
	{
		$results = DB::table('categories')->where('status','1')->whereIN('parent_id', $category_id)->lists('id');

		if(sizeof($results) > 0)
		{
			array_push($arr_categories,$results);

			return $this->getSubCategories($results,$arr_categories);
		}

		$subCategories = array();
		foreach($arr_categories as $resultSet)
		{
			foreach($resultSet as $item)
			{
				array_push($subCategories,$item);
			}
		}
		return $subCategories;
	}


	/* get products by category id*/
	/*function getProductsByCategory($category_id)
	{
		//SELECT p.id,p.product_name FROM products p left join `product_to_category` c ON p.id=c.product_id where c.category_id IN (10,11,13,14,15) group by p.id
		$categoryList = $this->getSubCategories(array($category_id));

		array_push($categoryList,(int)$category_id);

		$results = DB::table('products as p')->select('p.*','c.display_order')->leftJoin('product_to_category as c','p.id','=','c.product_id')->where('p.status','1')->whereIN('c.category_id',$categoryList)->orderBy('c.display_order','asc')->groupBY('p.id')->get();

		return $results;
	}*/

	function getProductsByCategory($category_id, $sort = 'new', $filters = [],$get_total_records = null)
	{
		if($category_id)
		{
			//SELECT p.id,p.product_name FROM products p left join `product_to_category` c ON p.id=c.product_id where c.category_id IN (10,11,13,14,15) group by p.id
			$categoryList = $this->getSubCategories(array($category_id));

			array_push($categoryList,(int)$category_id);

			$query = DB::table('products as p')
				->leftJoin('product_to_category as c','p.id','=','c.product_id')
				->leftJoin('product_to_color as clr','p.id','=','clr.product_id')
				->leftJoin('global_discounts_to_products as gdp','p.id','=','gdp.product_id')
				->leftJoin('global_discounts as gd','gd.id','=','gdp.global_discount_id')
				->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
					$join->on('p.id', '=', 'prp.product_id')
						->where('prp.status', '=', '1')
						->where('prp.date', '=', date('Y-m-d'));
				})
				->select(
					'p.*','gd.discount', 'c.display_order',
					DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
					DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
					'prp.date as date'
				)
				->where('p.status','1')
				->whereIN('c.category_id',$categoryList);
		}
		else
		{
			$query = DB::table('products as p')
				->leftJoin('product_to_color as clr','p.id','=','clr.product_id')
                ->leftJoin('global_discounts_to_products as gdp','p.id','=','gdp.product_id')
                ->leftJoin('global_discounts as gd','gd.id','=','gdp.global_discount_id')
				->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
					$join->on('p.id', '=', 'prp.product_id')
						->where('prp.status', '=', '1')
						->where('prp.date', '=', date('Y-m-d'));
				})
				->select(
					'p.*','gd.discount',
					DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
					DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
					'prp.date as date'
				)->where('p.status','1');
		}

		if(sizeof($filters) > 0)
		{
			if(isset($filters['brand']))
				$query = $query->where('p.brand_id',$filters['brand']);

			if(isset($filters['price_from']))
				$query = $query->where('prp.sale_price','>=',$filters['price_from']);

			if(isset($filters['price_to']))
				$query = $query->where('prp.sale_price','<=',$filters['price_to']);

			if(isset($filters['color']))
				$query = $query->where('clr.color_id','=',$filters['color']);
		}

		if($sort == 'priceAsc'){
			$query = $query->orderBy('prp.sale_price', 'ASC');
		}else if($sort == 'priceDesc'){
			$query = $query->orderBy('prp.sale_price', 'DESC');
		}else if($sort == 'a-z'){
			$query = $query->orderBy('p.product_name', 'ASC');
		}else if($sort == 'z-a'){
			$query = $query->orderBy('p.product_name', 'DESC');
		}else if($sort == 'date'){
			$query = $query->orderBy('p.last_modified', 'DESC');
		}else if($sort == 'brand'){
			$query = $query->orderBy('p.brand_id', 'ASC');
		}else{
			$query = $query->orderBy('p.id', 'DESC');
		}

		if(sizeof($filters) > 0 && isset($filters['page']))
			$current_page = $filters['page'];
		else
			$current_page = 1;

		$per_page = (Session::has('product.per_page')) ? Session::get('product.per_page') : 20;

		// return total records
		if($get_total_records)
		{
			$results = $query->groupBY('p.id')->get();

			return count($results);
		}
		else
		{
			// return products list

			if($category_id)
			{
				//$results = $query->orderBy('c.display_order','asc')->groupBY('p.id')->get();
				//$results = $query->orderBy('c.display_order','asc')->groupBY('p.id')->paginate($per_page);
				$results = $query->orderBy('c.display_order','asc')->groupBY('p.id')->skip($per_page * ($current_page-1))->take($per_page)->get();
			}
			else
			{
				$results = $query->groupBY('p.id')->paginate($per_page);
			}

			$new_res = [];
			foreach($results as $item) {
				$d = [
					'rooms' => DB::table('product_room_prices')->where('product_id', $item->id)->get(),
					'qty_stock' => 0,
					'low_level' => 0,
				];

				foreach ($d['rooms'] as $key => $value) {
					try {
						$dt = Carbon::createFromFormat('Y-m-d', $value->date);
						$dt_now = Carbon::now();
						if($dt_now->format('d-m-Y') == $dt->format('d-m-Y'))
						{
							$d['all_day'][] = $dt->format('d-m-Y');
							$d['qty_stock'] += $value->qty_stock;
							$d['low_level'] += $value->low_level;
							//dd($value->date);
						}
					}catch(\InvalidArgumentException $x) {
						//echo $x->getMessage();
					}
				}

				$item->quantity_in_stock = $d['qty_stock'];
				$item->low_level_in_stock = $d['low_level'];
				$new_res[] = $item;
			}

			//dd($new_res);
			return $new_res;
		}
	}

	function getTotalProductsByCategory($category_id, $sort = 'new', $filters)
	{
		return $this->getProductsByCategory($category_id, $sort = 'new', $filters,'get_total_records');
	}

	// get parent categories tree
	/*function getParentCategories($category_id = array(),$arr_categories = array())
	{
		$results = DB::table('categories')->where('status','1')->whereIN('id', $category_id)->lists('parent_id');

		if(sizeof($results) > 0)
		{
			array_push($arr_categories,$results);

			return $this->getParentCategories($results,$arr_categories);
		}

		$subCategories = array();
		foreach($arr_categories as $resultSet)
		{
			foreach($resultSet as $item)
			{
				array_push($subCategories,$item);
			}
		}
		return $subCategories;
	}*/

	/**
	 * get parent categories tree
	 * return category id and title
	*/

	function getParentCategoriesDetails($category_id = array(),$arr_categories = array())
	{
		$results = DB::table('categories')->select('title','parent_id')->where('status','1')->whereIN('id', $category_id)->get();


		if(sizeof($results) > 0)
		{
			$result_arr['title'] = $results[0]->title;
			$result_arr['parent_id'] = $results[0]->parent_id;

			array_push($arr_categories,$result_arr);

			return $this->getParentCategoriesDetails(array($result_arr['parent_id']),$arr_categories);
		}

		return $arr_categories;
	}

	/**
	 * get parent categories tree
	 * return only category id
	*/
	function getParentCategories($category_id = array(),$arr_categories = array())
	{
		$results = DB::table('categories')->where('status','1')->whereIN('id', $category_id)->pluck('parent_id');

		if(sizeof($results) > 0)
		{
			array_push($arr_categories,$results);

			return $this->getParentCategories(array($results),$arr_categories);
		}

		return $arr_categories;
	}


	/* get product banners */
	function getProductBanners($category_id = 0)
	{
		$categoryList = $this->getParentCategories(array($category_id));

		//array_push($categoryList,(int)$category_id);

		$banners = array();

		// get banner for category from its parent categories
		$results = DB::table('product_banner_list')->where('tick','1')->whereIN('category', $categoryList)->get();

		foreach($results as $result){
				$banners[] = array(
					'title'			=> $result->title,
					'banner'		=> $result->banner,
				);
		}

		// get banner for category
		//$results = DB::table('product_banner_list')->where('category', $category_id)->get();
		$results = DB::select('SELECT * FROM product_banner_list WHERE( (DATE(DATE_ADD(NOW(), INTERVAL 0 HOUR)) between start_date and end_date)and(category='.$category_id.') and(status=1)) ORDER BY RAND()');


		foreach($results as $result){
				$banners[] = array(
					'title'			=> $result->title,
					'banner'		=> $result->banner,
				);
		}

		return $banners;
	}

	// get active filters
	function getFilters()
	{
		return DB::table('filters')->where('status','1')->get();
	}


	/**
	 * get brands list with total products in specific category
	 * also count product for sub categories
	 */
	function getBrandFilter($category_id)
	{
		//SELECT b.title as brand_name,count(p.id) as total_products FROM products p left join brands b ON b.id=p.brand_id where p.id IN (select product_id from product_to_category c where c.category_id IN (10,11,13,14,15) group by product_id) AND brand_id <>0 group by b.id
		$categoryList = $this->getSubCategories(array($category_id));

		array_push($categoryList,(int)$category_id);

		$results = DB::table('products as p')
			->select(
				'p.brand_id','b.title as brand_name', DB::raw('count(p.id) as total_products'),
				DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
				DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
				'prp.date as date'
			)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
            	$join->on('p.id', '=', 'prp.product_id')
					->where('prp.status', '=', '1')
					->where('prp.date', '=', date('Y-m-d'));
        	})
			->leftJoin('brands as b','p.brand_id','=','b.id')
			->where('p.status','1')
			->where('p.brand_id','<>',0)
			->whereIN('p.id', function($query) use ($categoryList) {
				$query->select('c.product_id')
					->from('product_to_category as c')
					->whereIN('c.category_id', $categoryList);
				})->groupBY('b.id')->get();
		//echo '<pre>'; print_r($results); echo '</pre>'; exit;
		return $results;
	}

	/**
	 * get color list in specific category
	 * also get colors for products listed in sub categories
	 */
	function getColorFilter($category_id)
	{
		//SELECT c.id as color_id,c.hex_code FROM `colors` c left join product_to_color pc ON pc.color_id=c.id where c.status='1' AND pc.product_id IN (select product_id from product_to_category c where c.category_id IN (10,11,13,14,15) group by product_id)
		$categoryList = $this->getSubCategories(array($category_id));

		array_push($categoryList,(int)$category_id);

		$results = DB::table('colors as c')->select('c.id as color_id','c.hex_code')->leftJoin('product_to_color as pc','pc.color_id','=','c.id')->where('c.status','1')->whereIN('pc.product_id',function($query) use ($categoryList){
										$query->select('c.product_id')
										->from('product_to_category as c')
										->whereIN('c.category_id', $categoryList);
									})->groupBY('c.id')->get();
		return $results;
	}

	// get nested sub categories
	function getSubCategoriesNested($parent_id = 0)
	{
		$categories = array();
		$results = DB::table('categories')->select('*', 'id as category_id')->where('parent_id', '=', $parent_id)->orderBy('order_no', 'ASC')->get();

		foreach($results as $result){
			$categories[] = array(
				'category_id'			=> $result->category_id,
				'title'					=> $result->title,
				'total_products'		=> $this->getTotalProducts($result->category_id),
				//'iconKeyword'			=> $result->iconKeyword,
				//'image'				=> $result->image,
				//'parent_id'			=> $result->parent_id,
				//'order_no'			=> $result->order_no,
				'sub_categories'		=> $this->getSubCategoriesNested($result->category_id),
			);
		}

		return $categories;
	}

	// get total products in category and it's subcategories
	function getTotalProducts($category_id = 0)
	{
		//select count(id) as total_products,category_id from product_to_category where category_id IN (10,11,13,14,15)

		// get subcategories
		$categoryList = $this->getSubCategories(array($category_id));

		array_push($categoryList,(int)$category_id);

		$results = DB::table('product_to_category as pc')->select(DB::raw('count(pc.id) as total_products'))->leftjoin('products as p','p.id', '=','pc.product_id' )->where('p.status','<>',0)->whereIN('category_id', $categoryList)->pluck('total_products');

		return $results;
	}

	/*------- Added by Tirthraj --------------- */
	public function getProduct($product_id, $arrivalDate, $departureDate)
	{
		$product = DB::table('products as p')
			->select(
				'p.*','b.title as brand_name',
				DB::raw('ROUND(SUM(COALESCE(prp.sale_price, 0)), 2) as sale_price'),
				DB::raw('ROUND(SUM(COALESCE(prp.list_price, 0)), 2) as list_price'),
				'prp.date as date'
			)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) use($arrivalDate, $departureDate) {
				$join->on('p.id', '=', 'prp.product_id')
					->where('prp.status', '=', '1')
					->where('prp.date', '>=', $arrivalDate)
					->where('prp.date', '<', $departureDate);
			});
		$product->leftJoin('brands as b', 'p.brand_id', '=', 'b.id');
		$product->where('p.id', $product_id);
		$product->where('p.status', '1');

		return $product->first();
	}

	public function getProductImages($product_id)
	{
		$images = DB::table('product_to_images')->where('product_id', $product_id)->get();

		foreach($images as $key => $image){
			$images[$key]->file_name = $this->resizeProductImage($image->file_name);
		}

		return $images;
	}

	public function resizeProductImage($file_name){
		if(file_exists(public_path() . '/admin/products/large/' . $file_name)){
			$Image_lib = new Image_lib();

			if(!file_exists(public_path() . '/admin/products/medium/' . $file_name)){
				//Resize
				$config['image_library'] = 'gd2';
				$config['source_image'] = public_path() . '/admin/products/large/' . $file_name;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = TRUE;

				// generate thumbnail
				$config['new_image'] = public_path() . '/admin/products/medium/' . $file_name;
				$config['width'] = 200;
				$config['height'] = 200;

				$Image_lib->initialize_img($config);
				if ( ! $Image_lib->resize())
				{
					//echo $this->Image->display_errors();
				}
			}

			if(!file_exists(public_path() . '/admin/products/small/' . $file_name)){
				//Resize
				$config['image_library'] = 'gd2';
				$config['source_image'] = public_path() . '/admin/products/large/' . $file_name;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = TRUE;

				// generate thumbnail
				$config['new_image'] = public_path() . '/admin/products/small/' . $file_name;
				$config['width'] = 100;
				$config['height'] = 100;

				$Image_lib->initialize_img($config);
				if ( ! $Image_lib->resize())
				{
					//echo $this->Image->display_errors();
				}
			}

			return $file_name;
		}
		else{
			return false;
		}
	}

	public function getBreadcrumbCategory($category_id)
	{
		return DB::table('categories')->select('id', 'title')->where('id', $category_id)->where('status', '1')->first();
	}

	public function getProductColors($product_id)
	{
		$product = DB::table('product_to_color as ptc');
		$product->select('ptc.*', 'c.title as color_name', 'c.hex_code');
		$product->leftJoin('colors as c', 'ptc.color_id', '=', 'c.id');
		$product->where('ptc.product_id', $product_id);
		$product->where('c.status', '1');
		//echo '<pre>';print_r($product->get());exit;
		return $product->get();
	}

	public function getSpecialEvent($event_id)
	{
		$event = DB::table('special_events');
		$event->select('event_type', 'token');
		$event->where('id', $event_id);

		return $event->first();
	}

	public function getGlobalDiscount($product_id, $totalAmount){
		$discount = DB::table('global_discounts_to_products as gdtp');
		$discount->select('gd.discount', 'gd.discount_by');
		$discount->leftJoin('global_discounts as gd', 'gdtp.global_discount_id', '=', 'gd.id');

		$discount->where('gdtp.product_id', '=', $product_id);
		$discount->where('gd.status', '=', '1');

		$discount->where('gd.from_amount', '<=', $totalAmount);
		$discount->where('gd.to_amount', '>=', $totalAmount);

		$discount->orderBy('gd.discount', 'DESC');

		return $discount->first();
	}

	public function getProductToQuantityDiscount($product_id, $quantity){
		$discount = DB::table('product_to_quantity_discount as ptqd');

		$discount->where('ptqd.product_id', '=', $product_id);

		$discount->where('ptqd.from_quantity', '<=', $quantity);
		$discount->where('ptqd.to_quantity', '>=', $quantity);
		$discount->where('ptqd.status', '=', '1');

		$discount->orderBy('ptqd.discount', 'DESC');

		return $discount->first();
	}

	public function getCartProducts($cartProducts, $promocode = array()){
		$productsInfo = array();
		$totalPrice = 0;

		if($cartProducts){
			$i = 0;
			foreach($cartProducts as $key => $cartProduct){
				//get infomation of product
				if (isset($cartProduct['pwp_product_id'])) {
					$product = $this->getProduct($cartProduct['pwp_product_id']);
				} else {
					$product = $this->getProduct($cartProduct['product_id']);
				}

				if($product){
					$productsInfo[$i] = $product;
					$productsInfo[$i]->cart = $cartProduct;

					//Check if this is a valid pwp product or not
					if (isset($cartProduct['pwp_price']) && Helper::isValidPwp($cartProducts, $cartProduct['product_id'])) {
						$productsInfo[$i]->pwp_price = $cartProduct['pwp_price'];
					}

					//Get color
					$colorName = false;
					if($cartProduct['color_id']){
						$color = $this->getColor($cartProduct['color_id']);
						if($color){
							$colorName = $color->title;
						}
					}
					$productsInfo[$i]->cart['colorName'] = $colorName;
					//End color

					//Get special events
					$eventName = false;
					$eventToken = false;
					if(isset($cartProduct['special_event_id']) && $cartProduct['special_event_id']){
						$event = $this->getSpecialEvent($cartProduct['special_event_id']);
						if($event){
							$eventName = $event->event_type;
							$eventToken = $event->token;
						}
					}
					$productsInfo[$i]->cart['eventName'] = $eventName;
					$productsInfo[$i]->cart['eventToken'] = $eventToken;
					//End special events
					if (isset($productsInfo[$i]->pwp_price)) {
						$totalPrice += $cartProduct['quantity'] * $productsInfo[$i]->pwp_price;
					} else {
						$totalPrice += $cartProduct['quantity'] * $product->sale_price;
					}
					$i++;
				}
			}

			//Quantity Discount Start
			foreach($productsInfo as $key => $product){
				$quantityDiscount = $this->getProductToQuantityDiscount($product->id, $product->cart['quantity']);
				$productsInfo[$key]->cart['quantityDiscount'] = 0;

				if($quantityDiscount){
					if($quantityDiscount->discount_by == 'percentage'){
					//	$productsInfo[$key]->cart['quantityDiscount'] = $productsInfo[$key]->cart['quantity'] * number_format((($quantityDiscount->discount/100) * $product->sale_price), 2);
						$product_price = isset($product->pwp_price) ? $product->pwp_price : $product->sale_price;
						$productsInfo[$key]->cart['quantityDiscount'] = round($quantityDiscount->discount / 100 * $product_price, 2);
					}
					else{
					//	$productsInfo[$key]->cart['quantityDiscount'] = $productsInfo[$key]->cart['quantity'] * $quantityDiscount->discount;
						$productsInfo[$key]->cart['quantityDiscount'] = $quantityDiscount->discount;
					}
				}
			}
			//Quantity Discount End

			//Global Discount Start
			foreach($productsInfo as $key => $product){
				$globalDiscount = $this->getGlobalDiscount($product->id, ($totalPrice));
				$productsInfo[$key]->cart['globalDiscount'] = 0;
				$productsInfo[$key]->cart['promocodeDiscount'] = 0;

				if($globalDiscount && $globalDiscount->discount_by == 'amount'){
					$productsInfo[$key]->cart['globalDiscount'] = $productsInfo[$key]->cart['quantity'] * number_format($globalDiscount->discount, 2);
				}
				elseif($globalDiscount && $globalDiscount->discount_by == 'percentage'){
					$salePrice = isset($product->pwp_price) ? $product->pwp_price : $product->sale_price;
					$salePrice = $salePrice - $product->cart['quantityDiscount'];
					$productsInfo[$key]->cart['globalDiscount'] = $productsInfo[$key]->cart['quantity'] * str_replace(',','',number_format((($globalDiscount->discount/100) * $salePrice), 2));
				}

			}
			//Global Discount End

			//Promocode Start
			if($promocode){
				$promocodeInfo = $promocode['promocode'];
				$products = $promocode['products'];

				if($promocodeInfo->min_subtotal <= $totalPrice && $this->isValidPromoCode($promocodeInfo->promo_code)){
					foreach($productsInfo as $key => $value){
						$isApplicable = false;

						if($promocodeInfo->coupon_application_rule == 'N' && in_array($value->id, $products)){
							$isApplicable = true;
						}
						elseif($promocodeInfo->coupon_application_rule == 'Y'){
							$isApplicable = true;
						}

						if($promocodeInfo->free_shipping == 'Enable' && !$value->free_shipping){
							$isApplicable = false;
						}
						elseif($promocodeInfo->free_shipping == 'Disable' && $value->free_shipping){
							$isApplicable = false;
						}

						if($isApplicable){
							if($promocodeInfo->global_discounts == 'Ignore'){
								$productsInfo[$key]->cart['globalDiscount'] = 0;
							}

							if($promocodeInfo->discount_type == 'P'){
								$salePrice = isset($value->pwp_price) ? $value->pwp_price : $value->sale_price;
								$salePrice = $salePrice - $value->cart['quantityDiscount'] - $productsInfo[$key]->cart['globalDiscount'];
								$productsInfo[$key]->cart['promocodeDiscount'] = $productsInfo[$key]->cart['quantity'] * number_format((($salePrice/100) * $promocodeInfo->discount), 2);
							}
							else{
								$productsInfo[$key]->cart['promocodeDiscount'] = $productsInfo[$key]->cart['quantity'] * number_format($promocodeInfo->discount, 2);
							}
						}
					}
				}
			}
			//Promocode End
		}

		$cart = array(
			'products'			=> $productsInfo,
			'totalPrice'		=> $totalPrice,
			'shippingTotal' => 0,
		);
		return $cart;
	}

	public function isValidPromoCode($promo_code){
		$result = DB::table('promocodes');

		$result->where('promo_code', $promo_code);

		$result->where('start_date', '<=', date('Y-m-d'));
		$result->where('end_date', '>=', date('Y-m-d'));

		$result->where('status', '=', '1');

		$promocode = $result->first();

		if($promocode){
			$count = DB::table('orders')->select('id')->where('promocode_id', '=', $promocode->id)->count();

			if($count < $promocode->times_to_use){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function getColor($color_id){
		$color = DB::table('colors as c');
		$color->where('c.id', $color_id);
		$color->where('c.status', '1');

		return $color->first();
	}

	public function getRelatedProducts($product_id, $brand_id, $sameBrand = true){
		$categories = DB::table('product_to_category as ptc')->select('ptc.category_id', 'c.parent_id')->leftJoin('categories as c', 'ptc.category_id', '=', 'c.id')->where('product_id', $product_id)->get();
		$category_ids = array();

		foreach($categories as $category){
			$category_ids[] = $category->category_id;

			if($category->parent_id){
				$category_ids[] = $category->parent_id;
			}
		}

		$product = DB::table('products as p');
		$product->select(
			'p.*','b.title as brand_name',
			DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
			DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
			'prp.date as date'
		)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
			$join->on('p.id', '=', 'prp.product_id')
				->where('prp.status', '=', '1')
				->where('prp.date', '=', date('Y-m-d'));
		});

		$product->leftJoin('brands as b', 'p.brand_id', '=', 'b.id');
		$product->leftJoin('product_to_category as ptc', 'p.id', '=', 'ptc.product_id');

		if($category_ids){
			$product->whereIn('ptc.category_id', $category_ids);
		}

		if($sameBrand && $brand_id){
			$product->where('p.brand_id', $brand_id);
		}
		elseif($brand_id){
			$product->where('p.brand_id', '<>', $brand_id);
		}

		$product->where('p.id', '<>', $product_id);

		$product->where('p.status', '1');
		$product->groupBy('p.id');
		$product->orderByRaw('RAND()');

		return $product->take(20)->get();
	}

	public function getBottomToTopCategory($category_id){

	}

	//// Update view product table
	public function updateViewProduct($id){
		$products = DB::select('SELECT * FROM viewproduct where product_id='.$id);
		if(!empty($products)>0){
			foreach($products as $product){
				$views_count = $product->views_count;
			}
			$data['product_id'] = $id;
			$data['views_count'] = $views_count + 1;
			DB::table('viewproduct')->where('product_id', $id)->update($data);
		}else{
			$data['product_id'] = $id;
			$data['views_count'] = 1;
			DB::table('viewproduct')->insert($data);
		}
	}

	public function getNewArrivals($limit = 20){
		$query = DB::table('products as p');
		$query->select(
				'p.*', DB::raw('count(p.id) as total_products'),
				DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
				DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
				'prp.date as date'
			)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
            	$join->on('p.id', '=', 'prp.product_id')
					->where('prp.status', '=', '1')
					->where('prp.date', '=', date('Y-m-d'));
        	});
		$query->leftJoin('product_to_color as clr','p.id','=','clr.product_id');

		$query->where('p.status','1');
		$query->groupBY('p.id');
		$query->orderBy('createdate', 'DESC');
		$query->take($limit);

		return $query->get();
	}

	public function getBestsellers($limit = 20){
		$query = DB::table('products as p')->select(
			'p.*', DB::raw('(SELECT SUM(otp.quantity) as total from order_to_product as otp WHERE otp.product_id = p.id) as totalItems'),
			DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
			DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
			'prp.date as date'
		)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
			$join->on('p.id', '=', 'prp.product_id')
				->where('prp.status', '=', '1')
				->where('prp.date', '=', date('Y-m-d'));
		});
		$query->leftJoin('product_to_color as clr','p.id','=','clr.product_id');

		$query->where('p.status','1');
		$query->orderBy('createdate', 'DESC');
		$query->groupBY('p.id');
		$query->having('totalItems', '!=', "''");
		$query->take($limit);

		return $query->get();
	}

	public function getCompareProducts($products){
		if($products){
			$query = DB::table('products as p')->select(
				'p.*', 'b.title as brandName',
				DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
				DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
				'prp.date as date'
			)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
				$join->on('p.id', '=', 'prp.product_id')
					->where('prp.status', '=', '1')
					->where('prp.date', '=', date('Y-m-d'));
			});;
			$query->select('p.*', 'b.title as brandName');
			$query->leftJoin('product_to_color as clr','p.id','=','clr.product_id');
			$query->leftJoin('brands as b','p.brand_id','=','b.id');

			$query->whereIn('p.id', $products);
			$query->where('p.status','1');
			$query->groupBy('p.id');

			$results = $query->get();

			foreach($results as $key => $value){
				$results[$key]->colors = $this->getProductColors($value->id);
			}

			return $results;
		}
		else{
			return array();
		}
	}

	/**
	 * Search products
	*/
	function searchProducts($sort = 'new', $filters,$get_total_records = null)
	{
		$query = DB::table('products as p')->select(
			'p.*', 'pc.display_order',
			DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
			DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
			'prp.date as date'
		)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
			$join->on('p.id', '=', 'prp.product_id')
				->where('prp.status', '=', '1')
				->where('prp.date', '=', date('Y-m-d'));
		})->leftJoin('product_to_category as pc','p.id','=','pc.product_id')->leftJoin('categories as c','pc.category_id','=','c.id')->leftJoin('product_to_color as clr','p.id','=','clr.product_id')->where('p.status','1');


		if(sizeof($filters) > 0)
		{
			if(isset($filters['brand']))
				$query = $query->where('p.brand_id',$filters['brand']);

			if(isset($filters['price_from']))
				$query = $query->where('prp.sale_price','>=',$filters['price_from']);

			if(isset($filters['price_to']))
				$query = $query->where('prp.sale_price','<=',$filters['price_to']);

			if(isset($filters['color']))
				$query = $query->where('clr.color_id','=',$filters['color']);

			if(isset($filters['keyword']))
			{
				$keyword = $filters['keyword'];
				$query = $query->Where(function($sql) use ($keyword)
				{
					$sql->where('p.product_name','like','%'.$keyword.'%')->orWhere('p.product_code','like','%'.$keyword.'%')->orWhere('p.description','like','%'.$keyword.'%')->orWhere('p.features_and_video','like','%'.$keyword.'%')->orWhere('c.title','like','%'.$keyword.'%');
				});

				//$query = $query->where('p.product_name','like','%'.$filters['keyword'].'%')->orWhere('p.product_code','like','%'.$filters['keyword'].'%')->orWhere('p.description','like','%'.$filters['keyword'].'%')->orWhere('p.features_and_video','like','%'.$filters['keyword'].'%')->orWhere('c.title','like','%'.$filters['keyword'].'%');
			}
		}

		if($sort == 'priceAsc'){
			$query = $query->orderBy('prp.sale_price', 'ASC');
		}else if($sort == 'priceDesc'){
			$query = $query->orderBy('prp.sale_price', 'DESC');
		}else if($sort == 'a-z'){
			$query = $query->orderBy('p.product_name', 'ASC');
		}else if($sort == 'z-a'){
			$query = $query->orderBy('p.product_name', 'DESC');
		}else if($sort == 'date'){
			$query = $query->orderBy('p.last_modified', 'DESC');
		}else if($sort == 'brand'){
			$query = $query->orderBy('p.brand_id', 'ASC');
		}else{
			$query = $query->orderBy('p.id', 'DESC');
		}

		if(sizeof($filters) > 0 && isset($filters['page']))
			$current_page = $filters['page'];
		else
			$current_page = 1;

		$per_page = (Session::has('product.per_page')) ? Session::get('product.per_page') : 20;

		// return total records
		if($get_total_records)
		{
			$results = $query->groupBY('p.id')->get();

			return count($results);
		}
		else
		{
			// return products list


				//$results = $query->orderBy('c.display_order','asc')->groupBY('p.id')->get();
				//$results = $query->orderBy('c.display_order','asc')->groupBY('p.id')->paginate($per_page);
			$results = $query->orderBy('pc.display_order','asc')->groupBY('p.id')->skip($per_page * ($current_page-1))->take($per_page)->get();


			return $results;
		}
	}

	/**
	 * get total search results
	*/
	function getTotalSearchResults($sort = 'new', $filters)
	{
		return $this->searchProducts($sort = 'new', $filters,'get_total_records');
	}

	/**
	 * get all brands list for sidebar filter
	 * used in search result page sidebar
	 */
	function getAllBrandFilters($filters)
	{
		/*
		$results = DB::table('products as p')->select('p.brand_id','b.title as brand_name',DB::raw('count(p.id) as total_products'))->leftJoin('brands as b','p.brand_id','=','b.id')->where('p.status','1')->where('p.brand_id','<>',0)->groupBY('b.id')->get();

		return $results;*/

		$query = DB::table('products as p')->select(
			'p.brand_id', 'b.title as brand_name', DB::raw('count(distinct p.id as total_products'),
			DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
			DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
			'prp.date as date'
		)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
			$join->on('p.id', '=', 'prp.product_id')
				->where('prp.status', '=', '1')
				->where('prp.date', '=', date('Y-m-d'));
		})->leftJoin('brands as b','p.brand_id','=','b.id')->leftJoin('product_to_category as pc','p.id','=','pc.product_id')->leftJoin('categories as c','pc.category_id','=','c.id')->leftJoin('product_to_color as clr','p.id','=','clr.product_id')->where('p.status','1')->where('p.brand_id','<>',0);

		if(sizeof($filters) > 0)
		{
			//if(isset($filters['brand']))
			//	$query = $query->where('p.brand_id',$filters['brand']);

			if(isset($filters['price_from']))
				$query = $query->where('prp.sale_price','>=',$filters['price_from']);

			if(isset($filters['price_to']))
				$query = $query->where('prp.sale_price','<=',$filters['price_to']);

			if(isset($filters['color']))
				$query = $query->where('clr.color_id','=',$filters['color']);

			if(isset($filters['keyword']))
			{
				$keyword = $filters['keyword'];
				$query = $query->Where(function($sql) use ($keyword)
				{
					$sql->where('p.product_name','like','%'.$keyword.'%')->orWhere('p.product_code','like','%'.$keyword.'%')->orWhere('p.description','like','%'.$keyword.'%')->orWhere('p.features_and_video','like','%'.$keyword.'%')->orWhere('c.title','like','%'.$keyword.'%');
				});

			}
		}

		$results = $query->groupBY('b.id')->get();

		return $results;

	}

	/**
	 * get color list for sidebar filter
	 * used in search result page sidebar
	 */
	function getAllColorFilters()
	{
		$results = DB::table('colors as c')->select('c.id as color_id','c.hex_code')->leftJoin('product_to_color as pc','pc.color_id','=','c.id')->where('c.status','1')->groupBY('c.id')->get();
		return $results;
	}

	public function getRecentViewProducts($products){
		$query = DB::table('products as p');
		$query->select(
			'p.*',
			DB::raw('ROUND(COALESCE(prp.sale_price, 0), 2) as sale_price'),
			DB::raw('ROUND(COALESCE(prp.list_price, 0), 2) as list_price'),
			'prp.date as date'
		)->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function($join) {
			$join->on('p.id', '=', 'prp.product_id')
				->where('prp.status', '=', '1')
				->where('prp.date', '=', date('Y-m-d'));
		});;
		$query->leftJoin('product_to_color as clr','p.id','=','clr.product_id');

		$query->whereIn('p.id', $products);
		$query->groupBY('p.id');
		$query->orderBy('createdate', 'DESC');

		$viewProducts = $query->get();
		$results = array();

		foreach($viewProducts as $product){
			$results[(int)array_search($product->id, $products)] = $product;
		}

		ksort($results);
		return $results;
	}

	/**
	 *	Save search terms
	 *	check if search term is already exist
	 * 	if exist than increment number uses
	*/
	function saveSearchTerm($keyword,$total_records)
	{
		$data['keyword'] = $keyword;
		$data['results'] = $total_records;
		$data['number_uses'] = 1;
		$data['last_searched'] = date('Y-m-d H:i:s');

		// check if search term already exist
		$result = DB::table('search_terms')->where('keyword',$keyword)->first();

		if($result)
		{
			DB::table('search_terms')->where('id',$result->id)->update(array('number_uses' => ($result->number_uses +1), 'results' => $total_records, 'last_searched' => date('Y-m-d H:i:s')));
		}
		else
		{
			DB::table('search_terms')->insert($data);
		}
	}

	public function addNotifyMe($product_id, $name, $email){
		$data = [
			'product_id' 	=> $product_id,
			'name' 			=> $name,
			'email' 		=> $email,
			'mail_send'		=> '0',
			'createdate'	=> date('Y-m-d H:i:s')
		];

		DB::table('notify_me')->insert($data);
	}

	public static function getCategoriesByProduct($product_id)
	{
		$results = DB::table('product_to_category')->where('product_id', $product_id)->get();
		$cat_ids = [];
		foreach ($results as $result) {
			$cat_ids[] = $result->category_id;
		}

		return $cat_ids;
	}

	public function checkPromo($code){

	    $promocode = Promocodes::where('promo_code', $code)
                ->where('status', 1)
								->whereDate('start_date','<=',\Carbon\Carbon::now())
								->whereDate('end_date','>=',\Carbon\Carbon::now())
                ->first();

			if($promocode && !$promocode->validPromoCode()) return;

			return $promocode;

    }

    public function setPromo($promo, $pids){

	    foreach($pids as $pid) {

				    $check = DB::table('promocodes_to_product')->where(['promocode_id' => $promo->id,'product_id' => $pid])->first();
						if(!$check){
							DB::table('promocodes_to_product')->insert([
	                'promocode_id' => $promo->id,
	                'product_id' => $pid
	            ]);
						}

            DB::table('product_discount')->insert([
                'user_token' => Session::get('_token'),
                'product_id' => $pid,
                'discount_id' => $promo->id
            ]);
        }

        return true;

    }


    public function checkUse($promo_id, $token){
        return DB::table('product_discount')->where('user_token', $token)->where('discount_id', $promo_id)->first();
    }

    public function getDiscount($token, $id){
        return DB::table('product_discount')->where('user_token', $token)->where('product_id', $id)
                ->leftJoin('promocodes', 'product_discount.discount_id', '=', 'promocodes.id')
                ->select('promocodes.*')
                ->orderBy('product_discount.id', 'desc')
                ->first();
    }
    public function getGSTRate(){
        return DB::table('gst_rates')->where('status', "1")
                ->first();
    }

}
