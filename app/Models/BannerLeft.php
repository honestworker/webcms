<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class BannerLeft extends Model {

    /**
     * Generated
     */

    protected $table = 'banner_left';
    protected $fillable = ['id', 'title', 'banner', 'start_date', 'end_date', 'display_order', 'enlarge_banner', 'pdf_link', 'url', 'created', 'status', 'token', 'modified'];

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public static function getBannerImages($catId)
    {
    	if(empty($catId)){
    		return NULL;
    	}
    	$dt = Carbon::now()->format("Y-m-d");
    	$banners = self::join("banner_left_categories as bc", "bc.banner_id" , "=", "banner_left.id")
    	->where(["status" => 1, "category_id" => $catId])
    	->where("start_date", "<=", $dt)
    	->where("end_date", ">=", $dt)
    	->get();
    	return $banners;
    }

}
