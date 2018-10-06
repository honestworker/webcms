<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\PwpProduct;
use App\Http\Requests\PwpRequest;
use Illuminate\Http\JsonResponse;
use Helper;
use Session;
use Request;

class PwpProductsController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function postSave(PwpRequest $request)
	{
		$data = $request->except('_token');
		if (isset($_POST['status'])) {
			$data['status'] = 1;
		} else {
			$data['status'] = 0;
		}

		$id = $request->input('id');
		PwpProduct::saveForm($data, $id);
		Session::flash('success', 'The pwp product has been saved successfully.');
		return new JsonResponse(['success' => 'TRUE']);
	}

	public function postList()
	{
		if (!Request::has('category_id') || (Request::has('category_id') && !is_numeric(Request::input('category_id')))) {
			return new JsonResponse(['error' => ['Invalid data posting']], 422);
		}

		return view('admin.products.list_pwp')
			   ->with('products', PwpProduct::getProductByCategoryId(Request::input('category_id')));
	}

	/**
	 * Delete one or multiple items at once
	 *
	 * @return json
	 */
	public function postDelete()
	{
		$id = '';
		if (Request::has('pwp_ids')) {
			$id = Request::input('pwp_ids');
		} elseif (Request::has('id')) {
			$id = Request::input('id');
		}

		if (is_numeric($id) || is_array($id)) {
			PwpProduct::destroy($id);
			Session::flash('success', 'The pwp product has been deleted successfully');
			return new JsonResponse(['success' => 'TRUE']);
		}
		Session::flash('error', 'The pwp product has not been deleted. Please correct the errors');
		return new JsonResponse(['error' => ['Invalid data posting']], 422);
	}
}