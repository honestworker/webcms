<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PwpProduct extends Model {

	use PwpProductTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pwp_products';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'category_id', 'product_id', 'pwp_product_id', 'price', 'status', 'created_at', 'updated_at'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function product()
	{
		return $this->belongsTo('App\Http\Models\Admin\Product', 'pwp_product_id');
	}
}
