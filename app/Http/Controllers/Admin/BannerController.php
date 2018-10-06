<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\User;
use App\Http\Models\Admin\Banner;

use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
//use App\Http\Requests\Request;
use Request;
use View;

class BannerController extends Controller {
  private $data = array();
	private $BannerModel = null;

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
		$this->middleware('auth');
		$this->BannerModel = new Banner();
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}



	public function topbanner()
   	{

		$post= $_POST;
		$file= $_FILES;
		 if(isset($post)||($file))
		 {

		$method=$post['method'];
		if($method=='addtopbannerform')
		 {

			if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title'          => 'required|max:255',
			'start_date'     => 'required',
			'end_date'       => 'required',
			'display_order'  => 'required|unique:banner_top',
			'banner'         => 'required|mimes:jpeg,gif,png,jpg',
			'enlarge_banner' => 'mimes:jpeg,gif,png,jpg',
			'pdf_link'       => 'mimes:pdf',
             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{
               $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/top', $imageName
					);
				}


	      $token = $post['_token'];

	      if(isset($post['title'])){$title = $post['title'];}else{$title='';}
	      if(isset($post['status'])){$status = $post['status'];}else{$status='';}



	      if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	      if(isset($post['end_date'])){$input2= $post['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));

	       }
	     else{$end_date='';}
	     if(isset($post['display_order'])){$display_order = $post['display_order'];}else{$display_order='';}
		 if(isset($post['url'])){$url = $post['url'];}else{$url='';}

		if(isset($post['heading_text_middle']))
			{
				$heading_text_middle = $post['heading_text_middle'];
			}else{
				$heading_text_middle='';
			}

		if(isset($post['heading_text_top_1']))
			{
				$heading_text_top_1 = $post['heading_text_top_1'];
			}else{
				$heading_text_top_1='';
			}
		if(isset($post['heading_text_top_2']))
			{
				$heading_text_top_2 = $post['heading_text_top_2'];
			}else{
				$heading_text_top_2='';
			}
		if(isset($post['link_text_left']))
			{
				$link_text_left = $post['link_text_left'];
				$link_text_left_value = array_search($link_text_left, config('defines.link_text_left') );
				if($link_text_left=='Others, please specify:'){
					if(isset($post['link_text_left_other'])){
						$link_text_left = $post['link_text_left_other'];
					}
				}

			}else{
				$link_text_left='';
				$link_text_left_value = 0;//none
			}
		if(isset($post['url_left']))
			{
				$url_left = $post['url_left'];
			}else{
				$url_left='';
			}
		if(isset($post['link_text_right']))
			{
				$link_text_right = $post['link_text_right'];
				$link_text_right_value = array_search($link_text_right, config('defines.link_text_right') );
				if($link_text_right=='Others, please specify:'){
					if(isset($post['link_text_right_other'])){
						$link_text_right = $post['link_text_right_other'];
					}
				}

			}else{
				$link_text_right='';
				$link_text_right_value = 0;//no
			}

		if(isset($post['url_right']))
			{
				$url_right = $post['url_right'];
			}else{
				$url_right='';
			}


		$banner =$imageName;

		$modified = date('Y-m-d H:i:s');
			$created = date('Y-m-d H:i:s');

		DB::table('banner_top')->insert(array(
									array(
										'status'                => $status,
										'token'                 => $token,
										'title'                 => $title,
										'banner'                => $banner,
										'start_date'            => $start_date,
										'end_date'              => $end_date,
										'display_order'         => $display_order,
										'heading_text_middle'   => $heading_text_middle,
										'heading_text_top_1'    => $heading_text_top_1,
										'heading_text_top_2'    => $heading_text_top_2,
										'link_text_left'        => $link_text_left,
										'link_text_left_value'  => $link_text_left_value,
										'url_left'              => $url_left,
										'link_text_right'       => $link_text_right,
										'link_text_right_value' => $link_text_right_value,
										'url_right'             => $url_right,
										'created'               => $created,
										'modified'              => $modified
									 )
									)
		);

		echo json_encode(array('success' => 'success'));
				exit;

			}
		}
         }
    }

	function updateTopBannerdata()
	{$post = $_POST;
		if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title'          => 'required|max:255',
			'start_date'     => 'required',
			'end_date'       => 'required',
			'display_order'  => 'required',
			'banner'         => ($post['bannername']!='') ? 'mimes:jpeg,gif,png,jpg' : 'required|mimes:jpeg,gif,png,jpg',
			'enlarge_banner' => 'mimes:jpeg,gif,png,jpg',
			'pdf_link'       => 'mimes:pdf',

             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

		$results = DB::table('banner_top')->where('id',$post['id'])->get();


			$id=$post['id'];

		 $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/top', $imageName
					);
				}


				$url_bann_data = null;
				if(isset($post['url']) && ($post['url']!=''))
				{
					$url_bann_data=$post['url'];
				}
				else
				{$url_bann_data = '';
	            }
             $data['title'] = $post['title'];
		     $data['banner']= (($imageName!=''||$imageName!=null)? $imageName : $post['bannername']);
		    if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

			       if(isset($post['end_date'])){$input2= $post['end_date'];
									$old_date2 =strtotime($input2);
		                            $end_date = date('Y-m-d H:i:s',($old_date2));}
			        else{$end_date='';}

			        if(isset($post['heading_text_middle']))
					{
						$heading_text_middle = $post['heading_text_middle'];
					}else{
						$heading_text_middle='';
					}

				if(isset($post['heading_text_top_1']))
					{
						$heading_text_top_1 = $post['heading_text_top_1'];
					}else{
						$heading_text_top_1='';
					}
				if(isset($post['heading_text_top_2']))
					{
						$heading_text_top_2 = $post['heading_text_top_2'];
					}else{
						$heading_text_top_2='';
					}
				if(isset($post['link_text_left']))
					{
						$link_text_left = $post['link_text_left'];
						$link_text_left_value = array_search($link_text_left, config('defines.link_text_left') );
						if($link_text_left=='Others, please specify:'){
							if(isset($post['link_text_left_other'])){
								$link_text_left = $post['link_text_left_other'];
							}
						}

					}else{
						$link_text_left='';
						$link_text_left_value= 0 ;//none
					}
				if(isset($post['url_left']))
					{
						$url_left = $post['url_left'];
					}else{
						$url_left='';
					}
				if(isset($post['link_text_right']))
					{
						$link_text_right = $post['link_text_right'];
						$link_text_right_value = array_search($link_text_right, config('defines.link_text_right') );
						if($link_text_right=='Others, please specify:'){
							if(isset($post['link_text_right_other'])){
								$link_text_right = $post['link_text_right_other'];
							}
						}

					}else{
						$link_text_right='';
						$link_text_right_value = 0 ; //none
					}

				if(isset($post['url_right']))
					{
						$url_right = $post['url_right'];
					}else{
						$url_right='';
					}



				$data['start_date']            = $start_date;
				$data['end_date']              = $end_date;
				$display_order                 = $post['display_order'];

				$data['heading_text_middle']   = $heading_text_middle;
				$data['heading_text_top_1']    = $heading_text_top_1;
				$data['heading_text_top_2']    = $heading_text_top_2;
				$data['link_text_left']        = $link_text_left;
				$data['link_text_left_value']  = $link_text_left_value;
				$data['url_left']              = $url_left;
				$data['link_text_right']       = $link_text_right;
				$data['link_text_right_value'] = $link_text_right_value;
				$data['url_right']             = $url_right;


		   /*displayorder start */
				$displayresults = DB::select('select id, display_order from banner_top where display_order= '.$display_order.' &&  id!='.$id);
				if(count($displayresults)>0)
				{
					echo json_encode(array('error' => 'Please fill unique display order Field..'));
				exit;
				}
				else
				{
					$data['display_order'] = $post['display_order'];
				}
            // $data['display_order'] = $post['display_order'];
			$data['status'] = (isset($post['status']) && $post['status'] == 'on') ? '1' : '';

			$data['modified'] = date('Y-m-d H:i:s');


            $data['url'] =$url_bann_data;
			DB::table('banner_top')->where('id', $post['id'])->update($data);

			echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('Banner has been edit successfully..');

	}
	}

	function deleteTopBannerdata()
	{
		$post= $_POST;

		$id= $post['id'];


		 DB::table('banner_top')->where('id',$id)->delete();

	     return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('Banner has been deleted successfully..');


	}


/**********************************************************************************************************************/
	/*middle top banner*/
	/*add middle top banner*/

	function middletopbanner()
	{/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		$post=$_POST;
		$file= $_FILES;

		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				'start_date' => 'required',
				'end_date' => 'required',
				'display_order' => 'required|unique:banner_middle_top',
				'banner' => 'required|mimes:jpeg,gif,png,jpg',
			    'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
			    'pdf_link'=> 'mimes:pdf',

			]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

				$this->BannerModel->addMiddleTopBanner(Request::input());

				echo json_encode(array('success' => 'success'));
				exit;
			}
		}

	}
	/*edit middle top banner*/

	function updateMiddleTopBanner()
	{

		$post = $_POST;
		if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title' => 'required|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			'display_order' => 'required',
			'banner' => 'mimes:jpeg,gif,png,jpg',
			'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
			'pdf_link'=> 'mimes:pdf',

             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{
		$results = DB::table('banner_middle_top')->where('id',$post['id'])->get();


			$id=$post['id'];

		 $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/middletop', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/middletop', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/middletop', $pdf_link_data
					);
				}

				$url_bann_data = null;
				if(isset($post['url']) && ($post['url']!=''))
				{
					$url_bann_data=$post['url'];
				}
				else
				{$url_bann_data = '';
	            }
             $data['title'] = $post['title'];
		     $data['banner']= (($imageName!=''||$imageName!=null)? $imageName : $post['bannername']);
		    if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	       if(isset($post['end_date'])){$input2= $post['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));}
	        else{$end_date='';}
             $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            /*displayorder start */
		$display_order= $post['display_order'];

				$displayresults = DB::select('select id, display_order from banner_middle_top where display_order= '.$display_order.' &&  id!='.$id);
				if(count($displayresults)>0)
				{
					echo json_encode(array('error' => 'Please fill unique display order Field..'));
				exit;
				}
				else
				{
					$data['display_order'] = $post['display_order'];
				}
            // $data['display_order'] = $post['display_order'];


			$data['status'] = (isset($post['status']) && $post['status'] == 'on') ? '1' : '';

			$data['modified'] = date('Y-m-d H:i:s');

			 $data['enlarge_banner']= (($enlargebannerdata!=''||$enlargebannerdata!=null)? $enlargebannerdata:$post['enlarge_bannername']);
			 $data['pdf_link']= (($pdf_link_data!=''||$pdf_link_data!=null)? $pdf_link_data:$post['pdf_linkname']);
             $data['url'] =$url_bann_data;
			DB::table('banner_middle_top')->where('id', $post['id'])->update($data);

			echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('Banner has been edit successfully..');
	}
	}



	function deleteMiddleTopBanner()
	{
		$post= $_POST;

		$id= $post['id'];


		 DB::table('banner_middle_top')->where('id',$id)->delete();

	     return Redirect::to('web88cms/index_middle_top_list')->withFlashMessage('Banner has been deleted successfully..');


	}

	/**********************************************************************************************************************/

	/*start middle bottom banner */

	function middlebottombanner()
	{/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		$post=$_POST;
		$file= $_FILES;

		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				'display_order' => 'required|unique:banner_middle_bottom',
				'start_date' => 'required',
			   	'end_date' => 'required',
			   	'banner' => 'required|mimes:jpeg,gif,png,jpg',
				'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
				'pdf_link'=> 'mimes:pdf',
			]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

				$this->BannerModel->addMiddleBottomBanner(Request::input());

				echo json_encode(array('success' => 'success'));
				exit;
			}
		}

	}



	function updateMiddleBottomBanner()
	{$post = $_POST;
	if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title' => 'required|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			'display_order' => 'required',
			'banner' => 'mimes:jpeg,gif,png,jpg',
			'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
			'pdf_link'=> 'mimes:pdf',

             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{
		$results = DB::table('banner_middle_bottom')->where('id',$post['id'])->get();


			$id=$post['id'];

		 $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/middlebottom', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/middlebottom', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/middlebottom', $pdf_link_data
					);
				}


             $data['title'] = $post['title'];
		     $data['banner']= (($imageName!=''||$imageName!=null)? $imageName : $post['bannername']);
		    if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	       if(isset($post['end_date'])){$input2= $post['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));}
	        else{$end_date='';}
             $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            /*displayorder start */
		$display_order= $post['display_order'];

				$displayresults = DB::select('select id, display_order from banner_middle_bottom where display_order= '.$display_order.' &&  id!='.$id);
				if(count($displayresults)>0)
				{
					echo json_encode(array('error' => 'Please fill unique display order Field..'));
				exit;
				}
				else
				{
					$data['display_order'] = $post['display_order'];
				}
            // $data['display_order'] = $post['display_order'];


			$data['status'] = (isset($post['status']) && $post['status'] == 'on') ? '1' : '';
			 /*test*/

			 $url_bann_data = null;
				if(isset($post['url']) && ($post['url']!=''))
				{
					$url_bann_data=$post['url'];
				}
				else
				{ $url_bann_data='';
				}
			 $data['enlarge_banner']= (($enlargebannerdata!=''||$enlargebannerdata!=null)? $enlargebannerdata:$post['enlarge_bannername']);
			$data['pdf_link']= (($pdf_link_data!=''||$pdf_link_data!=null)? $pdf_link_data:$post['pdf_linkname']);
             $data['url'] =$url_bann_data;

			 /*test*/

			$data['modified'] = date('Y-m-d H:i:s');

			DB::table('banner_middle_bottom')->where('id', $post['id'])->update($data);

			echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('web88cms/index_middle_bottom_list')->withFlashMessage('Banner has been edit successfully..');
	}
	}



	function deleteMiddleBottomBanner()
	{
		$post= $_POST;

		$id= $post['id'];


		 DB::table('banner_middle_bottom')->where('id',$id)->delete();

	     return Redirect::to('web88cms/index_middle_bottom_list')->withFlashMessage('Banner has been deleted successfully..');


	}
	/**********************************************************************************************************************/
	/*add left banner data*/

	function addLeftBanner()
	{/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		$post=$_POST;
		$file= $_FILES;

		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				//'display_order' => 'required|unique:banner_left',
				'start_date' => 'required',
			    'end_date' => 'required',
				'banner' => 'required|mimes:jpeg,gif,png,jpg',
				'categories' => 'required'
				//'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
				//'pdf_link'=> 'mimes:pdf', 

			]);
			 
			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

				$this->BannerModel->addLeftBanner(Request::input());

				echo json_encode(array('success' => 'success'));
				exit;
			}
		}

	}
	/*edit middle top banner*/

	function updateLeftBanner()
	{
		$post = $_POST;
		if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title' => 'required|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			//'display_order' => 'required',
			'banner' => 'mimes:jpeg,gif,png,jpg',
			//'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
			'//pdf_link'=> 'mimes:pdf',
			'categories' => 'required'
             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{
		$results = DB::table('banner_left')->where('id',$post['id'])->get();


			$id=$post['id'];

		 $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/left', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/left', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/left', $pdf_link_data
					);
				}


             $data['title'] = $post['title'];
		     $data['banner']= (($imageName!=''||$imageName!=null)? $imageName : $post['bannername']);
		    if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	        if(isset($post['end_date'])){$input2= $post['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));}
	        else{$end_date='';}
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
			/*displayorder start */
			/*$display_order= $post['display_order'];

			$displayresults = DB::select('select id, display_order from banner_left where display_order= '.$display_order.' &&  id!='.$id);
			if(count($displayresults)>0){
				echo json_encode(array('error' => 'Please fill unique display order Field..'));
				exit;
			}else{
				$data['display_order'] = $post['display_order'];
			}*/

            // $data['display_order'] = $post['display_order'];
            // $data['display_order'] = $post['display_order'];
			// $data['enlarge_banner']= (($enlargebannerdata!=''||$enlargebannerdata!=null)? $enlargebannerdata:$post['enlarge_bannername']);
			 //$data['pdf_link']= (($pdf_link_data!=''||$pdf_link_data!=null)? $pdf_link_data:$post['pdf_linkname']);
             //$data['url'] =$post['url'];

			$data['status'] = (isset($post['status']) && $post['status'] == 'on') ? '1' : '';

			$data['modified'] = date('Y-m-d H:i:s');
			 /*test*/

			 /*$url_bann_data = null;
				if(isset($post['url']) && ($post['url']!=''))
				{
					$url_bann_data=$post['url'];
				}
				else
				{ $url_bann_data='';
				}*/
			 //$data['enlarge_banner']= (($enlargebannerdata!=''||$enlargebannerdata!=null)? $enlargebannerdata:$post['enlarge_bannername']);
			//$data['pdf_link']= (($pdf_link_data!=''||$pdf_link_data!=null)? $pdf_link_data:$post['pdf_linkname']);
             //$data['url'] =$url_bann_data;

			 /*test*/

			DB::table('banner_left')->where('id', $post['id'])->update($data);

			/* Delete and add new categories */
			DB::table('banner_left_categories')->where('banner_id', $post['id'])->delete();
			if(!empty($post['categories'])){
				foreach ($post['categories'] as $categoryId) {
					DB::table('banner_left_categories')->insert(["banner_id" => $post['id'], "category_id" => $categoryId]);
				}
			}

			echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('Banner has been edit successfully..');
	}
	}




	function deleteLeftBanner()
	{
		$post= $_POST;

		$id= $post['id'];
		 DB::table('banner_left')->where('id',$id)->delete();

	     return Redirect::to('web88cms/left_banner_list')->withFlashMessage('Banner has been deleted successfully..');


	}

	/**********************************************************************************************************************/
	/*add left promotion banner data*/

	function addleftpromotionbanner()
	{/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		$post=$_POST;
		$file= $_FILES;

		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				'display_order' => 'required|unique:banner_left_promotion',
				'start_date' => 'required',
			    'end_date' => 'required',
				'banner' => 'required|mimes:jpeg,gif,png,jpg',
			    'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
			    'pdf_link'=> 'mimes:pdf',

			]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

				$this->BannerModel->addleftpromotionbanner(Request::input());

				echo json_encode(array('success' => 'success'));
				exit;
			}
		}

	}
	/*edit left promotionp banner*/

	function updateleftpromotionbanner()
	{$post = $_POST;
	if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title' => 'required|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			'display_order' => 'required',
			'banner' => 'mimes:jpeg,gif,png,jpg',
			'enlarge_banner'=> 'mimes:jpeg,gif,png,jpg',
			'pdf_link'=> 'mimes:pdf',

             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{
		$results = DB::table('banner_left_promotion')->where('id',$post['id'])->get();


			$id=$post['id'];

		 $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/leftpromotion', $imageName
					);
				}

				$enlargebannerdata = null;
				if(isset($_FILES['enlarge_banner']['name']) && $_FILES['enlarge_banner']['name']!='')
				{

					$enlargebannerdata = time().'_'.$_FILES['enlarge_banner']['name'];
					Request::file('enlarge_banner')->move(
						base_path() . '/public/admin/images/banner/leftpromotion', $enlargebannerdata
					);
				}

				$pdf_link_data = null;
				if(isset($_FILES['pdf_link']['name']) && $_FILES['pdf_link']['name']!='')
				{

					$pdf_link_data = time().'_'.$_FILES['pdf_link']['name'];
					Request::file('pdf_link')->move(
						base_path() . '/public/admin/images/banner/leftpromotion', $pdf_link_data
					);
				}


             $data['title'] = $post['title'];
			   if(isset($post['short_description'])){$short_description = $post['short_description'];}else{$short_description='';}
			   $data['short_description']= $short_description;

		     $data['banner']= (($imageName!=''||$imageName!=null)? $imageName : $post['bannername']);
		    if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	       if(isset($post['end_date'])){$input2= $post['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));}
	        else{$end_date='';}
             $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
			/*displayorder start */
		$display_order= $post['display_order'];

				$displayresults = DB::select('select id, display_order from banner_left_promotion where display_order= '.$display_order.' &&  id!='.$id);
				if(count($displayresults)>0)
				{
					echo json_encode(array('error' => 'Please fill unique display order Field..'));
				exit;
				}
				else
				{
					$data['display_order'] = $post['display_order'];
				}
            // $data['display_order'] = $post['display_order'];
            // $data['display_order'] = $post['display_order'];
			// $data['enlarge_banner']= (($enlargebannerdata!=''||$enlargebannerdata!=null)? $enlargebannerdata:$post['enlarge_bannername']);
			 //$data['pdf_link']= (($pdf_link_data!=''||$pdf_link_data!=null)? $pdf_link_data:$post['pdf_linkname']);
            // $data['url'] =$post['url'];

			$data['status'] = (isset($post['status']) && $post['status'] == 'on') ? '1' : '';
			 /*test*/

			/*test*/
			$url_bann_data = null;
				if(isset($post['url']) && ($post['url']!=''))
				{
					$url_bann_data=$post['url'];
				}
				else
				{ $url_bann_data='';
				}
			 $data['enlarge_banner']= (($enlargebannerdata!=''||$enlargebannerdata!=null)? $enlargebannerdata:$post['enlarge_bannername']);
			$data['pdf_link']= (($pdf_link_data!=''||$pdf_link_data!=null)? $pdf_link_data:$post['pdf_linkname']);
             $data['url'] =$url_bann_data;

			 /*test*/

			 /*test*/

			$data['modified'] = date('Y-m-d H:i:s');

			DB::table('banner_left_promotion')->where('id', $post['id'])->update($data);

			echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('web88cms/left_promotion_banner_list')->withFlashMessage('Banner has been edit successfully..');
	}
	}


	function deleteleftpromotionbanner()
	{
		$post= $_POST;

		$id= $post['id'];
		 DB::table('banner_left_promotion')->where('id',$id)->delete();

	     return Redirect::to('web88cms/left_promotion_banner_list')->withFlashMessage('Banner has been deleted successfully..');


	}


	/**********************************************************************************************************************/

	/*product banner list
	*/
	function addproductbanner()
	{/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		die;*/
		$post=$_POST;
		$file= $_FILES;

		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				'start_date' => 'required',
			    'end_date' => 'required',
				'banner' => 'required|mimes:jpeg,gif,png,jpg',

			]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{

				$this->BannerModel->addproductbannerlist(Request::input());

				echo json_encode(array('success' => 'success'));
				exit;
			}
		}

	}
	/*edit product banner list*/

	function updateproductbanner()
	{$post = $_POST;
	if(Request::isMethod('post'))

			$validator = Validator::make(Request::all(),[
			'title' => 'required|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			'banner' => 'mimes:jpeg,gif,png,jpg',



             ]);

			if ($validator->fails()) {
				$json['error'] = $validator->errors()->all();
				echo json_encode($json);
				exit;
			}else{
		$results = DB::table('product_banner_list')->where('id',$post['id'])->get();


			$id=$post['id'];

		 $imageName = null;
				if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
				{

					$imageName = time().'_'.$_FILES['banner']['name'];
					Request::file('banner')->move(
						base_path() . '/public/admin/images/banner/product', $imageName
					);
				}



             $data['title'] = $post['title'];
			  $data['category'] = $post['category'];
			  $data['tick'] = $post['tick'];

		     $data['banner']= (($imageName!=''||$imageName!=null)? $imageName : $post['bannername']);
		    if(isset($post['start_date'])){ $input= $post['start_date'];
							$old_date =strtotime($input);
                            $start_date = date('Y-m-d H:i:s',($old_date));}else{$start_date='';}

	       if(isset($post['end_date'])){$input2= $post['end_date'];
							$old_date2 =strtotime($input2);
                            $end_date = date('Y-m-d H:i:s',($old_date2));}
	        else{$end_date='';}
             $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;

			$data['status'] = (isset($post['status']) && $post['status'] == 'on') ? '1' : '';

			$data['modified'] = date('Y-m-d H:i:s');

			DB::table('product_banner_list')->where('id', $post['id'])->update($data);

			echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('web88cms/product_banner_list')->withFlashMessage('Banner has been edit successfully..');
	}
	}

	//xangvo
	function deleteSelectedBanners()
	{
		$brands = $this->BannerModel->deleteTopBanners($_POST['item_id']);
		Session::flash('flash_message', 'Banner has been deleted successfully..');
		$json['success'] = 'TRUE';
		return \Response::json($json);

	}


	function deleteproductbanner()
	{
		$post= $_POST;

		$id= $post['id'];
		 DB::table('product_banner_list')->where('id',$id)->delete();

	     return Redirect::to('web88cms/product_banner_list')->withFlashMessage('Banner has been deleted successfully..');


	}

	function deletemytopbanner()
	{
		if(Request::isMethod('post'))
		{


			$this->BannerModel->deleteTopbannerm(Request::input());

			return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('Banner(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All banner top all
	 */
	function deleteAll()
	{

		$this->BannerModel->deleteAlltopbannerdata();

		return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('All Banner has been deleted successfully..');
	}

	/*Delete selected bannermiddle top all*/
	function deleteselectedmiddletopbanner()
	{
		if(Request::isMethod('post'))
		{


			$this->BannerModel->deletemiddletop(Request::input());

			return Redirect::to('web88cms/index_middle_top_list')->withFlashMessage('Banner(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All banner middle top all
	 */
	function deleteAlltopmiddle()
	{

		$this->BannerModel->deleteAlltopmidlebannerdata();

		return Redirect::to('web88cms/index_middle_top_list')->withFlashMessage('All Banner has been deleted successfully..');
	}

	/*Delete selected bannermiddle bottom all*/
	function deleteselectedmiddlebottombanner()
	{
		if(Request::isMethod('post'))
		{


			$this->BannerModel->deletemiddlebottom(Request::input());

			return Redirect::to('web88cms/index_middle_bottom_list')->withFlashMessage('Banner(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All banner middle bottom all
	 */
	function deleteAllbottommiddle()
	{

		$this->BannerModel->deleteAllbottommidlebannerdata();

		return Redirect::to('web88cms/index_middle_bottom_list')->withFlashMessage('All Banner has been deleted successfully..');
	}

	/*Delete selected left banner  all*/
	function deleteselectedleftbanner()
	{
		if(Request::isMethod('post'))
		{
			$this->BannerModel->deleteleftselected(Request::input());
			return Redirect::to('web88cms/left_banner_list')->withFlashMessage('Banner(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All bannerleft all
	 */
	function deleteAllleft()
	{
		$this->BannerModel->deleteAllleftbannerdata();
		return Redirect::to('web88cms/left_banner_list')->withFlashMessage('All Banner has been deleted successfully..');
	}

	/*Delete selected left promotion banner  all*/
	function deleteselectedleftpromotionbanner()
	{
		if(Request::isMethod('post'))
		{
			$this->BannerModel->deleteleftpromotionselected(Request::input());
			return Redirect::to('web88cms/left_promotion_banner_list')->withFlashMessage('Banner(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All bannerleft promotion all
	 */
	function deleteAllleftpromotion()
	{
		$this->BannerModel->deleteAllleftpromotionbannerdata();
		return Redirect::to('web88cms/left_promotion_banner_list')->withFlashMessage('All Banner has been deleted successfully..');
	}

	/*Delete selected left promotion banner  all*/
	function deleteselectedproductbanner()
	{
		if(Request::isMethod('post')){
			$this->BannerModel->deleteproductselected(Request::input());
			return Redirect::to('web88cms/product_banner_list')->withFlashMessage('Banner(s) has been deleted successfully..');
		}
	}

	/**
	 * Delete All bannerleft promotion all
	 */
	function deleteAllproduct()
	{
		$this->BannerModel->deleteAllproductbannerdata();
		return Redirect::to('web88cms/product_banner_list')->withFlashMessage('All Banner has been deleted successfully..');
	}

	/*update display order*/
	function update_display_order_alltopbanner()
	{
		$postdata= $_POST;
		$data= array();

		if(Request::isMethod('post')){
			$flag = 'success';

			foreach($postdata['display_order'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from banner_top where display_order= '.$value.' &&  id!='.$key);

				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['display_order'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}


	  	if($flag == 'error')
		{
		    return Redirect::to('web88cms/index_banner_top_list')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			foreach($postdata['display_order'] as $key=>$value){
				$data['display_order'] = $value;

				DB::table('banner_top')
				  ->where('id', $key)
				  ->update($data);
			}
			$detaildata['success'] = 'Banner has been updated successfully.';
			$detaildata['data'] = $data;

			return Redirect::to('web88cms/index_banner_top_list')->withFlashMessage('Banner  display order has been changed successfully..');
		}
	}

	/*update display order*/
	function update_display_order_allmiddlebottombanner()
	{
		$postdata= $_POST;
		$data= array();

		if(Request::isMethod('post')){
			$flag = 'success';

			foreach($postdata['display_order'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from banner_middle_bottom where display_order= '.$value.' &&  id!='.$key);

				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['display_order'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}


	  	if($flag == 'error')
		{
		    return Redirect::to('web88cms/index_middle_bottom_list')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			foreach($postdata['display_order'] as $key=>$value){
				$data['display_order'] = $value;

				DB::table('banner_middle_bottom')
				  ->where('id', $key)
				  ->update($data);
			}
			$detaildata['success'] = 'Banner has been updated successfully.';
			$detaildata['data'] = $data;

			return Redirect::to('web88cms/index_middle_bottom_list')->withFlashMessage('Banner  display order has been changed successfully..');
		}
	}

	/*update display order*/
	function update_display_order_allmiddletopbanner()
	{
		$postdata= $_POST;
		$data= array();

		if(Request::isMethod('post')){
			$flag = 'success';

			foreach($postdata['myorder'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from banner_middle_top where display_order= '.$value.' &&  id!='.$key);

				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['myorder'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}


	  	if($flag == 'error')
		{
		    return Redirect::to('web88cms/index_middle_top_list')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			foreach($postdata['myorder'] as $key=>$value){
				$data['display_order'] = $value;

				DB::table('banner_middle_top')
				  ->where('id', $key)
				  ->update($data);
			}
			$detaildata['success'] = 'Banner has been updated successfully.';
			$detaildata['data'] = $data;

			return Redirect::to('web88cms/index_middle_top_list')->withFlashMessage('Banner  display order has been changed successfully..');
		}
	}

	/*update display order*/
	function update_display_order_all_left_banner()
	{
		$postdata= $_POST;
		$data= array();

		if(Request::isMethod('post')){
			$flag = 'success';

			foreach($postdata['mydisplayorder'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from banner_left where display_order= '.$value.' &&  id!='.$key);

				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['mydisplayorder'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}


	  	if($flag == 'error')
		{
		    return Redirect::to('web88cms/left_banner_list')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			foreach($postdata['mydisplayorder'] as $key=>$value){
				$data['display_order'] = $value;

				DB::table('banner_left')
				  ->where('id', $key)
				  ->update($data);
			}
			$detaildata['success'] = 'Banner has been updated successfully.';
			$detaildata['data'] = $data;

			return Redirect::to('web88cms/left_banner_list')->withFlashMessage('Banner  display order has been changed successfully..');
		}
	}

	/*update display order*/
	function update_display_order_all_left_promotion_banner()
	{
		$postdata= $_POST;
		$data= array();

		if(Request::isMethod('post')){
			$flag = 'success';

			foreach($postdata['display_order'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from banner_left_promotion where display_order= '.$value.' &&  id!='.$key);

				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['display_order'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}

	  	if($flag == 'error'){
		    return Redirect::to('web88cms/left_promotion_banner_list')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			foreach($postdata['display_order'] as $key=>$value){
				$data['display_order'] = $value;

				DB::table('banner_left_promotion')
				  ->where('id', $key)
				  ->update($data);
			}
			$detaildata['success'] = 'Banner has been updated successfully.';
			$detaildata['data'] = $data;

			return Redirect::to('web88cms/left_promotion_banner_list')->withFlashMessage('Banner  display order has been changed successfully..');
		}
	}

	/********************************************************************************************************************/
	function delete_enlargeimage_topbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['enl-banner'])&& $postdata['enl-banner']!='')
		{
			$results = DB::update("UPDATE banner_top SET enlarge_banner = '' WHERE id = '".$postdata['id']."' and enlarge_banner = '".$postdata['enl-banner']."' ");

		}//UPDATE banner_top SET enlarge_banner = '' WHERE id = 75 and enlarge_banner='1433843666_slide3.jpg';
		echo json_encode(array('success' => 'success'));
		exit;
	}


	function delete_enlargeimage_middletopbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['enl-banner'])&& $postdata['enl-banner']!='')
		{
			$results = DB::update("UPDATE banner_middle_top SET enlarge_banner = '' WHERE id = '".$postdata['id']."' and enlarge_banner = '".$postdata['enl-banner']."' ");
		}//UPDATE banner_top SET enlarge_banner = '' WHERE id = 75 and enlarge_banner='1433843666_slide3.jpg';
		echo json_encode(array('success' => 'success'));
		exit;
		//return Redirect::to('web88cms/index_middle_top_list')->withFlashMessage('Banner  enlarge image has been delete successfully');
	}


	function delete_enlargeimage_middlebottombanner()
	{
		$postdata= $_POST;
		if(isset($postdata['enl-banner'])&& $postdata['enl-banner']!='')
		{
			$results = DB::update("UPDATE banner_middle_bottom SET enlarge_banner = '' WHERE id = '".$postdata['id']."' and enlarge_banner = '".$postdata['enl-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}

	function delete_enlargeimage_leftbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['enl-banner'])&& $postdata['enl-banner']!='')
		{
			$results = DB::update("UPDATE banner_left SET enlarge_banner = '' WHERE id = '".$postdata['id']."' and enlarge_banner = '".$postdata['enl-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}

	function delete_enlargeimage_leftpromotionbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['enl-banner'])&& $postdata['enl-banner']!='')
		{
			$results = DB::update("UPDATE banner_left_promotion SET enlarge_banner = '' WHERE id = '".$postdata['id']."' and enlarge_banner = '".$postdata['enl-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}

	/***********************************************************************************************************************************/
	/***********************************************************************************************************************************/
	/***********************************************************************************************************************************/
	/***********************************************************************************************************************************/

    /*
    delete banner image via ajax POST
     */
	function delete_banner_image()
	{
		$postdata= $_POST;
		if(isset($postdata['id'])&& $postdata['id']!='')
		{
			//get image to delete image:
			$banner_name = \DB::table( 'banner_top' )
								->select(
									   	'banner_top.banner'
									)
								->where( 'id', $postdata['id'] )
								->get();
			if(!empty($banner_name)){
				$banner_name = $banner_name[0]->banner;
				@unlink(public_path().'/admin/images/banner/top/'.$banner_name);
			}

			$results = DB::update("UPDATE banner_top SET banner = '' WHERE id = '".$postdata['id']."' ");
		}
			echo json_encode(array('success' => 'success'));
			exit;
	}

	function delete_pdflink_middletopbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['pd-banner'])&& $postdata['pd-banner']!='')
		{
			$results = DB::update("UPDATE banner_middle_top SET pdf_link = '' WHERE id = '".$postdata['id']."' and pdf_link = '".$postdata['pd-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}

	function delete_pdflink_topbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['pd-banner'])&& $postdata['pd-banner']!='')
		{
			$results = DB::update("UPDATE banner_top SET pdf_link = '' WHERE id = '".$postdata['id']."' and pdf_link = '".$postdata['pd-banner']."' ");
		}
			echo json_encode(array('success' => 'success'));
			exit;
	}

	function delete_pdflink_middlebottombanner()
	{
		$postdata= $_POST;
		if(isset($postdata['pd-banner'])&& $postdata['pd-banner']!='')
		{
			$results = DB::update("UPDATE banner_middle_bottom SET pdf_link = '' WHERE id = '".$postdata['id']."' and pdf_link = '".$postdata['pd-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}

	function delete_pdflink_leftbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['pd-banner'])&& $postdata['pd-banner']!='')
		{
			$results = DB::update("UPDATE banner_left SET pdf_link = '' WHERE id = '".$postdata['id']."' and pdf_link = '".$postdata['pd-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}

	function delete_pdflink_leftpromotionbanner()
	{
		$postdata= $_POST;
		if(isset($postdata['pd-banner'])&& $postdata['pd-banner']!='')
		{
			$results = DB::update("UPDATE banner_left_promotion SET pdf_link = '' WHERE id = '".$postdata['id']."' and pdf_link = '".$postdata['pd-banner']."' ");
		}
		echo json_encode(array('success' => 'success'));
		exit;
	}


}
