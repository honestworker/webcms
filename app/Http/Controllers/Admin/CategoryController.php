<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Product;
use App\Http\Models\Admin\Category;
use App\Http\Models\Admin\Brand;
use Session;
use Input;
use Illuminate\Http\RedirectResponse;
use Auth;
use Validator;
use Hash;
use DB;
use Redirect;
use Response;
use Request;
use View;

class CategoryController extends Controller {
	private $data = array();
	private $CategoryModel = null;
	private $Brand = null;
	private $ProductModel = null;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->ProductModel = new Product();
		$category=$this->CategoryModel = new Category();
		$this->BrandModel = new Brand();
	}

	function index()
	{
		return redirect('web88cms/dashboard');
	}
	
	function listCategories(){
		$categories = $this->CategoryModel->getCategories();
		$categoriesHtml = $this->CategoryModel->createTreeHtml($categories);
		
		$this->data['success'] = Session::get('category.success');
		Session::forget('category.success');
		$this->data['warning'] = Session::get('category.warning');
		Session::forget('category.warning');
		
		$this->data['categories'] = $categories;
		$this->data['categoriesHtml'] = $categoriesHtml;
		
		// get last updated
		$this->data['last_modified'] = DB::table('categories')->orderBy('modifydate','desc')->pluck('modifydate');
		$this->data['page_title'] = 'Categories:: Listing';
		
		return view('admin.category.category_list', $this->data);
	}
	
	public function listAjax(){
		$data = Request::input();
		if(isset($data['new_order']) && is_array($data['new_order'])){
			$this->CategoryModel->updateCategoriesOrder($data['new_order']);
		}		
	}
	
	public function editCategory($category_id){
		$json = array();

		if(Request::isMethod('post') && $category_id)
		{
		
			$validator = Validator::make( Request::all(),[
					'title' => 'required',
				]
			);                
		
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
			}
			else
			{
				$this->CategoryModel->editCategoriesOrder($category_id, Request::input());
				$json['success'] = 'Category has been updated successfully.';
			}   
		}
		
		echo json_encode($json);exit;
	}
	
	public function copyCategory($category_id){
		if($this->CategoryModel->copyCategory($category_id)){
			Session::put('category.success', 'Category copy successfully.');
		}
		else{
			Session::put('category.warning', 'Unable to copy category!');
		}
		return redirect('web88cms/categories/list');
	}
	
	public function deleteCategory($category_id){
		$this->CategoryModel->deleteCategory($category_id);
		Session::put('category.success', 'Category deleted successfully.');

		return redirect('web88cms/categories/list');
	}
	
	public function uploadMenuImage($category_id){
		$json = array();
		
		$fields['image'] = 'required|image|max:1000';
		
		if(isset($_FILES['image2']) && !$_FILES['image2']['error']){
			$fields['image2'] = 'image|max:1000';
		}
		
		$validator = Validator::make( Request::all(), $fields);                
	
		if ($validator->fails()) {  
			$json['error'] = $validator->errors()->all(); 
		}
		else
		{
			//Upload image
			$imageName1 = Request::file('image')->getClientOriginalName();
			$imageName1 = time(). str_replace(' ', '-', $imageName1);
			
			Request::file('image')->move(
				base_path() . '/public/images/category/', $imageName1
			);
			
			$imageName2 = '';
			
			if(isset($_FILES['image2']) && !$_FILES['image2']['error']){
				$imageName2 = Request::file('image2')->getClientOriginalName();
				$imageName2 = time(). str_replace(' ', '-', $imageName2);
				
				Request::file('image2')->move(
					base_path() . '/public/images/category/', $imageName2
				);
			}
			//End
			$data['image'] = $imageName1;
			$data['alt_text'] = Request::input('alt_text');
			$data['image2'] = $imageName2;
			$data['alt_text2'] = Request::input('alt_text2');
			
			$this->CategoryModel->updateCategoryImags($category_id, $data);
			$json['success'] = 'Category has been updated successfully.';
			$json['data'] = $data;
		}
		
		return Response::json($json);
	}
	
	public function homeList($limit = 10){
		$this->data['success'] = Session::get('category.success');
		Session::forget('category.success');
		$this->data['warning'] = Session::get('category.warning');
		Session::forget('category.warning');
		
		$page = 0;		
		if(Input::get('page')){
			$page = Input::get('page');
		}
		
		$this->data['paginate_msg'] = $this->CategoryModel->get_paginate_msg($limit, $page);
		
		$this->data['categories'] = $this->CategoryModel->getHomeCategories($limit);
		$this->data['categoryTabs'] = $this->CategoryModel->getHomeCategoryTabs();

		// get last updated
		$this->data['last_modified'] = DB::table('categories_home')->orderBy('modifydate','desc')->pluck('modifydate');
		$this->data['limit'] = $limit;
		$this->data['page_title'] = 'Home Cateogories:: Listing';
		
		return view('admin.category.home_category', $this->data);
	}
	/****************************************************************************************/
	/*home list category start here*/
	public function categoryhomelist()
	{	
		
		
		$data['catagroyhomelistviewdata'] = $catdata = $this->CategoryModel->getcatagroyhomelistviewdata();
		
		
		$data['hometabslistviewdata']=  $this->CategoryModel->gettabhomelistviewdata();
		
		
		$data['alldatawithtab'] = $this->CategoryModel->getalldataforedithavingtab();
		
		$data['tabs'] = array();
		foreach($data['catagroyhomelistviewdata'] as $catagroyhomelistviewdata){
			$tabs = db::select("SELECT * FROM category_home_list_tablisting where category_id='".$catagroyhomelistviewdata->id."'");
			if(count($tabs)){
				foreach($tabs as $tab){
					$data['tabs'][$catagroyhomelistviewdata->id][$tab->id] = $tab;		
				}
			}else{
				if($catagroyhomelistviewdata->enable_tab==1){
					$data['tabs'][$catagroyhomelistviewdata->id] = 'No Tab';
				}else{
					$data['tabs'][$catagroyhomelistviewdata->id] = '';
				}
			}
		}
		
		 $data['last_modified'] = DB::table('category_home_list')->orderBy('modified','desc')->pluck('modified');		
		return view('admin.category.category_home_list', $data);
    }
	
	public function categoryhomelisttabajax()
	{
		$data['hometabslistviewdata'] = DB::select("SELECT * FROM category_home_list_tablisting WHERE category_id=0");
		echo '<table class="table table-hover table-striped">
              	<thead>
                	<tr>
                    	<th width="1%"><input type="checkbox" id="select_items2" name="select_items2"/></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th width="12%">Display Order</th>
                        <th>Action</th>
                    </tr></thead>';
          
		$j=0;
		foreach($data['hometabslistviewdata'] as $details2){
			$status_class2 = ($details2->status == '1') ? 'label-success' : 'label-red';
			$status2 = ($details2->status == '1')? 'Active' : 'In-active';
			
            echo '<tr>
            	<td><input type="checkbox" value="'.$details2->id.'" onclick="selectForDelete2();" class="select_items2"/></td>
                <td>'.++$j.'</td>
                <td><span class="label label-sm '.$status_class2.'" id="tabs-home-list-status-'.$details2->id.'">'.$status2.'</span></td>
                <td>'.$details2->title.'</td>
               	<td>
                   	<input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, '.$j.');document.getElementById(\'displayorder_'.$details2->id.'\').value=this.value" class="form-control displayord" value="'.$details2->display_order.'">
                 </td>
                 <td><!--<a href="category_home_products_list?tabid='.$details2->id.'&homecatid=0" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>--> <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab-'.$details2->id.'" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                     <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-'.$details2->id.'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <div id="modal-edit-tab-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog modal-wide-width">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\'); $(\'#modal-edit-tab-'.$details2->id.'\').modal(\'hide\')" class="close">&times;</button>
                                              <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form">
                                                <form class="form-horizontal" name="edittablisthome-'.$details2->id.'" id="edittablisthome-'.$details2->id.'" method="post" action="category_home_list/edittablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="tabhome_id" value="'.$details2->id.'" />
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-6">
                                                      <div data-on="success" data-off="primary" class="make-switch">';
                                                       
														if($details2->status=='1'){ $check2='checked="checked"';}else { $check2='';}
                                                        
														echo '<input id="status" type="checkbox" name="status"  '.$check2.' value="1"  />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Title</label>
                                                    <div class="col-md-6">
                                                      <input name="title" id="title" type="text" class="form-control" placeholder="" value="'.$details2->title.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Display Order</label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="display_order" id="display_order"'.$details2->id.'"" class="form-control" placeholder="" value="'.$details2->display_order.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                    <a  onClick="edithometablsitdata('.$details2->id.');" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$(\'.form-horizontal\').trigger(\'reset\'); $(\'#modal-edit-tab-'.$details2->id.'\').modal(\'hide\')" href="#" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                  </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="modal-delete-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\'); $(\'#modal-delete-'.$details2->id.'\').modal(\'hide\');" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>#'.$j.':</strong> '.$details2->title.'</p>
                                              <div class="form-actions">
                                                <form  name="deleteform2" id="deleteform2-'.$details2->id.'" method="post" action="category_home_list/deletetablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="cathome_id" value="'.$details2->id.'" />
                                                  <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="deletehometablsitdata('.$details2->id.')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" onclick="$(\'#modal-delete-'.$details2->id.'\').modal(\'hide\')" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  </tr>
                               ';
        }
         echo '<tfoot>
               	<tr>
                	<td colspan="6"></td>
                </tr>
               </tfoot>
            </table>';
    }
	
	public function deleteTabsWithNoCategory()
	{	
		DB::delete("DELETE FROM category_home_list_tablisting WHERE category_id=0");
    }
	
	public function categoryhomelistpostdata()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'cat_title' => 'required',
			]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->CategoryModel->addcategoryhomelist(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
		return view('admin.category.category_home_list');
	}
	public function tablistinghomelistpostdata()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		$category_id= '0';
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				//'display_order' => 'required|unique:category_home_list_tablisting,category_id',
				'display_order' => 'required|unique:category_home_list_tablisting',
				//unique:table,column,except,idColumn
				//unique:articles,url,'.$this->articles->id
			]);
			
			$data=db::select("SELECT display_order FROM category_home_list_tablisting WHERE category_id=0 and display_order='".$_POST['display_order']."'");
			
			if ($validator->fails() &&count($data)>0) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->CategoryModel->addtablistingcategoryhomelist(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
		return view('admin.category.category_home_list');
	}
	function deletecategoryhomelistpostdata()
	{
		$formData=$_POST;
		
		/*echo "<pre>";
		print_r($formData);
		die;*/
		DB::table('category_home_list')->whereIn('id',explode(',',$formData['id']))->delete();
		DB::table('category_home_addtabproductsdata')->whereIn('homecatid',explode(',',$formData['id']))->delete();
		if($formData['enable_tab']==1){
		DB::select("delete  FROM `category_home_addtabproductsdata` WHERE tabid!='0' and homecatid='0' ");
		DB::select("delete  FROM `category_home_list_tablisting` WHERE category_id=".$formData['id']);
		
		}
		return Redirect::to('/web88cms/categories/category_home_list/')->withFlashMessage('category list(s) has been deleted successfully..');
	}
	function editcategoryhomelistpostdata()
	{
		$post = $_POST;
		if(Request::isMethod('post'))
		
			$validator = Validator::make(Request::all(),[
			'cat_title' => 'required',
             ]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
		
		$results = DB::table('category_home_list')->where('id',$post['id'])->get();
		$data['status'] = (isset($post['status']) && $post['status'] == '1') ? '1' : '';	
		$data['cat_title'] = $post['cat_title'];	
			
			$data['modified'] = date('Y-m-d H:i:s');
			 DB::table('category_home_list')->where('id', $post['id'])->update($data);
			
			echo json_encode(array('success' => 'success'));
				exit;

			}
	}
	
	function deleteselectcategorydata()
	{
		
	/*	echo "<pre>";
		print_r($_POST);
		die;*/
		$post= $_POST;

		$id= $post['id'];
		DB::table('category_home_list')->whereIn('id',explode(',',$post['id']))->delete();
		DB::table('category_home_addtabproductsdata')->whereIn('homecatid',explode(',',$post['id']))->delete();
		 
		
		
	     return Redirect::to('web88cms/categories/category_home_list/')->withFlashMessage('category home list has been deleted successfully..');
	
	
	}
	function deleteAlltopmiddle()
	{
		
		DB::table('category_home_list')->delete();
		
		//DB::table('category_home_addtabproductsdata')->delete();
		Db::select('delete FROM category_home_addtabproductsdata');
				
		return Redirect::to('web88cms/categories/category_home_list/')->withFlashMessage('All category home list has been deleted successfully..');
	}
	function edittablisthomedatamain()
	{
		$post = $_POST;
		if(Request::isMethod('post'))
		
			$validator = Validator::make(Request::all(),[
			'title' => 'required',
			'display_order' => 'required|unique:category_home_list_tablisting',
			//'display_order' => 'required',
             ]);
			
			$data=db::select("SELECT display_order FROM category_home_list_tablisting WHERE category_id='".$_POST['category_id']."' and display_order='".$_POST['display_order']."'and id!='".$_POST['id']."'");
			
			if ($validator->fails() && count($data)>0) { 
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
		
		$results = DB::table('category_home_list_tablisting')->where('id',$post['id'])->get();
		$data['status'] = (isset($post['status']) && $post['status'] == '1') ? '1' : '';	
		$data['title'] = $post['title'];
		$data['display_order'] = $post['display_order'];	
			
			$data['modified'] = date('Y-m-d H:i:s');
			 DB::table('category_home_list_tablisting')->where('id', $post['id'])->update($data);
			
			echo json_encode(array('success' => 'success'));
				exit;

			}
	}
	
	function deletetabhomelistpostdata()
	{
		$formData=$_POST;
		DB::table('category_home_list_tablisting')->whereIn('id',explode(',',$formData['id']))->delete();
		
		echo json_encode(array('success' => 'success'));
				exit;
		//return Redirect::to('/web88cms/categories/category_home_list/')->withFlashMessage('category list(s) has been deleted successfully..');
		
	}
	function deleteselecttabdata()
	{
		
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		$post= $_POST;

		$id= $post['id'];
		DB::table('category_home_list_tablisting')->whereIn('id',explode(',',$post['id']))->delete();
		echo json_encode(array('success' => 'success'));
				exit;
		
		 
		
		
	    // return Redirect::to('web88cms/categories/category_home_list/')->withFlashMessage('category home list has been deleted successfully..');
	
	
	}
	function deleteAlltabhomedata()
	{
		
		DB::table('category_home_list_tablisting')->where('category_id',0)->delete();
		echo json_encode(array('success' => 'success'));
				exit;		
		//return Redirect::to('web88cms/categories/category_home_list/')->withFlashMessage('All category home list has been deleted successfully..');
	}

	
	/*update display order*/
	
	function update_display_order_all_tab_cat_home()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		$postdata= $_POST;
		$data= array();
		
		
		if(Request::isMethod('post')){
			$flag = 'success';
		if(isset($postdata['display_order'])&&$postdata['display_order']!='')
		{
			foreach($postdata['display_order'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from category_home_list_tablisting where display_order= '.$value.' &&  id!='.$key);
	
				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['display_order'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}}
		
	  
	  	if($flag == 'error')
		{
		    echo json_encode(array('error' => 'error'));
				exit;
			//return Redirect::to('web88cms/categories/category_home_list/')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			if(isset($postdata['display_order'])&&$postdata['display_order']!='')
		{
			foreach($postdata['display_order'] as $key=>$value){ 
				$data['display_order'] = $value;
				
				DB::table('category_home_list_tablisting')
				  ->where('id', $key)
				  ->update($data);
			}}
			$detaildata['success'] = 'Tab list order has been updated successfully.';
			$detaildata['data'] = $data;
			
			echo json_encode(array('success' => 'success'));
				exit;		
			//return Redirect::to('web88cms/categories/category_home_list')->withFlashMessage('Tab display order has been changed successfully..');
		}
	}
	
	function editdataupdate_display_order_all_tab_cat_home()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		$postdata= $_POST;
		$data= array();
		
		
		if(Request::isMethod('post')){
			$flag = 'success';
		if(isset($postdata['display_order'])&&$postdata['display_order']!='')
		{
			foreach($postdata['display_order'] as $key=>$value){
				//// Check display order already exist in db
				$results = DB::select('select id, display_order from category_home_list_tablisting where display_order= '.$value.' &&  id!='.$key);
	
				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					if($value == $postdata['display_order'][$results[0]->id]){
						$flag = 'error';
						break;
					}
				}
			}
		}}
		
	  
	  	if($flag == 'error')
		{
		    echo json_encode(array('error' => 'error'));
				exit;
			//return Redirect::to('web88cms/categories/category_home_list/')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			if(isset($postdata['display_order'])&&$postdata['display_order']!='')
		{
			foreach($postdata['display_order'] as $key=>$value){ 
				$data['display_order'] = $value;
				
				DB::table('category_home_list_tablisting')
				  ->where('id', $key)
				  ->update($data);
			}}
			$detaildata['success'] = 'Tab list order has been updated successfully.';
			$detaildata['data'] = $data;
			
			echo json_encode(array('success' => 'success'));
				exit;		
			//return Redirect::to('web88cms/categories/category_home_list')->withFlashMessage('Tab display order has been changed successfully..');
		}
	}
/******************************************************************************************************/	
	
	
		
/*********************************************************************************************************/	
	
/*********************************************************************************************************/	
	
/*********************************************************************************************************/	
	
/*homeproduct list start from here*/
	
	public function categoryhomeproductslist()
	{
		// get last updated
		// response variable is set when item is deleted
	    $tabid=Request::get('tabid');
		$homecatid=Request::get('homecatid');
		if((isset($_GET['rec'])&&$_GET['rec']!='')){
			$this->data['num_rec_per_page'] = $num_rec_per_page = $_GET['rec'];
		}else{
			$this->data['num_rec_per_page'] = $num_rec_per_page = 10;
		}
		
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
        
		$start_from = ($page-1) * $num_rec_per_page; 
		$pagedata = DB::table('category_home_addtabproductsdata')->where('tabid',$tabid)->where('homecatid',$homecatid);
		$total_records = $pagedata->count();
		$this->data['total_pages'] = ceil($total_records / $num_rec_per_page); 
        $this->data['start_from']=$start_from  =(($page-1) * ($num_rec_per_page));
			
	    
		/*Showing 3 to 4 of 8 entries*/
		if(Request::get('brand_id')||Request::get('product_name')||Request::get('product_code')||Request::get('price_from')||Request::get('price_to')){
			$formData=Input::get();
		  	$totaldata=$this->data['listselectedproducts'] = $this->CategoryModel->search_list_selected_producted($start_from, $num_rec_per_page,$formData,$tabid,$homecatid);
		$total_records1 = count($totaldata);
		$total_pages=$this->data['total_pages'] = ceil($total_records1 / $num_rec_per_page); 
        $this->data['start_from']=$start_from  =(($total_pages-1) * ($num_rec_per_page));
		$page_to = (($page * $num_rec_per_page) > $total_records1) ? $total_records1 : ($page * $num_rec_per_page);
				
		if($page_to==0){
			$this->data['msg'] = 'Showing '. $page_to .' to '. $page_to .' of '. $total_records1 .' entries';
		}else{ 
			$this->data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records1 .' entries';
		}
		
		}else{  
			$totaldata=$this->data['listselectedproducts'] = $this->CategoryModel->list_selected_producted($start_from, $num_rec_per_page,$tabid,$homecatid);
		
		$page_to = (($page * $num_rec_per_page) > $total_records) ? $total_records : ($page * $num_rec_per_page);
				
		if($page_to==0){
			$this->data['msg'] = 'Showing '. $page_to .' to '. $page_to .' of '. $total_records .' entries';
		}else{ 
			$this->data['msg'] = 'Showing '. ((($page-1) * $num_rec_per_page) + 1) .' to '. $page_to .' of '. $total_records .' entries';
		}
		}
		      
		
		/*Showing 3 to 4 of 8 entries end*/
	
	    $this->data['products'] = $this->CategoryModel->getProductsforcategory_homeproduct();
		$this->data['success'] = Session::get('response');
		Session::forget('response');
		
		//$this->data['products'] = $this->CategoryModel->getProductsforcategory_homeproduct();
		
		//$this->data['last_modified'] = DB::table('products')->orderBy('last_modified','desc')->pluck('last_modified');
		if(isset($_GET['category_id']))
		{
		$category_id=$_GET['category_id'];
		}
		
		if(isset($_GET['homecatid']))
		{
		$homecatid=$_GET['homecatid'];
		}
		
		if(isset($_GET['tabid']))
		{
		$tabid=$_GET['tabid'];
		if($tabid==0)
		{
			$this->data['last_modified'] = DB::table('category_home_addtabproductsdata')->where('homecatid',$homecatid)->where('tabid',$tabid)->orderBy('modified','desc')->pluck('modified');
		}
		else
		{
		$this->data['last_modified'] = DB::table('category_home_addtabproductsdata')->where('category_id',$category_id)->where('homecatid',$homecatid)->where('tabid',$tabid)->orderBy('modified','desc')->pluck('modified');
		
		}
		$this->data['categories'] = $this->CategoryModel->getSelectedCategoriesTree(array(Input::get('product_category_id')));	
		$this->data['brands'] = $this->BrandModel->getActiveBrands();
		return view('admin.category.category_home_products_list', $this->data);
    }
	
	}
	
	function addtabproductsdata()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		
		$postdata=$_POST;
		$productid=$postdata['productid'][0];
		$productsid = explode(",", $productid);
		$tabid=$postdata['tabid'];
		$homecatid=$postdata['homecatid'];
		$category_id=$postdata['category_id'];
		$modified = date('Y-m-d H:i:s');
		$created = date('Y-m-d H:i:s');
		
		 DB::table('category_home_addtabproductsdata')->where('tabid',$tabid)->where('homecatid',$homecatid)->delete();
		foreach ($productsid as $product_id)
		{
			 $data["productid"]= $product_id;
			$data["modified"]= $modified;
			$data["created"]= $created;
			$data["tabid"]= $tabid;
			$data["homecatid"]= $homecatid;
			$data["category_id"]= $category_id;
			DB::table('category_home_addtabproductsdata')->insert($data);
			
		}
		echo json_encode(array('success' => 'success'));
				exit; 
				
		
		//return Redirect::to('web88cms/categories/category_home_products_list')->withInput()->with('success','Tab display order has been changed successfully..');
	}
	/*update display order*/
	function update_display_order_allategory_home_products_list()
	{
		
		/*echo "<pre>";
		print_r($_POST);
		die;*/ 
		
		$postdata= $_POST;
		$tabid=$postdata['tabid'];
		$homecatid=$postdata['homecatid'];
		$category_id=$postdata['category_id'];
		$data= array();
		
		if(Request::isMethod('post')){
			$flag = 'success';
		
			foreach($postdata['myorder'] as $key=>$value){
				
				//// Check display order already exist in db
				$results = DB::select('select productid, display_order from category_home_addtabproductsdata where display_order= '.$value.'&&productid!='.$key. '&& tabid= '.$tabid. '&& homecatid= '.$homecatid);

	
				if(count($results)>0)
				{
					//// Check founded duplicate display order also change in current action yes/no
					//if($value == $postdata['myorder'][$results[0]->productid]){
						if($value == isset($postdata['myorder'][$results[0]->productid])?($postdata['myorder'][$results[0]->productid]): 0){
						$flag = 'error';
						break;
					}
				}
			}
		}
		
	  
	  	if($flag == 'error')
		{
		    return Redirect::to('web88cms/categories/category_home_products_list?tabid='.$tabid.'&homecatid='.$homecatid.'&category_id='.$category_id)->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			foreach($postdata['myorder'] as $key=>$value){ 
				$data['display_order'] = $value;
				$data['modified']= date('Y-m-d H:i:s');
				
				DB::table('category_home_addtabproductsdata')
				  ->where('productid', $key)
				  ->where('category_id', $category_id)
				  ->where('tabid', $tabid)
				  ->where('homecatid', $homecatid)
				  ->update($data);
			}
			$detaildata['success'] = 'category home product list order has been updated successfully.';
			$detaildata['data'] = $data;
					
			return Redirect::to('web88cms/categories/category_home_products_list/?tabid='.$tabid.'&homecatid='.$homecatid.'&category_id='.$category_id)->withFlashMessage('category home product list order has been changed successfully..');
		}
	}
	
	
	function deletechoosenhomeproductfrmlist()
	{
		$post= $_POST;

		$productid= $post['product_id'];
		$tabid=$post['tabid'];
		$homecatid=$post['homecatid'];
		$category_id=$post['category_id'];
		 
		 DB::table('category_home_addtabproductsdata')->where('productid',$productid)->where('tabid',$tabid)->where('homecatid',$homecatid)->delete();
		
	     return Redirect::to('web88cms/categories/category_home_products_list/?tabid='.$tabid.'&homecatid='.$homecatid.'&category_id='.$category_id)->withFlashMessage('category home product has been deleted successfully..');
	
	
	}
	function deleteAllhomecatlist()
	{
			$formData= Request::input();
			
			/*echo "<pre>";
			print_r($formData);
			echo $tabid;
			die;*/
		
		$tabid= Request::get('tabid');
		$homecatid= Request::get('homecatid');
		$category_id= Request::get('category_id');
		DB::table('category_home_addtabproductsdata')->where('tabid',$tabid)->where('homecatid',$homecatid)->delete();
				
		return Redirect::to('web88cms/categories/category_home_products_list/?tabid='.$tabid.'&homecatid='.$homecatid.'&category_id='.$category_id)->withFlashMessage('All category home product  has been deleted successfully..');
	}
	
	
	function deleteselectedcatsdata()
	{
		if(Request::isMethod('post'))
		{
			$tabid= Request::get('tabid');
			$homecatid= Request::get('homecatid');
			$category_id= Request::get('category_id');
			$formData= Request::input();
			
			/*echo "<pre>";
			print_r($formData);
			echo $tabid;
			die;*/
			$category_id= $formData['category_id'];
			$homecatid= $formData['homecatid'];
			DB::table('category_home_addtabproductsdata')->where('tabid',$tabid)->where('homecatid',$homecatid)->whereIn('productid',explode(',',$formData['product_id']))->delete();
				
			return Redirect::to('web88cms/categories/category_home_products_list/?tabid='.$tabid.'&homecatid='.$homecatid.'&category_id='.$category_id)->withFlashMessage('All category home product(s) has been deleted successfully..');
		}
	}
	 
	public function tablistinghomelistateditcatwithtab()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		if(Request::isMethod('post'))
		{
			$validator = Validator::make(Request::all(),[
				'title' => 'required',
				'display_order' => 'required|unique:category_home_list_tablisting',
				
			]);
			
			$data=db::select("SELECT display_order FROM category_home_list_tablisting WHERE category_id='".$_POST['category_id']."' and display_order='".$_POST['display_order']."'");
			
			if ($validator->fails() && count($data)>0) { 
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
			
				$this->CategoryModel->addtablistingcategoryhomelist(Request::input());
				
				echo json_encode(array('success' => 'success'));
				exit;
			}
		}
		return view('admin.category.category_home_list');
	}
	
	/******************************************************************/
	function deleteselecttabdataedit()
	{
		$post= $_POST;
		
		DB::table('category_home_list_tablisting')->whereIn('id',explode(',',$post['editCat_tabId']))->delete();
		echo json_encode(array('success' => 'success'));
		exit;
	}
	
	
	
	function deleteAlltabhomedataedit($catId)
	{
		$category_id=$catId;
		//echo DB::table('category_home_list_tablisting')->where('category_id',$category_id)->delete();
		 DB::table('category_home_list_tablisting')->where('category_id',$category_id)->delete();
		echo json_encode(array('success' => 'success'));
		exit;		
		//return Redirect::to('web88cms/categories/category_home_list')->withFlashMessage('All category home list has been deleted successfully..');
	}

/*************************************************************/

public function deletetabcategoryhomelisttabajax()
	{
		$data['hometabslistviewdata'] = DB::select("SELECT * FROM category_home_list_tablisting WHERE category_id=0");
		echo '<table class="table table-hover table-striped">
              	<thead>
                	<tr>
                    	<th width="1%"><input type="checkbox" id="select_items2" name="select_items2"/></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th width="12%">Display Order</th>
                        <th>Action</th>
                    </tr><tbody>';
          
		$j=0;
		foreach($data['hometabslistviewdata'] as $details2){
			$status_class2 = ($details2->status == '1') ? 'label-success' : 'label-red';
			$status2 = ($details2->status == '1')? 'Active' : 'In-active';
			
            echo '<tr>
            	<td><input type="checkbox" value="'.$details2->id.'" onclick="selectForDelete2();" class="select_items2"/></td>
                <td>'.++$j.'</td>
                <td><span class="label label-sm '.$status_class2.'" id="tabs-home-list-status-'.$details2->id.'">'.$status2.'</span></td>
                <td>'.$details2->title.'</td>
               	<td>
                   	<input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, '.$j.');document.getElementById(\'displayorder_'.$details2->id.'\').value=this.value" class="form-control displayord" value="'.$details2->display_order.'">
                 </td>
                 <td><!--<a href="category_home_products_list?tabid='.$details2->id.'&homecatid=0" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>--> <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab-'.$details2->id.'" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                     <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-'.$details2->id.'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <div id="modal-edit-tab-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog modal-wide-width">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form">
                                                <form class="form-horizontal" name="edittablisthome-'.$details2->id.'" id="edittablisthome-'.$details2->id.'" method="post" action="category_home_list/edittablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="tabhome_id" value="'.$details2->id.'" />
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-6">
                                                      <div data-on="success" data-off="primary" class="make-switch">';
                                                       
														if($details2->status=='1'){ $check2='checked="checked"';}else { $check2='';}
                                                        
														echo '<input id="status" type="checkbox" name="status"  '.$check2.' value="1"  />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Title</label>
                                                    <div class="col-md-6">
                                                      <input name="title" id="title" type="text" class="form-control" placeholder="" value="'.$details2->title.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Display Order</label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="display_order" id="display_order"'.$details2->id.'"" class="form-control" placeholder="" value="'.$details2->display_order.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                    <a  onClick="edithometablsitdata('.$details2->id.');" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$(\'.form-horizontal\').trigger(\'reset\');"  href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                  </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="modal-delete-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>#'.$j.':</strong> '.$details2->title.'</p>
                                              <div class="form-actions">
                                                <form  name="deleteform2" id="deleteform2-'.$details2->id.'" method="post" action="category_home_list/deletetablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="cathome_id" value="'.$details2->id.'" />
                                                  <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="javascript:document.getElementById(\'deleteform2-'.$details2->id.'\').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  </tr>
                                </tbody>';
        }
         echo '<tfoot>
               	<tr>
                	<td colspan="6"></td>
                </tr>
               </tfoot>
            </table>';
    }
	
	
	
	public function delehomealllisttabajax()
	{
		$data['hometabslistviewdata'] = DB::select("SELECT * FROM category_home_list_tablisting WHERE category_id=0");
		echo '<table class="table table-hover table-striped">
              	<thead>
                	<tr>
                    	<th width="1%"><input type="checkbox" id="select_items2" name="select_items2"/></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th width="12%">Display Order</th>
                        <th>Action</th>
                    </tr><tbody>';
          
		$j=0;
		foreach($data['hometabslistviewdata'] as $details2){
			$status_class2 = ($details2->status == '1') ? 'label-success' : 'label-red';
			$status2 = ($details2->status == '1')? 'Active' : 'In-active';
			
            echo '<tr>
            	<td><input type="checkbox" value="'.$details2->id.'" onclick="selectForDelete2();" class="select_items2"/></td>
                <td>'.++$j.'</td>
                <td><span class="label label-sm '.$status_class2.'" id="tabs-home-list-status-'.$details2->id.'">'.$status2.'</span></td>
                <td>'.$details2->title.'</td>
               	<td>
                   	<input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, '.$j.');document.getElementById(\'displayorder_'.$details2->id.'\').value=this.value" class="form-control displayord" value="'.$details2->display_order.'">
                 </td>
                 <td><!--<a href="category_home_products_list?tabid='.$details2->id.'&homecatid=0" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>--> <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab-'.$details2->id.'" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                     <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-'.$details2->id.'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <div id="modal-edit-tab-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog modal-wide-width">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form">
                                                <form class="form-horizontal" name="edittablisthome-'.$details2->id.'" id="edittablisthome-'.$details2->id.'" method="post" action="category_home_list/edittablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="tabhome_id" value="'.$details2->id.'" />
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-6">
                                                      <div data-on="success" data-off="primary" class="make-switch">';
                                                       
														if($details2->status=='1'){ $check2='checked="checked"';}else { $check2='';}
                                                        
														echo '<input id="status" type="checkbox" name="status"  '.$check2.' value="1"  />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Title</label>
                                                    <div class="col-md-6">
                                                      <input name="title" id="title" type="text" class="form-control" placeholder="" value="'.$details2->title.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Display Order</label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="display_order" id="display_order"'.$details2->id.'"" class="form-control" placeholder="" value="'.$details2->display_order.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                    <a  onClick="edithometablsitdata('.$details2->id.');" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$(\'.form-horizontal\').trigger(\'reset\');"  href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                  </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="modal-delete-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>#'.$j.':</strong> '.$details2->title.'</p>
                                              <div class="form-actions">
                                                <form  name="deleteform2" id="deleteform2-'.$details2->id.'" method="post" action="category_home_list/deletetablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="cathome_id" value="'.$details2->id.'" />
                                                  <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="javascript:document.getElementById(\'deleteform2-'.$details2->id.'\').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  </tr>
                                </tbody>';
        }
         echo '<tfoot>
               	<tr>
                	<td colspan="6"></td>
                </tr>
               </tfoot>
            </table>';
    }
	public function updatehomealllisttabajax()
	{
		$data['hometabslistviewdata'] = DB::select("SELECT * FROM category_home_list_tablisting WHERE category_id=0");
		echo '<table class="table table-hover table-striped">
              	<thead>
                	<tr>
                    	<th width="1%"><input type="checkbox" id="select_items2" name="select_items2"/></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th width="12%">Display Order</th>
                        <th>Action</th>
                    </tr><tbody>';
          
		$j=0;
		foreach($data['hometabslistviewdata'] as $details2){
			$status_class2 = ($details2->status == '1') ? 'label-success' : 'label-red';
			$status2 = ($details2->status == '1')? 'Active' : 'In-active';
			
            echo '<tr>
            	<td><input type="checkbox" value="'.$details2->id.'" onclick="selectForDelete2();" class="select_items2"/></td>
                <td>'.++$j.'</td>
                <td><span class="label label-sm '.$status_class2.'" id="tabs-home-list-status-'.$details2->id.'">'.$status2.'</span></td>
                <td>'.$details2->title.'</td>
               	<td>
                   	<input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, '.$j.');document.getElementById(\'displayorder_'.$details2->id.'\').value=this.value" class="form-control displayord" value="'.$details2->display_order.'">
                 </td>
                 <td><!--<a href="category_home_products_list?tabid='.$details2->id.'&homecatid=0" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>--> <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab-'.$details2->id.'" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                     <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-'.$details2->id.'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <div id="modal-edit-tab-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog modal-wide-width">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form">
                                                <form class="form-horizontal" name="edittablisthome-'.$details2->id.'" id="edittablisthome-'.$details2->id.'" method="post" action="category_home_list/edittablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="tabhome_id" value="'.$details2->id.'" />
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-6">
                                                      <div data-on="success" data-off="primary" class="make-switch">';
                                                       
														if($details2->status=='1'){ $check2='checked="checked"';}else { $check2='';}
                                                        
														echo '<input id="status" type="checkbox" name="status"  '.$check2.' value="1"  />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Title</label>
                                                    <div class="col-md-6">
                                                      <input name="title" id="title" type="text" class="form-control" placeholder="" value="'.$details2->title.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Display Order</label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="display_order" id="display_order"'.$details2->id.'"" class="form-control" placeholder="" value="'.$details2->display_order.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                    <a  onClick="edithometablsitdata('.$details2->id.');" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$(\'.form-horizontal\').trigger(\'reset\');"  href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                  </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="modal-delete-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>#'.$j.':</strong> '.$details2->title.'</p>
                                              <div class="form-actions">
                                                <form  name="deleteform2" id="deleteform2-'.$details2->id.'" method="post" action="category_home_list/deletetablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="cathome_id" value="'.$details2->id.'" />
                                                  <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="javascript:document.getElementById(\'deleteform2-'.$details2->id.'\').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  </tr>
                                </tbody>';
        }
         echo '<tfoot>
               	<tr>
                	<td colspan="6"></td>
                </tr>
               </tfoot>
            </table>';
    }
	
	
	
	/*****************************editajax*/
	public function editcategoryhomelisttabajaxfortab()
	{
		 
		  if(isset($_GET['category_id'])){$category_id = $_GET['category_id'];}else{$category_id='0';}
		
		//echo "SELECT * FROM category_home_list_tablisting WHERE category_id=".$category_id;
		
		$data['hometabslistviewdata'] = DB::select("SELECT * FROM category_home_list_tablisting WHERE category_id=".$category_id);
		echo '<table class="table table-hover table-striped">
              	<thead>
                	<tr>
                    	<th width="1%"><input type="checkbox" id="select_items2edit" name="select_items2edit"/></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th width="12%">Display Order</th>
                        <th>Action</th>
                    </tr><tbody>';
          
		$j=0;
		foreach($data['hometabslistviewdata'] as $details2){
			$status_class2 = ($details2->status == '1') ? 'label-success' : 'label-red';
			$status2 = ($details2->status == '1')? 'Active' : 'In-active';
			
            echo '<tr>
            	<td><input type="checkbox" value="'.$details2->id.'" onclick="selectForDelete2edit();" class="select_items2edit"/></td>
                <td>'.++$j.'</td>
                <td><span class="label label-sm '.$status_class2.'" id="tabs-home-list-status-'.$details2->id.'">'.$status2.'</span></td>
                <td>'.$details2->title.'</td>
               	<td>
                   	<input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, '.$j.');document.getElementById(\'displayorder_'.$details2->id.'\').value=this.value" class="form-control displayord" value="'.$details2->display_order.'">
                 </td>
                 <td><a href="category_home_products_list?tabid='.$details2->id.'&homecatid=0&category_id='.$category_id.'" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab-'.$details2->id.'" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                     <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-'.$details2->id.'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <div id="modal-edit-tab-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog modal-wide-width">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form">
                                                <form class="form-horizontal" name="edittablisthome-'.$details2->id.'" id="edittablisthome-'.$details2->id.'" method="post" action="category_home_list/edittablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="tabhome_id" value="'.$details2->id.'" />
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-6">
                                                      <div data-on="success" data-off="primary" class="make-switch">';
                                                       
														if($details2->status=='1'){ $check2='checked="checked"';}else { $check2='';}
                                                        
														echo '<input id="status" type="checkbox" name="status"  '.$check2.' value="1"  />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Title</label>
                                                    <div class="col-md-6">
                                                      <input name="title" id="title" type="text" class="form-control" placeholder="" value="'.$details2->title.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Display Order</label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="display_order" id="display_order"'.$details2->id.'"" class="form-control" placeholder="" value="'.$details2->display_order.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                    <a  onClick="edithometablsitdata('.$details2->id.');" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$(\'.form-horizontal\').trigger(\'reset\');"  href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                  </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="modal-delete-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>#'.$j.':</strong> '.$details2->title.'</p>
                                              <div class="form-actions">
                                                <form  name="deleteform2EditCat" id="deleteform2EditCat-'.$details2->id.'" method="post" action="category_home_list/deletetablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="cathome_id" value="'.$details2->id.'" />
                                                  <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="deleteTabAtEditCat('.$details2->id.','.$details2->category_id.');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  </tr>
                                </tbody>';
        }
         echo '<tfoot>
               	<tr>
                	<td colspan="6"></td>
                </tr>
               </tfoot>
            </table>';
			
    }	
	
	function edittabenablecategoryhomelistpostdata()
	{
		/*echo "<pre>";
		print_r($_POST);
		die;*/
		$post = $_POST;
		if(Request::isMethod('post'))
		
			$validator = Validator::make(Request::all(),[
			'cat_title' => 'required',
             ]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
		
		$results = DB::table('category_home_list')->where('id',$post['category_id'])->get();
		$data['status'] = (isset($post['status']) && $post['status'] == '1') ? '1' : '';	
		$data['cat_title'] = $post['cat_title'];
		$data['enable_tab'] = (isset($post['enable_tab']) && $post['enable_tab'] == '1') ? '1' : '0';
		if($post['enable_tab']==0)
		{
			DB::select("delete  FROM `category_home_addtabproductsdata` WHERE tabid!='0' and homecatid='0' and  category_id='".$post['category_id']."' ");
		    DB::select("delete  FROM `category_home_list_tablisting` WHERE category_id=".$post['category_id']);
		}
		
			
			
			$data['modified'] = date('Y-m-d H:i:s');
			 DB::table('category_home_list')->where('id', $post['category_id'])->update($data);
			
			echo json_encode(array('success' => 'success'));
				exit;

			}
	} 
	function edittablisthomedata()
	{
		$post = $_POST;
		if(Request::isMethod('post'))
		
			$validator = Validator::make(Request::all(),[
			'title' => 'required',
			//'display_order' => 'required|unique:category_home_list_tablisting',
			'display_order' => 'required',
             ]);
			
			if ($validator->fails()) {  
				$json['error'] = $validator->errors()->all(); 
				echo json_encode($json);
				exit;
			}else{
		
		$results = DB::table('category_home_list_tablisting')->where('id',$post['id'])->get();
		$data['status'] = (isset($post['status']) && $post['status'] == '1') ? '1' : '';	
		$data['title'] = $post['title'];
		$data['display_order'] = $post['display_order'];	
			
			$data['modified'] = date('Y-m-d H:i:s');
			 DB::table('category_home_list_tablisting')->where('id', $post['id'])->update($data);
			
			echo json_encode(array('success' => 'success'));
				exit;

			}
	}
	
	
	/******************************************/
	function edit_update_display_order_all_tab_cat_home()
	{
		$postdata= $_POST;
		$data= array();
		$category_id= $postdata['category_id'];
		
		if(Request::isMethod('post')){
			$flag = 'success';
			if(isset($postdata['display_order'])&&$postdata['display_order']!='')
			{
				foreach($postdata['display_order'] as $key=>$value){
					//// Check display order already exist in db
					$results = DB::select('select id, display_order from category_home_list_tablisting where display_order= '.$value.' &&  id!='.$key.' && category_id='.$postdata['category_id']);
	
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
		}
	  	
		if($flag == 'error')
		{
		    echo json_encode(array('error' => 'error'));
			exit;
			//return Redirect::to('web88cms/categories/category_home_list/')->withInput()->with('error', 'Please fill unique display order Field..');
		}else{
			$data= array();
			if(isset($postdata['display_order'])&&$postdata['display_order']!='')
			{
				foreach($postdata['display_order'] as $key=>$value){ 
					$data['display_order'] = $value;
				
					DB::table('category_home_list_tablisting')
						->where('id', $key)
				  		->where('category_id', $category_id)
				  		->update($data);
				}
			}
			$detaildata['success'] = 'Tab list order has been updated successfully.';
			$detaildata['data'] = $data;
			echo json_encode(array('success' => 'success'));
			exit;		
			//return Redirect::to('web88cms/categories/category_home_list')->withFlashMessage('Tab display order has been changed successfully..');
		}
	}	 
	
	
	/****************************************************/
	public function updateeditcategoryhomelisttabajaxfortab()
	{
		 
		  if(isset($_GET['category_id'])){$category_id = $_GET['category_id'];}else{$category_id='0';}
		
		//echo "SELECT * FROM category_home_list_tablisting WHERE category_id=".$category_id;
		
		$data['hometabslistviewdata'] = DB::select("SELECT * FROM category_home_list_tablisting WHERE category_id=".$category_id);
		echo '<table class="table table-hover table-striped">
              	<thead>
                	<tr>
                    	<th width="1%"><input type="checkbox" id="select_items2" name="select_items2"/></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th width="12%">Display Order</th>
                        <th>Action</th>
                    </tr><tbody>';
          
		$j=0;
		foreach($data['hometabslistviewdata'] as $details2){
			$status_class2 = ($details2->status == '1') ? 'label-success' : 'label-red';
			$status2 = ($details2->status == '1')? 'Active' : 'In-active';
			
            echo '<tr>
            	<td><input type="checkbox" value="'.$details2->id.'" onclick="selectForDelete2();" class="select_items2"/></td>
                <td>'.++$j.'</td>
                <td><span class="label label-sm '.$status_class2.'" id="tabs-home-list-status-'.$details2->id.'">'.$status2.'</span></td>
                <td>'.$details2->title.'</td>
               	<td>
                   	<input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, '.$j.');document.getElementById(\'displayorder_'.$details2->id.'\').value=this.value" class="form-control displayord" value="'.$details2->display_order.'">
                 </td>
                 <td><!--<a href="category_home_products_list?tabid='.$details2->id.'&homecatid=0" data-hover="tooltip" data-placement="top" title="View/Edit Products"><span class="label label-sm label-yellow"><i class="fa fa-search"></i></span></a>--> <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-tab-'.$details2->id.'" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                     <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-'.$details2->id.'" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <div id="modal-edit-tab-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog modal-wide-width">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label3" class="modal-title">Edit Tab</h4>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form">
                                                <form class="form-horizontal" name="edittablisthome-'.$details2->id.'" id="edittablisthome-'.$details2->id.'" method="post" action="category_home_list/edittablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="tabhome_id" value="'.$details2->id.'" />
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-6">
                                                      <div data-on="success" data-off="primary" class="make-switch">';
                                                       
														if($details2->status=='1'){ $check2='checked="checked"';}else { $check2='';}
                                                        
														echo '<input id="status" type="checkbox" name="status"  '.$check2.' value="1"  />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Title</label>
                                                    <div class="col-md-6">
                                                      <input name="title" id="title" type="text" class="form-control" placeholder="" value="'.$details2->title.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="col-md-3 control-label">Display Order</label>
                                                    <div class="col-md-6">
                                                      <input type="text" name="display_order" id="display_order"'.$details2->id.'"" class="form-control" placeholder="" value="'.$details2->display_order.'">
                                                    </div>
                                                  </div>
                                                  <div class="form-actions">
                                                    <div class="col-md-offset-5 col-md-8"> 
                                                    <a  onClick="edithometablsitdata('.$details2->id.');" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$(\'.form-horizontal\').trigger(\'reset\');"  href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                  </div>
                                                </form>
                                                
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="modal-delete-'.$details2->id.'" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$(\'.form-horizontal\').trigger(\'reset\');" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>#'.$j.':</strong> '.$details2->title.'</p>
                                              <div class="form-actions">
                                                <form  name="deleteform2" id="deleteform2-'.$details2->id.'" method="post" action="category_home_list/deletetablist" enctype="multipart/form-data" >
                                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                                  <input type="hidden" name="id" id="cathome_id" value="'.$details2->id.'" />
                                                  <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="javascript:document.getElementById(\'deleteform2-'.$details2->id.'\').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  </tr>
                                </tbody>';
        }
         echo '<tfoot>
               	<tr>
                	<td colspan="6"></td>
                </tr>
               </tfoot>
            </table>';
    }
	
}
