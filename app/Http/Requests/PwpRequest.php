<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\JsonResponse;

class PwpRequest extends Request {

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
		if (Request::has('id')) {
			return [
				'price' => 'required|numeric',
			];
		}
		return [
			'product_id' => 'required|numeric',
			'category_id' => 'required|numeric',
			'pwp_product_id' => 'required',
			'price' => 'required|numeric',
		];
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
