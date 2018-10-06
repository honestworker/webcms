<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Product;
use App\Http\Models\Admin\RoomPrice;
use App\Http\Models\Admin\Category;
use App\Http\Models\Admin\Brand;
use App\Http\Models\Admin\Color;
use App\Http\Models\GlobalSettings;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;

use App\Http\Library\Image_lib;
use File;
use Mail;

use App\Http\Models\ShippingMethod;
use App\Http\Models\PwpProduct;
use Carbon\Carbon;

class ProductsController extends Controller {
	private $data = array();
	private $ProductModel = null;
	private $roomPriceModel = null;
	private $CategoryModel = null;
	private $Brand = null;
	private $Color = null;

	private $ShippingModel = null;



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
		$this->ProductModel = new Product();
		$this->roomPriceModel = new RoomPrice();
		$this->CategoryModel = new Category();
		$this->BrandModel = new Brand();
		$this->ColorModel = new Color();
		$this->ShippingModel = new ShippingMethod();

		$this->Image = new Image_lib();
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}

	function importcsv(){
		if(Request::hasFile('datafile') || Request::get('change_status')){

			$st = (Request::get('status'))? 1 : 0;
			$settings = GlobalSettings::saveSettings('product_global',json_encode(array('status' => $st)));

			if(Request::get('change_status')){
				// change status
				$status = (Request::get('status'))? 1 : 0;
				$product = new Product();
				$product->updateAllProductsStatus($status);
			}

			if(Request::hasFile('datafile')){
				// do import
				if(Request::file('datafile')->getClientOriginalExtension() != "csv"){
					Session::set('product_global_setup.warning', 'Only csv files are allowed');
					return redirect('web88cms/prdouctglobalsetup');
				}
				Request::file('datafile')->move('public/uploads', 'products.csv');
				$row = 1;
				if (($handle = fopen("public/uploads/products.csv", "r")) !== FALSE) {
					$products = array();
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						if ($row == 1){
							$row++;
							continue;
						}
						$row++;
						$products[] = array(
							'status'						=> $data[0], // products table
							'type'                          => $data[1], // products table
							'room_code'                     => $data[2], // products table
							'category'                      => $data[3], //categories table
							'sub_category'                  => $data[4], //categories table
							'sub_sub_category'              => $data[5], //categories table
							'sub_sub_sub_category'          => $data[6], //categories table
							'sub_sub_sub_sub_category'      => $data[7], //categories table
							'product_brand'                 => $data[8], // brands table
							'sale_price'                    => $data[9], // products table
							'list_price'                    => $data[10], // products table
							'quantity_in_stock'             => $data[11], // products table
							'low_level_in_stock'            => $data[12], // products table
							'manufacturer_part_number'      => $data[13], // products table
							'tax'                           => $data[14], // products table
							'weight'                        => $data[15] // products table
						);


					}
					fclose($handle);
				}
				$product = new Product();
				$result = $product->importBulkProducts($products);

			}

			Session::set('product_global_setup.success', 'Settings saved successfully');

		} else{
			Session::set('product_global_setup.warning', 'Please upload a file or change the status');
		}
		return redirect('web88cms/prdouctglobalsetup');
	}


	function addProduct()
	{
		if(Request::isMethod('post'))
		{
			// echo '<pre>';print_r(Request::input());exit;
			$messages = [
				//'required' => 'The :attribute field is required.',
				'large_image.required' => 'Max file size should be less than 2MB.',
				'roomPrices.required' => 'Please add the room price.'
			];

			$validator = Validator::make(Request::all(),[
				// 'product_name' => 'required',
				'type' => 'required',
				'room_code' => 'required',
				'categories' => 'required',
				'roomPrices' => 'required',
				// 'large_image' => 'required|image|max:2000000'
			], $messages);

		  	if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				//echo json_encode($json);
				//return Redirect::back()->withErrors($validator);
				return Redirect::back()->withInput()->withErrors($validator);
				exit;
			}
			else
			{

				$roomPrices = json_decode(Request::get('roomPrices'));

				$imageName = null;
				$custom_data = array();
				// if(isset($_FILES['large_image']['name']) && $_FILES['large_image']['name']!='')
				// {

				// 	$imageName = time().'_'.$_FILES['large_image']['name'];
				// 	Request::file('large_image')->move(
				// 		base_path() . '/public/admin/products/large/', $imageName
				// 	);

				// 	// resize image
				// 	$this->resizeImage($imageName);

				// 	$custom_data['large_image'] = $imageName;
				// }

				if(isset($_FILES['thumbnail_image_1']['name']) && $_FILES['thumbnail_image_1']['name']!='')
				{

					$thumbnail_image_1 = time().'_'.$_FILES['thumbnail_image_1']['name'];
					Request::file('thumbnail_image_1')->move(
						base_path() . '/public/admin/products/medium/', $thumbnail_image_1
					);

					$custom_data['thumbnail_image_1'] = $thumbnail_image_1;
				}

				// if(isset($_FILES['thumbnail_image_2']['name']) && $_FILES['thumbnail_image_2']['name']!='')
				// {

				// 	$thumbnail_image_2 = time().'_'.$_FILES['thumbnail_image_2']['name'];
				// 	Request::file('thumbnail_image_2')->move(
				// 		base_path() . '/public/admin/products/medium/', $thumbnail_image_2
				// 	);

				// 	$custom_data['thumbnail_image_2'] = $thumbnail_image_2;
				// }

				// add/update custom values to request input array
				$custom_data['status'] = (Request::input('status') == 'on') ? '1' : '0';
				$custom_data['is_tax'] = (Request::input('is_tax') == 'on') ? '1' : '0';
				// $custom_data['is_available'] = (Request::input('is_available') == 'on') ? '1' : '0';
				// $custom_data['in_physical_store_only'] = (Request::input('in_physical_store_only') == 'on') ? '1' : '0';
				$custom_data['display_order'] = (Request::input('display_order') != 0) ? Request::input('display_order') : '0';


				$custom_data['promo_behaviour'] = (Request::input('promo_behaviour')) ? implode(',',Request::input('promo_behaviour')) : '';

				if(sizeof($custom_data) > 0)
					Request::merge($custom_data);


				$product_id = $this->ProductModel->addProduct(Request::input());

				if ($product_id && $roomPrices) {
					$this->roomPriceModel->addRoomPrices($product_id, $roomPrices);
				}

				$this->data['success'] = 'Product added successfully.';

				return redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);

				//Redirect::back()->with('data', $this->data);
			}
		}

		// get categories
		if(Request::old('categories'))
			$this->data['categories'] = $this->CategoryModel->getSelectedCategoriesTree(Request::old('categories'));
		else
			$this->data['categories'] = $this->CategoryModel->getCategoriesTree();

		// get active brands
		$this->data['brands'] = $this->BrandModel->getActiveBrands();

		// get active colors
		$this->data['colors'] = $this->ColorModel->getActiveColors();

		// set page title
		$this->data['page_title'] = 'Add Product';

		return view('admin.products.add_products',$this->data);
	}

	function editProduct($product_id)
	{
		$this->data['success_response'] = Session::get('response');
		Session::forget('response');

		if(Request::ajax()) {
			$prices = DB::table('product_room_prices')
				->where('product_id', '=', $product_id)
				->get();

			$priceArray = [];
			foreach($prices as $price) {
				$priceArray[] = (object)[
					'id' => date('Ymd', strtotime($price->date)),
					'title' => 'RM: ' . number_format((float)$price->sale_price, 2, '.', '') . "\r\n" .
						'Qty: ' . number_format((float)$price->qty_stock, 2, '.', ''),
					'status' => $price->status == '1',
					'salePrice' => $price->sale_price,
					'listPrice' => $price->list_price,
					'qtyStock' => $price->qty_stock,
					'lowLevel' => $price->low_level,
					'restrictionText' => $price->restriction_text,
					'allDay' => true,
					'start' => $price->date,
					'textColor' => $price->status == '1' ? '#3c763d' : '#a94442',
					'borderColor' => 'transparent',
					'backgroundColor' => 'transparent',
				];
			}

			return response()->json($priceArray);
		}

		if(Request::isMethod('post'))
		{
			// echo '<pre>';print_r(Request::input());exit;
			$roomPrices = json_decode(Request::get('roomPrices'));

			$messages = [
				'thumbnail_image_1.required' => 'Max file size should be less than 2MB.',
				'max' => 'Max file size should be less than 2MB.'
			];

			$validation_rules = array(
				'type' => 'required',
				'room_code' => 'required',
				'categories' => 'required',
			);


			// if(Request::file('large_image'))
			// {
			// 	$validation_rules['large_image'] = 'required|image|max:2000';
			// }

			// if(Request::file('large_image'))
			// {
			// 	$file = Request::file('large_image');

			// 	if($file->getClientSize() > 2000000)
			// 		$validation_rules['large_image'] = 'required|image|max:2000000';
			// }

			if(Request::file('thumbnail_image_1'))
			{
				$validation_rules['thumbnail_image_1'] = 'required|image|max:2000000';
			}

			// if(Request::file('thumbnail_image_2'))
			// {
			// 	$validation_rules['thumbnail_image_2'] = 'required|image|max:2000000';
			// }

			$validator = Validator::make(	Request::all(),$validation_rules,
											$messages
										);



			//$validator = Validator::make(	Request::all(),$validation_rules,$messages);

		  if ($validator->fails()) {
				//$json['error'] = $validator->errors()->all();
				//echo json_encode($json);
				//return Redirect::back()->withErrors($validator);
				return Redirect::back()->withErrors($validator);
				exit;

			}
			else
			{

				$imageName = null;
				$custom_data = array();
				// if(isset($_FILES['large_image']['name']) && $_FILES['large_image']['name']!='')
				// {

				// 	$imageName = time().'_'.$_FILES['large_image']['name'];
				// 	Request::file('large_image')->move(
				// 		base_path() . '/public/admin/products/large/', $imageName
				// 	);

				// 	// resize image
				// 	$this->resizeImage($imageName);

				// 	$custom_data['large_image'] = $imageName;
				// }

				if(isset($_FILES['thumbnail_image_1']['name']) && $_FILES['thumbnail_image_1']['name']!='')
				{

					$thumbnail_image_1 = time().'_'.$_FILES['thumbnail_image_1']['name'];
					Request::file('thumbnail_image_1')->move(
						base_path() . '/public/admin/products/medium/', $thumbnail_image_1
					);

					$custom_data['thumbnail_image_1'] = $thumbnail_image_1;
				}

				// if(isset($_FILES['thumbnail_image_2']['name']) && $_FILES['thumbnail_image_2']['name']!='')
				// {

				// 	$thumbnail_image_2 = time().'_'.$_FILES['thumbnail_image_2']['name'];
				// 	Request::file('thumbnail_image_2')->move(
				// 		base_path() . '/public/admin/products/medium/', $thumbnail_image_2
				// 	);

				// 	$custom_data['thumbnail_image_2'] = $thumbnail_image_2;
				// }

				// add/update custom values to request input array
				$custom_data['status'] = (Request::input('status') == 'on') ? '1' : '0';
				$custom_data['is_tax'] = (Request::input('is_tax') == 'on') ? '1' : '0';
				// $custom_data['is_available'] = (Request::input('is_available') == 'on') ? '1' : '0';
				// $custom_data['in_physical_store_only'] = (Request::input('in_physical_store_only') == 'on') ? '1' : '0';
				$custom_data['display_order'] = (Request::input('display_order') != 0) ? Request::input('display_order') : '0';

				$custom_data['promo_behaviour'] = (Request::input('promo_behaviour')) ? implode(',',Request::input('promo_behaviour')) : '';

				if(sizeof($custom_data) > 0)
					Request::merge($custom_data);

				//dd(Request::input());

				$this->ProductModel->updateProduct(Request::input(),$product_id);

				if ($product_id && $roomPrices) {
					$this->roomPriceModel->addRoomPrices($product_id, $roomPrices);
				}

				//Notify user start
				if(Input::get('quantity_in_stock') > 0){
					$users = $this->ProductModel->getNotifyUsers($product_id);

					if($users){
						$ids = array();
						$messageBody = 'Hello, We\'ll like to let you know that product ' . Input::get('type') . ' ' . Input::get('room_code') . ' is now available in our site.';

						foreach($users as $users){
							$messageData = [
								'fromEmail' 			=> 'registration@ritzgardenhotel.com',
								'fromName' 				=> 'Ritz Garden Hotel Online booking',
								'toEmail' 				=> $users->email,
								'toName' 				=> $users->name,
								'subject'				=> Input::get('type') . ' ' . Input::get('room_code') . ' is now available!!!'
							];

							/*Mail::raw($messageBody, function ($message) use ($messageData) {
								$message->from($messageData['fromEmail'], $messageData['fromName']);
								$message->to($messageData['toEmail'], $messageData['toName']);
								$message->subject($messageData['subject']);
							});*/

							$ids[] = $users->id;
						}

						$this->ProductModel->updateNotifyUsers($ids);
					}
				}
				//Notify user end

				$this->data['success'] = 'Changes saved successfully.';

				Redirect::back()->with('data', $this->data);
			} // end else
		} // end if(Request::isMethod('post'))

		// get product details
		$this->data['details'] = $this->ProductModel->getProductDetails($product_id);

		// get categories
		//$this->data['categories'] = $this->CategoryModel->getCategoriesTree();

		$productCategoryList = array();
		if(sizeof($this->data['details']['productCategories']) > 0)
		{
			foreach($this->data['details']['productCategories'] as $productCategories)
			{
				array_push($productCategoryList,$productCategories->category_id);
			}
		}

		$this->data['categories'] = $this->CategoryModel->getSelectedCategoriesTree($productCategoryList);

		// get active brands
		$this->data['brands'] = $this->BrandModel->getActiveBrands();

		// get active colors
		$this->data['colors'] = $this->ColorModel->getActiveColors();

		// get product images
		$this->data['additional_images'] = $this->ProductModel->getProductImages($product_id);

		// get quantity discounts
		$this->data['quantity_discounts'] = $this->ProductModel->getQuantityDiscounts($product_id);

		// get pagination record status
		$this->data['pagination_report'] = $this->ProductModel->getTotalQuantityDiscounts(Input::get('page'),$product_id);

		// set page title
		$this->data['page_title'] = 'Edit Product';

		//Get Available Csv shipping method
		$this->data['csv_ships'] = $this->ShippingModel->getCsvShippingByWeight((float)$this->data['details']['productDetails']->weight);

		//Get pwp products
		$this->data['pwp_products'] = PwpProduct::where('product_id', $product_id)->with('product')->get();

		$this->data['tab'] = Input::get('activetab');

		//product ID
		$this->data['pid'] = $product_id;

		//room amenities
		$this->data['amenities'] = json_decode($this->ProductModel->getAmenities($product_id)->amenities);
		return view('admin.products.edit_products',$this->data);

	}

	function deleteImage($type,$product_id)
	{
		DB::table('products')->where('id',$product_id)->update(array($type => ''));

		$this->data['success'] = 'Image removed successfully.';

		//redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
		//Redirect::back('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
		return redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
	}

	function updateShippingInfo($product_id)
	{
		$this->data	= '';
		if(Request::ismethod('post'))
		{
			$formData = Request::input();

			unset($formData['_token']);

			// $formData['shipping_cost'] = str_replace(',','',$formData['shipping_cost']);
			$formData['last_modified'] = date('Y-m-d H:i:s');

			DB::table('products')->where('id',$product_id)->update($formData);

			$this->data['success'] = 'Changes saved successfully.';
		}

		return redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
	}

	function listProducts()
	{
		$page = 0;
		$sort = 'ASC';
		$sort_by = 'createdate';

		// response variable is set when item is deleted
		$this->data['success'] = Session::get('response');
		Session::forget('response');

		/*if(Request::get('type'))
		{
			//Session::put('product.per_page',1);
			$this->data['products'] = $this->ProductModel->searchProducts(Input::get());

			// get pagination record status
			$this->data['pagination_report'] = $this->ProductModel->getTotalSearchResults(Input::get());
		}
		else
		{
			//Session::put('product.per_page',2);
			// get products
			$this->data['products'] = $this->ProductModel->getProducts(Input::get());

			// get pagination record status
			$this->data['pagination_report'] = $this->ProductModel->getTotalProducts(Input::get('page'));
		}*/

		$this->data['products'] = $this->ProductModel->searchProducts(Input::get());
// echo '<pre>';print_r($this->data['products']->toArray());exit;
		// get pagination record status
		$this->data['pagination_report'] = $this->ProductModel->getTotalSearchResults(Input::get());

		// get categories
		//$this->data['categories'] = $this->CategoryModel->getCategoriesTree();
		//$productCategoryList = (Input::get('category_id') != 'all') ? array(Input::get('category_id')) : '';
		$this->data['categories'] = $this->CategoryModel->getSelectedCategoriesTree(array(Input::get('category_id')));

		// get active brands
		$this->data['brands'] = $this->BrandModel->getActiveBrands();

		// get last updated
		$this->data['last_modified'] = DB::table('products')->orderBy('last_modified','desc')->pluck('last_modified');

		// set page title
		$this->data['page_title'] = 'List Products';

		$inputs = Input::get();

		if(Input::get('sort')){
			$sort = Input::get('sort');
			unset($inputs['sort']);
		}

		if(Input::get('sort_by')){
			$sort_by = Input::get('sort_by');
			unset($inputs['sort_by']);
		}

		$this->data['sort'] = $sort;
		$this->data['sort_by'] = $sort_by;
		$url = url('web88cms/products/list') . '?';

		if($inputs){
			foreach($inputs as $key => $val){
				$url .= $key .'='. $val .'&';
			}
		}

		$this->data['sorting_url'] = $url;

		return view('admin.products.list_products', $this->data);
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


	function updateDescription($product_id)
	{
        $desc = Request::input('content');
		DB::table('products')->where('id',$product_id)->update(array('description' => $desc, 'last_modified' => date('Y-m-d H:i:s') ));
	}

	function updateFeaturedVideo($product_id)
	{
		DB::table('products')->where('id',$product_id)->update(array('features_and_video' => Request::input('content'), 'last_modified' => date('Y-m-d H:i:s') ));
		//echo Request::input('content');
	}

	function updateWarrantyAndSupport($product_id)
	{
		DB::table('products')->where('id',$product_id)->update(array('warranty_and_support' => Request::input('content'), 'last_modified' => date('Y-m-d H:i:s') ));
	}

	function updateReturnPolicy($product_id)
	{
		DB::table('products')->where('id',$product_id)->update(array('return_policy' => Request::input('content'), 'last_modified' => date('Y-m-d H:i:s') ));
	}

	function addImages1($product_id)
	{
		//dd($_FILES);

		$files = Input::file('large_image');

		$file_uploaded = array();
		if(sizeof($_FILES['large_image']['name']) > 0)
		{
			for($i = 0; $i< sizeof($_FILES['large_image']['name']); $i++)
			{
				if($_FILES['large_image']['name'][$i] != '' && $_FILES['large_image']['error'][$i] == 0)
				{
					$imageName = time().'_'.$_FILES['large_image']['name'][$i];



					$files->move(
						base_path() . '/public/admin/products/large/', $imageName
					);

					/*Request::file('large_image')->move(
						base_path() . '/public/admin/products/large/', $imageName
					);*/

					array_push($file_uploaded,$imageName);
				}
			}
		}

		if(sizeof($file_uploaded) == 0)
		{
			$this->data['success'] = 'Please select valid image.';

			return redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
		}


	}

	// reference link : http://tutsnare.com/upload-multiple-files-in-laravel/
	public function addImages($product_id) {
		// getting all of the post data
		$files = Input::file('large_image');
		// Making counting of uploaded images
		$file_count = count($files);
		// start count how many uploaded
		$uploadcount = 0;
		$sizeError = '';

		foreach($files as $file) {

			$destinationPath = base_path() . '/public/admin/products/large/';
			if($file)
			{
				if($file->getClientSize() > 2000000 || $file->getClientSize() == 0)
				{
					$sizeError = 'Max file size should be less than 2MB.';
				}
				else
				{
					$filename = time().'_'.$file->getClientOriginalName();
					$upload_success = $file->move($destinationPath, $filename);

					// resize image
					$this->resizeImage($filename);

					$uploadcount ++;

					DB::table('product_to_images')->insert(array('product_id' => $product_id, 'file_name' => $filename));
				}
			}
		}

		if($sizeError != '')
		{
			$this->data['error'] = $sizeError;
		}
		else if($uploadcount == 0)
		{
			$this->data['error'] = 'Please select valid image.';
		}
		else
		{
		 $this->data['success'] = 'Image(s) saved successfully.';
		}

		return redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);

	}

	function resizeImage($file_name)
	{
		//$this->Image = new Image_lib();
		// resize image
		//$this->load->library('image_lib');
		$path = base_path() . '/public/admin/products/';
		$source_path = $path.'large/'.$file_name;
		$medium_image_path = $path.'medium/'.$file_name;
		//$thumb_path = $path.'small/'.$file_name;

		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['thumb_marker'] = '';

		// generate thumbnail
		/*$config['new_image'] = $thumb_path;
		$config['width'] = 65;
		$config['height'] = 90;
		$this->Image->initialize_img($config);
		if ( ! $this->Image->resize())
		{
			//echo $this->Image->display_errors();
		}*/

		// medium size image
		$config['new_image'] = $medium_image_path;
		$config['width'] = 125;
		$config['height'] = 75;
		$this->Image->initialize_img($config);
		if ( ! $this->Image->resize())
		{
			//echo $this->Image->display_errors();
		}
		// end resize

		$this->Image->initialize_img($config);
		$this->Image->resize();

		if($this->Image->display_errors())
		{
			//echo $this->Image->display_errors();
		}

		//exit;
	}

	function deleteAdditionalImage($image_id,$product_id)
	{
		DB::table('product_to_images')->where('id',$image_id)->delete();

		$this->data['success'] = 'Image removed successfully.';

		//redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
		//Redirect::back('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
		return redirect('/web88cms/products/editProduct/'.$product_id)->with('data', $this->data);
	}

	function deleteProducts()
	{
		$this->ProductModel->deleteProducts($_POST['item_id']);
		Session::put('response', 'Item(s) deleted successfully.');
	}

	function categoryProducts()
	{
		$category_id = Request::Input('category_id');
		DB::enableQueryLog();
//		$result = DB::table('products as p')->select('p.*','c.display_order')->leftJoin('product_to_category as c','p.id','=','c.product_id')->where('p.status','1')->where('c.category_id',$category_id)->groupBY('p.id')->get();
        $result = DB::table('products as p')
            ->select(
                'p.*','c.display_order',
                DB::raw('COALESCE(prp.sale_price, 0) as s_price'),
                DB::raw('COALESCE(prp.list_price, 0) as list_price'),
                'prp.date as date'
            )->leftJoin(DB::raw('(SELECT * FROM `product_room_prices`) prp'), function ($join) {
                $join->on('p.id', '=', 'prp.product_id')
                    ->where('prp.status', '=', '1')
                    ->where('prp.date', '=', date('Y-m-d'));
            })->leftJoin('product_to_category as c', 'p.id', '=', 'c.product_id')
            ->where('p.status', '1')
            ->where('c.category_id', $category_id)->groupBY('p.id')->get();
		// print_r(DB::getQueryLog());exit;

		foreach($result as $key => $item) {
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

		if(count($new_res) > 0)
			echo json_encode(array('products' => $new_res));
	}

	function addQuantityDiscount()
	{
		$formData = Input::get();

		if($formData['from_quantity'] != '' && $formData['to_quantity'] != '')
		{
			unset($formData['_token']);

			$formData['status'] = (isset($formData['status'])) ? '1' : '0';

			DB::table('product_to_quantity_discount')->insert($formData);

			$this->data['success'] = 'Quantity discount added successfully.';

			return Redirect::back()->with('data', $this->data);
		}

		return Redirect::back();
	}

	function updateQuantityDiscount()
	{
		$formData = Input::get();

		if($formData['from_quantity'] != '' && $formData['to_quantity'] != '')
		{
			unset($formData['_token']);

			$discount_id = $formData['discount_id'];
			unset($formData['discount_id']);

			$formData['discount'] = str_replace(',','',$formData['discount']);
			$formData['status'] = (isset($formData['status'])) ? '1' : '0';

			DB::table('product_to_quantity_discount')->where('id',$discount_id)->update($formData);

			$this->data['success'] = 'Quantity discount updated successfully.';

			return Redirect::back()->with('data', $this->data);
		}

		return Redirect::back();
	}

	function deleteQuantityDiscount()
	{
		$this->ProductModel->deleteQuantityDiscount($_POST['item_id']);
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



	public function editProductAmenities(\Illuminate\Http\Request $request, $id){
	    if(!$request->ajax()){return false;}
	    $res = $this->ProductModel->saveAmenities($request->all(), $id);
	    return json_encode($res);
    }
}
