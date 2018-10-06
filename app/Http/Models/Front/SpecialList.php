<?php
namespace App\Http\Models\Front; // where this file exists

use Illuminate\Database\Eloquent\Model;
use DB; // used for queries like DB::table('table_name')->get();
use Session;

class SpecialList extends Model{

	public $timestamps = false;

	/**
	 * get user's events
	*/
	function getEvents($user_id,$sort_by)
	{
		$query = DB::table('special_events as e')->select('e.*',DB::raw('count(i.event_id) as quantity'))->leftJoin('special_events_items as i','i.event_id','=','e.id')->where('user_id',$user_id)->groupBy('e.id');
		
		if($sort_by == 'name')
			$query = $query->orderBy('e.event_type','asc');
		if($sort_by == 'date')
			$query = $query->orderBy('e.created','desc');
		if($sort_by == 'gifts')
			$query = $query->orderBy('quantity','desc');
		
		return $query->get();
		
		//return DB::table('special_events as e')->where('user_id',$user_id)->orderBy('e.last_modified','desc')->get();
	}
	
	
	function eventDetails($event_id)
	{
		return DB::table('special_events as e')->select('e.*',DB::raw('count(i.event_id) as quantity'))->leftJoin('special_events_items as i','i.event_id','=','e.id')->where('e.id',$event_id)->groupBy('e.id')->first();
		//return DB::table('wishlist')->where('id',$wishlist_id)->first();
	}
	
	function eventItems($event_id)
	{             
            $data=  DB::table('special_events_items as e')->select('e.id as event_item_id','e.event_id','e.would_love','e.still_need','e.color_id as product_to_color_id','c.id as color_id','p.id as product_id','p.*','c.title as color_title','c.hex_code')->leftjoin('products as p','p.id','=','e.product_id')->leftjoin('product_to_color as pc','pc.id','=','e.color_id')->leftjoin('colors as c','c.id','=','pc.color_id')->where('e.event_id',$event_id)->get();

            $array = array();
            $items = DB::table('special_events_items')
                      ->where('event_id',$event_id)
                     //->orderBy('id', 'desc')
                     ->get();
            foreach ($items as $item) {
              if($item->color_id == 99999999){
                $array[] =  DB::table('special_events_items as e')->select('e.id as event_item_id','e.event_id','e.would_love','e.still_need','e.color_id as product_to_color_id','c.id as color_id','p.id as product_id','p.*','c.title as color_title','c.hex_code')->leftjoin('products as p','p.id','=','e.product_id')->leftjoin('product_to_color as pc','pc.id','=','e.color_id')->leftjoin('colors as c','c.id','=','pc.color_id')->where('e.id',$item->id)->first();

                 // echo $items->color_id;
              }else{
                $array[] =  DB::table('special_events_items as e')->select('e.id as event_item_id','e.event_id','e.would_love','e.still_need','e.color_id as product_to_color_id','c.id as color_id','p.id as product_id','p.*','c.title as color_title','c.hex_code')->leftjoin('products as p','p.id','=','e.product_id')->leftjoin('product_to_color as pc','pc.id','=','e.color_id')->leftjoin('colors as c','c.id','=','pc.color_id')->where('e.id',$item->id)->first();
 
              }
            }
            return $array;
//                echo'<pre>';
//                print_r($array);
//                print_r($items);
//                print_r($data);
//                die;
            
        }
	
	function totalOrdered($product_id,$special_event_id,$product_to_color_id)
	{ 
            if($product_id==''){
                return 0;
            
            }else{
            if($product_to_color_id == ''){
                
      		$result = DB::select("select sum(otp.quantity) as total_order from order_to_product otp left join orders o ON o.id=otp.order_id where o.payment_status='Paid' AND otp.special_event_id=".$special_event_id." AND otp.product_id=".$product_id);
//echo 'fgfgfgfgfg'.$product_to_color_id;  echo'<pre>';
     //           print_r($result);die;
              //  echo $product_to_color_id.'dfdfdf';die;
            }else{
		$result = DB::select("select sum(otp.quantity) as total_order from order_to_product otp left join orders o ON o.id=otp.order_id where o.payment_status='Paid' AND otp.special_event_id=".$special_event_id." AND otp.product_id=".$product_id." AND otp.color_id =".$product_to_color_id);
            }		
	 //print_r($result);die;
         return $result[0]->total_order;
	}
        }
}