<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Promotion;
use App\Http\Models\Admin\Category;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Request;

class PromotionsController extends Controller {
	private $data = array();
	private $PromotionModel = null;
	private $CategoryModel = null;

	public function __construct()
	{
		$this->middleware('auth');
		$this->PromotionModel = new Promotion();
		$this->CategoryModel = new Category();

	}

	function listGlobalDiscounts()
	{
		$this->data['success'] = Session::get('response');
		Session::forget('response');


		// get global discounts
		$this->data['global_discounts'] = $this->PromotionModel->getGlobalDiscounts();

		// get pagination record status
		$this->data['pagination_report'] = $this->PromotionModel->getTotalProducts(Input::get('page'));

		// get category list
		$this->data['categories'] = $this->CategoryModel->getCategoriesTree();
		// get last updated
		$this->data['last_modified'] = DB::table('global_discounts')->orderBy('last_modified','desc')->pluck('last_modified');

		$this->data['page_title'] = 'Global Discounts:: Listing';

		return view('admin.promotions.global_discounts_list',$this->data);

	}

	function addGlobalDiscount()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(	Request::all(),[
												'from_amount' => 'required',
												'to_amount' => 'required',
												'discount'	=> 'required'
											]
										);

		  if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;

			}
			else
			{
				$this->PromotionModel->addGlobalDiscount(Request::input());

				Session::put('response', 'Global discount added successfully.');

				echo json_encode(array('success' => 'success'));
			}
		}
	}

	function deleteGlobalDiscounts()
	{
		$brands = $this->PromotionModel->deleteGlobalDiscounts($_POST['item_id']);
		Session::put('response', 'Item(s) deleted successfully.');
	}


	function updateGlobalDiscount()
	{
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(	Request::all(),[
												'from_amount' => 'required',
												'to_amount' => 'required',
												'discount'	=> 'required'
											]
										);

		  if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;

			}
			else
			{
				$this->PromotionModel->updateGlobalDiscount(Request::input());

				Session::put('response', 'Global discount updated successfully.');

				echo json_encode(array('success' => 'success'));
			}
		}
	}
}
