<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
use Session;

class Wishlist extends Model{

	public $timestamps = false;

	/**
	 * get user's wishlist
	*/
	function getWishlist($user_id)
	{
		return DB::table('wishlist as w')->select('w.*',DB::raw('count(i.wishlist_id) as quantity'))->leftJoin('wishlist_items as i','i.wishlist_id','=','w.id')->where('user_id',$user_id)->groupBy('w.id')->orderBy('w.last_modified','desc')->get();
	}
	
	
	function wishlistDetails($wishlist_id)
	{
		return DB::table('wishlist as w')->select('w.*',DB::raw('count(i.wishlist_id) as quantity'))->leftJoin('wishlist_items as i','i.wishlist_id','=','w.id')->where('w.id',$wishlist_id)->groupBy('w.id')->first();
		//return DB::table('wishlist')->where('id',$wishlist_id)->first();
	}
	
	function wishlistItems($wishlist_id)
	{
		return DB::table('wishlist_items as w')->select('w.id as wishlist_item_id','c.id as color_id','w.priority','p.*','c.title as color_title','c.hex_code')->leftjoin('products as p','p.id','=','w.product_id')->leftjoin('product_to_color as pc','pc.id','=','w.color_id')->leftjoin('colors as c','c.id','=','pc.color_id')->where('w.wishlist_id',$wishlist_id)->get();
	}
	
	function renameWishlist($formData)
	{
		unset($formData['_token']);	
		
		return DB::table('wishlist')->where('id',$formData['wishlist_id'])->update(array('list_name' => $formData['list_name'],'last_modified' => date('Y-m-d H:i:s')));
	}
	
	
	
}