<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Product;
use App\Http\Models\Front\Checkout;

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

class CompareController extends Controller {
	private $data = array();
	private $ProductModel = null;

	public function __construct()
	{
		$this->ProductsModel = new Product();
	}

	function index()
	{
		$this->data['success'] = Session::get('compare.success');
		Session::forget('compare.success');
		
		$compare = Session::get('compare');
		
		$this->data['compareProducts'] = $this->ProductsModel->getCompareProducts($compare);
		$this->data['page_title'] = 'Compare Products';
		
		return view('front.compare.index',$this->data);
	}
	
	public function addToCompare(){
		$compare = Session::get('compare');
		$product_id = (int)Input::get('product_id');
				
		if(is_array($compare) && in_array($product_id, $compare)){
			$json['warning'] = 'Item is already added to compare list.';
		}
		else{
			$compare[$product_id] = (int)$product_id;
			$json['success'] = 'Item successfully added to compare list.';
		}
		
		Session::put('compare', $compare);
		return Response::json($json);
	}
	
	public function deleteToCompare($product_id){
		$compare = Session::get('compare');
		
		if(isset($compare[$product_id])){
			unset($compare[$product_id]);
		}
		
		Session::put('compare', $compare);
		Session::put('compare.success', 'Item successfully removed from compare list.');
		
		return redirect('/compare');
	}
}
