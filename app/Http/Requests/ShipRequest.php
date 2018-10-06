<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use Input;

class ShipRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		Validator::extend('greater_than', function($attribute, $value, $parameters) {
	        $other = Input::get($parameters[0]);
	        return isset($other) and intval($value) > intval($other);
	    });

		$rules = [
			'title'	=> 'required',
		];

		if (Request::input('type') == config('ship.csv')) {
			if (!Request::has('edit')) {
				$rules['csv'] = 'required|mimes:csv,txt';
			} else {
				$rules['csv'] = 'mimes:csv,txt';
			}

		} elseif (Request::input('type') == config('ship.category')) {
			$rules['product_cat'] = 'required';
			$rules['courier_charge'] = 'required|numeric';
		} elseif (Request::input('type') == config('ship.weight')) {
			$rules['from_weight'] = 'required|numeric';
			$rules['to_weight'] = 'required|numeric|greater_than:from_weight';
		} elseif (Request::input('type') == config('ship.amount')) {
			$rules['from_amount'] = 'required|numeric';
			$rules['to_amount'] = 'required|numeric|greater_than:from_amount';
		}

		return $rules;
	}

	/**
	 * Get the proper failed validation response for the request.
	 *
	 * @param  array  $errors
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function response(array $errors)
	{
		if ($this->ajax() || $this->wantsJson())
		{
			return new JsonResponse(['error' => $errors]);
		}

		return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);
	}


}
