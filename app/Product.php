<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	//protected $fillable = ['name', 'email', 'password'];

	 public function images()
    {
        return $this->hasMany('App\Product_to_images');
    }

}
