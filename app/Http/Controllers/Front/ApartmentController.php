<?php namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Models\Front\Product as ProductModel;

use Illuminate\Http\Request;

class ApartmentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $ProductModel = null;

	public function __construct()
	{
		$this->ProductModel = new ProductModel();
	}

	public function index($id='')
	{
		$product = array();

		if(!empty($id)){
			$product = $this->ProductModel->getProductsByCategory(9);
			$banners = \App\Models\BannerLeft::getBannerImages(9);
		}


		return view('front/apartments/home', ['apartments'=>$product, "banners" => $banners]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	   $product = Product::findOrFail($id);
	   $images = Product::findOrFail($id)->images;
	   // $images = $this->ProductModel->getProductImages($id);
		return view('front/rooms_suites/show')->with('product',$product)
		                                      ->with('images',$images);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
