<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\ShippingMethod;
use App\Http\Requests\ShipRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Models\Admin\Category;
use App\Http\Models\Countries;
use Request;
use Session;
use Helper;
use Input;

class ShippingMethodsController extends Controller {

	const CSV = 'csv';
	const CATEGORY = 'category';
	const WEIGHT = 'weight';
	const AMOUNT = 'amount';
	var $types = [self::CSV, self::CATEGORY, self::WEIGHT, self::AMOUNT];

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => 'getShippingOptions']);
	}

	/**
	 * Listing shipping method in database by type
	 *
	 * @param $type
	 * @return html
	 */
	public function index($type = null,$limit = 10)
	{

		$page = (Input::get('page'))?Input::get('page'):1;
		$itemIndex = ($page-1)*$limit;
		
		$type = is_null($type) ? self::CSV : $type;
		$type = in_array($type, $this->types) ? $type : self::CSV;

		$with = '';

		$data = [
			'type' => config("ship.$type"),
			'title' => config("ship.title.$type"),
		];

		if ($type == 'category') {
			$categoryModel = new Category();
			$data['categories'] = $categoryModel->getSelectedCategoriesTree([]);
			$with = 'category';
		}

		if ($type == 'weight') {
			$countryModel = new Countries();
			$data['countries'] = $countryModel->getCountries();
			$data['states'] = Helper::getStateArrayByCoutryId();
			$with = 'country_parent';
		}

		if ($with == '') {
			$data['ships'] = ShippingMethod::ofType(config("ship.$type"))
									->paginate($limit)
									->setPath(route('ship.index', $type));
			$count = ShippingMethod::ofType(config("ship.$type"))->count();
		} else {
			$data['ships'] = ShippingMethod::ofType(config("ship.$type"))
									->with($with)->paginate($limit)
									   ->setPath(route('ship.index', $type));
			$count = ShippingMethod::ofType(config("ship.$type"))->with($with)->count();
		}

		$lastUpdate = '';
		foreach ($data['ships'] as $ship){
			if($ship->updated_at > $lastUpdate){
				$lastUpdate = $ship->updated_at;
			}
		}
		$data['lastUpdate'] = $lastUpdate;

		$data['limit'] = $limit;
		$data['typeName'] = $type;
		$results = $data['ships'];
		$data['paginate_msg'] = ($results? 'Showing ' . ($itemIndex + 1) . ' to ' . ($itemIndex + count($results)) . ' of ' . $count . ' entries':'');

		return view('admin.ship.index')->with($data);
	}

	/**
	 * Edit CSV Shipping method
	 *
	 * @param  Integer $id
	 * @return html
	 */
	public function editCsv($id)
	{
		$ship = ShippingMethod::find($id);
		if (is_null($ship)) {
			throw new Exception('Shipping Method Not Exists!');
		}

		$csv_content = Helper::outputCsv($ship->csv_content);

		return view('admin.ship.csv_import_edit', compact('ship', 'csv_content'));
	}

	/**
	 * Insert and update shipping method to database
	 *
	 * @param  ShipRequest $request
	 * @return json
	 */
	public function setup(ShipRequest $request)
	{
		$data = $request->except(['_token', 'edit', 'csv', 'selected_cat_id', 'selected_state_id', 'selected_country_id']);

		if (isset($_POST['status'])) {
			$data['status'] = 1;
		} else {
			$data['status'] = 0;
		}

		if (!$request->has('country')) {
			$countryModel = new Countries();
			$data['country'] = $countryModel->getCountryIdByName('Malaysia');
		}

		if ($request->hasFile('csv')) {
			$file = $request->file('csv');
			if (! $file->isValid()) {
				Session::flash('error', 'Error Uploading File');
				if ($request->ajax()) {
					return new JsonResponse(['error' => ['Error Uploading File']]);
				}

				return redirect()->route('ship.index');
			}

			$csv_import = Helper::importCsv($file);
			$data['csv_content'] = serialize($csv_import['csv_content']);
			$data['csv_file'] = $csv_import['csv_file'];
		}

		$id = $request->input('id');
		if ($id && is_numeric($id)) {
			ShippingMethod::where('id', $id)->update($data);
			$route = ['ship.edit.csv', $id];
		} else {
			ShippingMethod::create($data);
			$route = ['ship.index', config('ship.type.'.$data['type'])];
		}

		Session::flash('success', 'The shipping method has been saved successfully.');
		if ($request->ajax()) {
			return new JsonResponse(['success' => 'TRUE']);
		}

		return redirect()->route($route[0], $route[1]);
	}

	/**
	 * Delete one or multiple shipping methods at once
	 *
	 * @return json
	 */
	public function delete()
	{
		$id = '';
		if (Request::has('ships')) {
			$id = Request::input('ships');
		} elseif (Request::has('id')) {
			$id = Request::input('id');
		}

		if (is_numeric($id) || is_array($id)) {
			ShippingMethod::destroy($id);
			Session::flash('success', 'The shipping method has been deleted successfully');
			return new JsonResponse(['success' => 'TRUE']);
		}
		Session::flash('error', 'The shipping method has not been deleted. Please correct the errors');
		return new JsonResponse(['error' => ['Invalid data posting']], 422);
	}

	/**
	 * Delete Files csv upload on server
	 *
	 * @param  String $fileName
	 * @return redirect
	 */
	public function deleteFile($fileName)
	{
		if (file_exists(base_path().config('ship.csv_path').'/'.$fileName)) {
			unlink(base_path().config('ship.csv_path').'/'.$fileName);

			Session::flash('success', "File $fileName has been deleted successfully.");
			return redirect()->back();
		}

		Session::flash('error', "File $fileName has not been deleted.");
		return redirect()->back();
	}

	/**
	 * Update csv content in database
	 *
	 * @return json
	 */
	public function updateCsv()
	{
		$head = Request::input('head_row');
		$body = Request::input('body_row');
		$id = Request::input('id');

		if (!is_numeric($id)) {
			return new JsonResponse(['error' => ['Id Not Exists']]);
		}

		if (!is_array($head) || !is_array($body)) {
			Session::flash('error', 'The information has not been updated.');
			return new JsonResponse(['error' => ['Error Processing Request']]);
		}

		//validate data
		foreach ($body as $row) {
			foreach ($row as $col) {
				if (!is_numeric($col)) {
					Session::flash('error', 'The data input must be a number.');
					return new JsonResponse(['error' => ['Error Processing Request']]);
				}
			}
		}

		$ship = ShippingMethod::find($id);

		if (is_null($ship)) {
			return new JsonResponse(['error' => ['Id Not Exists']]);
		}

		$ship->csv_content = serialize(array_merge($head, $body));
		$ship->save();

		Session::flash('success', 'The information has been updated successfully');
		return new JsonResponse(['success' => 'TRUE']);
	}

	/**
	 * Get Csv shipping method via ajax
	 * @return JsonResponse
	 */
	public function getShippingOptions()
	{
		if (!Request::has('state_id') || !Request::has('total_weight')) {
			return new JsonResponse(['options' => []]);
		}

		$ship_model = new ShippingMethod();
		return new JsonResponse(['options' => $ship_model->getAvailableCsvShipping(Request::input('total_weight'),
																						  Request::input('state_id'))]);
	}
}
