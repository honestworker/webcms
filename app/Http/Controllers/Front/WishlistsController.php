<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Front\Wishlist;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Request;

class WishlistsController extends Controller {
	private $data = array();
	//private $BrandModel = null;
	//private $CategoryModel = null;
	
	
	
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
		$this->WishlistModel = new Wishlist();	
		//$this->CategoryModel = new Category();	
	}

	function index()
	{
		return redirect('/dashboard');
	}
	
	function addToWishlist()
	{	
		//dd(Request::input());
		$formData = Request::input();
		array_pop($formData);
		
		$product_id = array_pop($formData);
		
		$color_id = 0;
		if(isset($formData['color_id']))
		{
			$color_id = $formData['color_id'];
			unset($formData['color_id']);
		}
		
		
		$user_id = Session::get('userId');
		$formData['user_id'] = $user_id;
		
		if($formData['list_name'] != '')
		{
			if(isset($formData['wishlist_id']))
				unset($formData['wishlist_id']);
				
			// set is default if first list
			$total_lists = DB::table('wishlist')->where('user_id',$user_id)->count();
			//echo $total_lists; exit;
			
			if($total_lists == 0)
				$formData['is_default'] = '1';
			else
				$formData['is_default'] = '0';
				
			$formData['createdate'] = date('Y-m-d H:i:s');
			$formData['last_modified'] = date('Y-m-d H:i:s');
			$formData['token'] = md5(time());
			
			DB::table('wishlist')->insert($formData);
			
			$lastInsertId = DB::getPdo()->lastInsertId();
			
			$wishlist_item_details['wishlist_id'][] = $lastInsertId;
		}
		else
		{
			$wishlist_item_details['wishlist_id'] = $formData['wishlist_id'];
		}
		
		foreach($wishlist_item_details['wishlist_id'] as $wishlist_id)
		{
			$wishlist_item_details['product_id'] = $product_id;
			$wishlist_item_details['color_id'] = $color_id;
			$wishlist_item_details['wishlist_id'] = $wishlist_id;	
			$wishlist_item_details['last_modified'] = date('Y-m-d H:i:s');
		
			DB::table('wishlist_items')->insert($wishlist_item_details);
		}
		
		$this->data['success'] = 'Added to wishlist.';
		return Redirect::back()->with('data',$this->data);	
		
	}	
	
	function wishlist()
	{
		$user_id = Session::get('userId');
		
		// get list of wishlist
		$this->data['list_wishlist'] = $this->WishlistModel->getWishlist($user_id);
		
		$this->data['page_title'] = 'My Wishlist';
		return view('front.wishlist.wishlist',$this->data);	
	}
	
	function getProductColors($product_id)
	{
		$result = DB::table('product_to_color as pc')->select('pc.*','c.hex_code','c.title')->leftjoin('colors as c','c.id','=','pc.color_id')->where('pc.product_id',$product_id)->get();
		
		if(count($result) > 0)
			return json_encode(array('success' => $result));
					
	}
	
	// add new list
	function addWishlist()
	{
		$formData = Request::input();
		
		$user_id = Session::get('userId');
		$formData['user_id'] = $user_id;
		
		unset($formData['_token']);
		
		if($formData['list_name'] != '')
		{			
			// set is default if first list
			$total_lists = DB::table('wishlist')->where('user_id',$user_id)->count();
						
			if($total_lists == 0)
			{
				$formData['is_default'] = '1';
			}
			else
			{	
				if(isset($formData['is_default']))
				{
					DB::table('wishlist')->where('user_id',$user_id)->update(array('is_default' => '0', 'last_modified' => date('Y-m-d H:i:s')));					
					$formData['is_default'] = '1';
				}
				else
					$formData['is_default'] = '0';		
			}
			
			$formData['createdate'] = date('Y-m-d H:i:s');
			$formData['last_modified'] = date('Y-m-d H:i:s');
			$formData['token'] = md5(time());
			
			DB::table('wishlist')->insert($formData);			
		}
		
		$this->data['success'] = 'Wishlist added successfully.';
		return Redirect::back()->with('data',$this->data);	
		
	}
	
	function deleteWishlist()
	{
		$formData = Request::input();
		unset($formData['_token']);
		
		// delete wishlist
		DB::table('wishlist')->where('id',$formData['delete_wishlist_id'])->delete();
		
		// delete wishlisted items
		DB::table('wishlist_items')->where('wishlist_id',$formData['delete_wishlist_id'])->delete();
		
		$this->data['success'] = 'Wishlist deleted successfully.';
		return Redirect::to('/wishlist')->with('data',$this->data);		
		
	}
	
	function wishlistDetails($wishlist_id)
	{
		$user_id = Session::get('userId');
		
		// get all wishlist
		$this->data['list_wishlist'] = $this->WishlistModel->getWishlist($user_id);
		
		// wishlist details
		$this->data['wishlist_details'] = $this->WishlistModel->wishlistDetails($wishlist_id);
		
		// wishlist items
		$this->data['wishlist_items'] = $this->WishlistModel->wishlistItems($wishlist_id);
		
		$this->data['page_title'] = 'My Wishlist';
		return view('front.wishlist.wishlist_details',$this->data);	
	}
	
	function renameWishlist()
	{		
		if($this->WishlistModel->renameWishlist(Request::input()))
			$this->data['success'] = 'Changes saved successfully.';
		else
			$this->data = '';
			
		return Redirect::back()->with('data',$this->data);	
	}
	
	function deleteWishlistItem()
	{
		$formData = Request::input();
		unset($formData['_token']);
		
		// delete wishlisted items
		DB::table('wishlist_items')->where('id',$formData['delete_wishlist_id'])->delete();
		
		$this->data['success'] = 'Product deleted successfully.';
		return Redirect::back()->with('data',$this->data);		
		
	}

	function moveToWishlist()
	{	
		//dd(Request::input());
		$formData = Request::input();
		array_pop($formData);
		
		$wishlist_item_id = $formData['wishlist_item_id'];
			unset($formData['wishlist_item_id']);
		
		$product_id = $formData['product_id'];
			unset($formData['product_id']);	
		
		//dd($formData);
		
		$user_id = Session::get('userId');
		$formData['user_id'] = $user_id;
		
		if($formData['list_name'] != '')
		{
			if(isset($formData['wishlist_id']))
				unset($formData['wishlist_id']);
				
			// set is default if first list
			$result = DB::table('wishlist_items')->where('id',$wishlist_item_id)->first();
			
			DB::table('wishlist_items')->where('id',$wishlist_item_id)->delete();
			//echo $total_lists; exit;
			
			$formData['is_default'] = '0';
			
			$formData['createdate'] = date('Y-m-d H:i:s');
			$formData['last_modified'] = date('Y-m-d H:i:s');
			$formData['token'] = md5(time());
			
			DB::table('wishlist')->insert($formData);
			
			$lastInsertId = DB::getPdo()->lastInsertId();
			
			$wishlist_item_details['wishlist_id'] = $lastInsertId;
			$wishlist_item_details['product_id'] = $result->product_id;
			$wishlist_item_details['color_id'] = $result->color_id;
			$wishlist_item_details['last_modified'] = date('Y-m-d H:i:s');
			
			DB::table('wishlist_items')->insert($wishlist_item_details);
			
		}
		else
		{
			//$wishlist_item_details['wishlist_id'] = $formData['wishlist_id'];
			
			// set is default if first list
			$result = DB::table('wishlist_items')->where('id',$wishlist_item_id)->first();
			
			DB::table('wishlist_items')->where('id',$wishlist_item_id)->delete();
			
			foreach($formData['wishlist_id'] as $wishlist_id)
			{
				$wishlist_item_details['wishlist_id'] = $wishlist_id;
				$wishlist_item_details['product_id'] = $result->product_id;
				$wishlist_item_details['color_id'] = $result->color_id;	
				$wishlist_item_details['last_modified'] = date('Y-m-d H:i:s');	
			
				DB::table('wishlist_items')->insert($wishlist_item_details);
			}
			
		}
		
		
		
		$this->data['success'] = 'Moved to wishlist.';
		return Redirect::back()->with('data',$this->data);	
		
	}
	
	function updateWishlistItemsPriority()
	{
		if(isset($_POST['priority']) && count($_POST['priority']) > 0)
		{		
			foreach($_POST['priority'] as $wishlist_item_id => $priority)
			{
				DB::table('wishlist_items')->where('id',$wishlist_item_id)->update(array('priority' => $priority, 'last_modified' => date('Y-m-d H:i:s')));	
			}
			
			echo json_encode(array('success' => 'success'));						
		}
	}
	
	function shareWishlist()
	{
		$formData = Request::input();
		unset($formData['_token']);
		
		if(count($formData['share_to_email']) > 0)
		{
			$sender_name = Session::get('userFirstName').' '.Session::get('userLastName');
			
			foreach($formData['share_to_email'] as $recipient_email)
			{
				$mail = $recipient_email;
				$to = $recipient_email;
				$to_name = $recipient_email;
				$from = 'shop@tbm.com.my';
				$from_name = 'SHOP TBM';
				$subject = "Please have a look at my wishlist on TBM.";
				
				if(!Session::get('userFirstName'))
				{
					$message = "Please click on the link below to see wishlist.<br/><br/>";	
				}
				else
				{
					$message = "This email is sent to you on behalf of ".$sender_name.".<br/><br/>";
					$message .= "Please click on the link below to see ".$sender_name." wishlist.<br/><br/>";
				}
				$message .= "<a href='".$formData['share_link_url']."'>".$formData['share_link_url']."</a>";
						
				$message .= "<br><br>Thank you<br>
				Best regards,<br>
				TBM Online Registration Manager<br>
				TAN BOON MING SDN BHD (494355-D)<br>
				PS 4,5,6 & 7, Taman Evergreen, Batu 4, Jalan Klang Lama, 58100 Kuala Lumpur.<br>
				Tel: (603) 7983-2020 (Hunting Lines)<br>
				Fax: (603) 7982-8141<br>
				info@tbm.com.my<br>
				Business Hours:<br>
				Mon. - Sat.: 9.30am - 9.00pm<br>
				Sun.: 10.00am - 9.00pm <br/>";
				
				$headers = "From:".$from . "\r\n" ;
				$headers .= "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				mail($to,$subject,$message,$headers);
			}
			
			$this->data['success'] = 'Wishlist shared successfully.';
			return Redirect::back()->with('data',$this->data);
		}
		else
		{			
			return Redirect::back();	
		}		
		
	}
	
	function viewWishlist()
	{
		$token = Input::get('token');
		$wishlist_id = DB::table('wishlist')->where('token',$token)->pluck('id');
		
		if($wishlist_id)
		{
			// wishlist details
			$this->data['wishlist_details'] = $this->WishlistModel->wishlistDetails($wishlist_id);
			
			// wishlist items
			$this->data['wishlist_items'] = $this->WishlistModel->wishlistItems($wishlist_id);
			
			$this->data['page_title'] = 'My Wishlist';
			return view('front.wishlist.shared_wishlist_details',$this->data);
		}
		else
		{
			$this->data['errors'][] = 'Wishlist not found.';
			return view('errors.404',$this->data);
			//return view('errors.404');
		}
	}
	
	/*function addWishlistItemToCart()
	{
		$formData = Request::input();
		
		unset($formData['_token']);	
		
		// get product prices
		$result = DB::table('products')->select('sale_price','list_price')->where('id',$formData['product_id'])->first();
		
		$cartData[] = 
	}*/
	
}
