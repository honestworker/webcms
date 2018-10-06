<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model {

	use ShippingMethodTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'shipping_methods';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'type', 'title', 'product_cat', 'from_weight', 'to_weight', 'from_amount', 'to_amount', 'csv_file', 'csv_content', 'courier_charge', 'country', 'state','status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function scopeOfType($query, $type)
	{
		return $query->where('type', $type);
	}

	public function category()
    {
        return $this->belongsTo('App\Http\Models\Admin\Category', 'product_cat', 'id');
    }

    public function country_parent()
    {
        return $this->belongsTo('App\Http\Models\Countries', 'country', 'country_id');
    }

}
