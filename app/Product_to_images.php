<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_to_images extends Model  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_to_images';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	//protected $fillable = ['name', 'email', 'password'];

	 public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
