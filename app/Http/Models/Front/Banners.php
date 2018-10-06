<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB;

class Banners extends Model{

	function getTopBanner()
	{
		$banner = array();
		$results = DB::select('SELECT * FROM banner_top WHERE( (DATE(DATE_ADD(NOW(), INTERVAL 0 HOUR)) between start_date and end_date) and(status=1)) ORDER BY display_order ASC');

		foreach($results as $result){
			$banner[] = array(
				'banner_id'             => $result->id,
				'title'                 => $result->title,
				'banner'                => $result->banner,
				'start_date'            => $result->start_date,
				'display_order'         => $result->display_order,
				'heading_text_middle'   => $result->heading_text_middle,
				'heading_text_top_1'    => $result->heading_text_top_1,
				'heading_text_top_2'    => $result->heading_text_top_2,
				'link_text_left'        => $result->link_text_left,
				'link_text_left_value'  => $result->link_text_left_value,
				'url_left'              => $result->url_left,
				'link_text_right'       => $result->link_text_right,
				'link_text_right_value' => $result->link_text_right_value,
				'url_right'             => $result->url_right,
				'status'                => $result->status,
			);
		}

		return $banner;
	}
	function getLeftBanner()
	{
		$banner = array();
		$results = DB::select('SELECT * FROM banner_left WHERE( (DATE(DATE_ADD(NOW(), INTERVAL 0 HOUR)) between start_date and end_date) and(status=1)) ORDER BY display_order ASC');
		//$results = DB::table('banner_left')->select('*', 'id as banner_id')->where('status', '=', '1')->orderBy('display_order', 'ASC')->get();
		//$banner_topdata= DB::table('banner_top')->select('*')->get();

		foreach($results as $result){
			$banner[] = array(
				'banner_id'=> $result->id,
				'title'=> $result->title,
				'banner'=> $result->banner,
				'start_date'=> $result->start_date,
				'display_order'=> $result->display_order,
				'enlarge_banner'=> $result->enlarge_banner,
				'pdf_link'=> $result->pdf_link,
				'url'=> $result->url,
				'status'=> $result->status,
			);
		}

		return $banner;
	}



	function getLatestPromoLeftBanner()
	{
		$banner = array();
		$results = DB::select('SELECT * FROM banner_left_promotion WHERE( (DATE(DATE_ADD(NOW(), INTERVAL 0 HOUR)) between start_date and end_date) and(status=1)) ORDER BY display_order ASC');
		//$results = DB::table('banner_left_promotion')->select('*', 'id as banner_id')->where('status', '=', '1')->orderBy('display_order', 'ASC')->get();
		//$banner_topdata= DB::table('banner_top')->select('*')->get();

		foreach($results as $result){
			$banner[] = array(
				'banner_id'=> $result->id,
				'title'=> $result->title,
				'short_description'=> $result->short_description,
				'banner'=> $result->banner,
				'start_date'=> $result->start_date,
				'display_order'=> $result->display_order,
				'enlarge_banner'=> $result->enlarge_banner,
				'pdf_link'=> $result->pdf_link,
				'url'=> $result->url,
				'status'=> $result->status,
			);
		}

		return $banner;
	}


	function getMiddleTopBanner()
	{
		$banner = array();
		$results = DB::select('SELECT * FROM banner_middle_top WHERE( (DATE(DATE_ADD(NOW(), INTERVAL 0 HOUR)) between start_date and end_date) and(status=1)) ORDER BY display_order ASC limit 0,2');

		//$results = DB::table('banner_middle_top')->select('*', 'id as banner_id')->where('status', '=', '1')->orderBy('display_order', 'ASC')->get();
		//$banner_topdata= DB::table('banner_top')->select('*')->get();

		foreach($results as $result){
			$banner[] = array(
				'banner_id'=> $result->id,
				'title'=> $result->title,
				'banner'=> $result->banner,
				'start_date'=> $result->start_date,
				'display_order'=> $result->display_order,
				'enlarge_banner'=> $result->enlarge_banner,
				'pdf_link'=> $result->pdf_link,
				'url'=> $result->url,
				'status'=> $result->status,
			);
		}

		return $banner;
	}


	function getMidlleBottomBanner()
	{
		$banner = array();
		$results = DB::select('SELECT * FROM banner_middle_bottom WHERE( (DATE(DATE_ADD(NOW(), INTERVAL 0 HOUR)) between start_date and end_date) and(status=1)) ORDER BY RAND(), display_order ASC limit 0,1');

		//$results = DB::table('banner_middle_bottom')->select('*', 'id as banner_id')->where('status', '=', '1')->orderBy('display_order', 'ASC')->take(1)->get();
		//$banner_topdata= DB::table('banner_top')->select('*')->get();

		foreach($results as $result){
			$banner[] = array(
				'banner_id'=> $result->id,
				'title'=> $result->title,
				'banner'=> $result->banner,
				'start_date'=> $result->start_date,
				'display_order'=> $result->display_order,
				'enlarge_banner'=> $result->enlarge_banner,
				'pdf_link'=> $result->pdf_link,
				'url'=> $result->url,
				'status'=> $result->status,
			);
		}

		return $banner;
	}






}

?>
