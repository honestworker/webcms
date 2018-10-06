<?php
namespace App\Http\Models\Admin; // where this file exists

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session; // used for queries like DB::table('table_name')->get();
class Category extends Model{

	public function getCategory($category_id)
	{
		return DB::table('categories')->where('id', '=', $category_id)->first();
	}
	
	public function getCategories($parent_id = 0)
	{
		$categories = array();
		
		$results = DB::table('categories')->where('parent_id', '=', $parent_id)->orderBy('order_no', 'ASC')->get();
		
		foreach($results as $result){
			$categories[] = array(
				'category_id'			=> $result->id,
				'title'					=> $result->title,
				'image'					=> $result->image,
				'alt_text'				=> $result->alt_text,
				'image2'				=> $result->image2,
				'alt_text2'				=> $result->alt_text2,
				'parent_id'				=> $result->parent_id,
				'short_description'		=> $result->short_description,
				'order_no'				=> $result->order_no,
				'status'				=> $result->status,
				'sub_categories'		=> $this->getCategories($result->id),
			);
		}
		
		return $categories;
	}
	
	// get tree structure for active categories
	function getCategoriesTree()
	{
		$rsCategories = DB::table('categories')->select('*','id as category_id','title as category_label')->where('status','1')->orderBy("parent_id","asc")->orderBy("order_no",'asc')->get();
		
 
		// create the empty array
		$arrayCategories = array();
		
		foreach($rsCategories as $result){
			$arrayCategories[$result->category_id] = array(
				'category_id'			=> $result->category_id,
				'title'					=> $result->category_label,
				'image'					=> $result->image,
				'parent_id'				=> $result->parent_id,
				'order_no'				=> $result->order_no
			);
		}
		
		// print_r($arrayCategories); exit;
		// put the results inside the array
		// i use the category id as key for the array, and i store the parent_id 
		// and the name of the category in a hash with the keys parent_id and name (of course)  
		/*while($row = mysql_fetch_assoc($rsCategories)){ 
			$arrayCategories[$row['category_id']] = array("parent_id" => $row['parent_id'], "title" => $row['category_label']);	
		}*/
		
		return $this->createTreeNested($arrayCategories,0);
	}
	
	// function to create a tree based on a unordered array
	function createTreeT($array, $currentParent, $currLevel = -1) {
		
		foreach ($array as $categoryId => $category) {
			if ($currentParent == $category['parent_id']) {
	 
				// print the asterisks based on the current level of nesting		
				for ($i=0;$i<$currLevel;$i++) echo "-";			
	 
				echo $category['title']."<br />"; // print the category name
	 
				$currLevel++;
				$this->createTreeT ($array, $categoryId, $currLevel);
				$currLevel--;
			}	
		}
	}
	
	
	function createTreeNested($array, $currentParent, $currLevel = 0, $prevLevel = -1,$separator = ' - ') {
 		$html = '';
		foreach ($array as $categoryId => $category) {
	 
			if ($currentParent == $category['parent_id']) {
	 
				$html .= '<option value="'.$categoryId.'">'.$separator.$category['title'].'</option>';
	 
				if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
	 
				$currLevel++; 
	 
				$html .= $this->createTreeNested ($array, $categoryId, $currLevel, $prevLevel,'&nbsp;&nbsp;'.$separator.' - ');
	 
				$currLevel--;	 		 	
			}	
	 
		}
		return $html;
	}
	
	function getSelectedCategoriesTree($productCategories)
	{
		$rsCategories = DB::table('categories')->select('*','id as category_id','title as category_label')->where('status','1')->orderBy("parent_id","asc")->orderBy("order_no",'asc')->get();		
 
		// create the empty array
		$arrayCategories = array();
		
		foreach($rsCategories as $result){
			$arrayCategories[$result->category_id] = array(
				'category_id'			=> $result->category_id,
				'title'					=> $result->category_label,
				'image'					=> $result->image,
				'parent_id'				=> $result->parent_id,
				'order_no'				=> $result->order_no
			);
		}
		
		// print_r($arrayCategories); exit;
		// put the results inside the array
		// i use the category id as key for the array, and i store the parent_id 
		// and the name of the category in a hash with the keys parent_id and name (of course)  
		/*while($row = mysql_fetch_assoc($rsCategories)){ 
			$arrayCategories[$row['category_id']] = array("parent_id" => $row['parent_id'], "title" => $row['category_label']);	
		}*/
		
		return $this->createSelectedTreeNested($productCategories,$arrayCategories,0);
	}
	
	function createSelectedTreeNested($productCategories,$array, $currentParent, $currLevel = 0, $prevLevel = -1,$separator = ' - ') {
 		//dd($productCategories);
		
		$html = '';
		foreach ($array as $categoryId => $category) {
	 
	 		
			
			if ($currentParent == $category['parent_id']) {
	 			
				$selected = (in_array($categoryId,$productCategories)) ? 'selected="selected"' : '';
				
				$html .= '<option value="'.$categoryId.'" '.$selected.'>'.$separator.$category['title'].'</option>';
	 
				if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
	 
				$currLevel++; 
	 
				$html .= $this->createSelectedTreeNested ($productCategories,$array, $categoryId, $currLevel, $prevLevel,'&nbsp;&nbsp;'.$separator.' - ');
	 
				$currLevel--;	 		 	
			}	
	 
		}
		return $html;
	}
	
	public function editCategoriesOrder($category_id, $data){
		$update = [
			'title' 				=> $data['title'],
			'short_description' 	=> $data['short_description'],
			'status' 				=> (isset($data['status']) ? '1' : '0'),	
			'modifydate'			=> date('Y-m-d H:i:s')		
		];
		
		DB::table('categories')->where('id', $category_id)->update($update);
	}
	
	public function updateCategoriesOrder($data, $parent_id = 0){
		foreach($data as $order => $row){
			
			DB::table('categories')->where('id', $row['id'])->update(['parent_id' => $parent_id, 'order_no' => $order, 'modifydate'	=> date('Y-m-d H:i:s')]);
			
			if(isset($row['children']) && is_array($row['children'])){
				$this->updateCategoriesOrder($row['children'], $row['id']);
			}
		}
	}
	
	public function copyCategory($category_id){
		$category = $this->getCategory($category_id);
		
		if($category){
			DB::insert(
				'insert into categories (title, image, alt_text, image2, alt_text2, short_description, order_no, parent_id, status, modifydate, createdate, code) 
				values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
				[$category->title, $category->image, $category->alt_text, $category->image2, $category->alt_text2, $category->short_description, $category->order_no, $category->parent_id, $category->status, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $category->code]
			);
			
			return true;
		}
		else{
			return false;
		}
	}
	
	public function deleteCategory($category_id){
		DB::table('categories')->where('id', '=', $category_id)->delete();
		DB::table('categories')->where('parent_id', '=', $category_id)->delete();
	}
	
	public function updateCategoryImags($category_id, $data){
		if($data['image2'] == ''){
			unset($data['image2']);
		}
		
		$data['modifydate']	= date('Y-m-d H:i:s');
		
		DB::table('categories')->where('id', $category_id)->update($data);
	}
	
	public function createTreeHtml($categories, $lavel = 0)
	{
		$html = '';
		if($categories){
			$html .= '<ol class="dd-list">';
			
			if($lavel == 0){
				$html .= '<li>
						<div style="font-size:17px; display: block; height: 30px; margin: 5px 0; padding: 5px 10px; text-decoration: none; border: 1px solid #ccc; background: #fafafa; box-sizing: border-box;">
							Home &nbsp;<span class="label label-sm label-success">Active</span>
						</div>
					</li>';
			}
					
			foreach($categories as $category){
            	$html .= '<li data-id="' . $category['category_id'] . '" class="dd-item">';
            	$html .= '<div class="pull-right" style="padding: 5px;">';
								$html .= '<a href="' . url('web88cms/categories/copyCategory/' . $category['category_id']) . '" data-hover="tooltip" data-placement="top" title="Duplicate/New Category">';
									$html .= '<span class="label label-sm label-blue"><i class="fa fa-copy"></i></span>';
								$html .= '</a> ';
								$html .= '<a href="javascript:void(0)" data-hover="tooltip" data-placement="top" data-target="#modal-edit-category-' . $category['category_id'] . '" data-toggle="modal" title="Edit"><span class="label label-sm label-success">';
									$html .= '<i class="fa fa-pencil"></i></span>';
								$html .= '</a> ';
								// $html .= '<a href="javascript:void(0)" data-hover="tooltip" data-placement="top" data-target="#modal-upload-image-' . $category['category_id'] . '" data-toggle="modal" title="Upload Menu Image" onMouseDown="this.parentNode.parentNode.className=\'removed-dd-handle\';" onMouseUp="this.parentNode.parentNode.className=\'dd-handle\';">';
								// 	$html .= '<span class="label label-sm label-dark"><i class="fa fa-image"></i></span>';
								// $html .= '</a> ';
								$html .= '<a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-' . $category['category_id'] . '" data-toggle="modal">';
									$html .= '<span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span>';
								$html .= '</a>';
							$html .= '</div>';
                	$html .= '<div class="dd-handle">';
						$html .= $category['title'];
						
						if($category['status']){
							$html .= '&nbsp;<span class="label label-sm label-success">Active</span>';
						}
						else{
							$html .= '&nbsp;<span class="label label-sm label-warning">Inactive</span>';
						}
						$html .= '</div>';
						//if($lavel == 0){
							
						//}
							// $html .= '</div>';
					// $html .= '</div>';
					
					$html .= '<!--Modal edit category start-->
							<div id="modal-edit-category-' . $category['category_id'] . '" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
								<div class="modal-dialog modal-wide-width">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
									  <h4 id="modal-login-label3" class="modal-title">Category Edit</h4>
									</div>
									<div class="modal-body">
									  <div class="form">
										<form class="form-horizontal">
										  <div class="form-group">
											<label class="col-md-3 control-label">Status</label>
											<div class="col-md-6">
											  <div data-on="success" data-off="primary" class="make-switch">
												<input type="checkbox" name="status" ' . ($category['status'] ? 'checked="checked' : '') . '"/>
											  </div>
											</div>
										  </div>
										  <div class="form-group">
											<label class="col-md-3 control-label">Category Name <span class="require">*</span></label>
											<div class="col-md-6">
											  <input type="text" class="form-control" name="title" value="' . $category['title'] . '">
											</div>
										  </div>
										  <div class="form-group">
											<label class="col-md-3 control-label">Short Description</label>
											<div class="col-md-6">
											  <input type="text" class="form-control" name="short_description" value="' . $category['short_description'] . '">
											</div>
										  </div>
										  
										  <div class="form-actions">
											<div class="col-md-offset-5 col-md-8"> 
												<a href="javascript:void(0)" data-id="' . $category['category_id'] . '" onclick="saveCategory($(this))" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> 
											</div>
										  </div>
										</form>
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<!--END MODAL edit category-->';
					
					$html .= '<!--Modal upload image 1 start-->';
					$html .= '<div id="modal-upload-image-' . $category['category_id'] . '" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">';
						$html .= '<div class="modal-dialog modal-wide-width">';
							$html .= '<div class="modal-content">';
								$html .= '<div class="modal-header">';
									$html .= '<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>';
									$html .= '<h4 id="modal-login-label3" class="modal-title">Upload Menu Image(s)</h4>';
								$html .= '</div>';
								
								$html .= '<div class="modal-body">';
									$html .= '<div class="form">';
										$html .= '<form class="form-horizontal">';
											
											$html .= '<div class="form-group">';
												$html .= '<label class="col-md-3 control-label">Upload Menu Image 1 <span class="require">*</span></label>';
												$html .= '<div class="col-md-9">';
													$html .= '<div class="text-15px margin-top-10px">';

														$html .= '<img id="cat-image-1" src="' . asset('/public/images/category/' . $category['image']) . '" alt="' . $category['alt_text'] . '" class="img-responsive"><br/>';														
														$html .= '<input type="file" name="image"/>';
														$html .= '<br/>';
														$html .= '<span class="help-block">(Image dimension: 270 x 400 pixels, JPEG, GIF, PNG only, Max. 1MB) </span>';
													$html .= '</div>';
												$html .= '</div>';
											$html .= '</div>';
							
											$html .= '<div class="form-group">';
												$html .= '<label class="col-md-3 control-label">Image 1 Alt Text</label>';
												$html .= '<div class="col-md-6">';
													$html .= '<input type="text" name="alt_text" class="form-control" placeholder="" value="' . $category['alt_text'] . '">';
												$html .= '</div>';
											$html .= '</div>';
												
											$html .= '<div class="form-group">';
												$html .= '<label class="col-md-3 control-label">Upload Menu Image 2</label>';
												$html .= '<div class="col-md-9">';
													$html .= '<div class="text-15px margin-top-10px">';

														$html .= '<img id="cat-image-2" src="' . asset('/public/images/category/' . $category['image2']) . '" alt="' . $category['alt_text2'] . '" class="img-responsive"><br/>';														
														$html .= '<input type="file" name="image2"/>';
														$html .= '<br/>';
														$html .= '<span class="help-block">(Image dimension: 270 x 400 pixels, JPEG, GIF, PNG only, Max. 1MB) </span>';
													$html .= '</div>';
												$html .= '</div>';
											$html .= '</div>';
							
											$html .= '<div class="form-group">';
												$html .= '<label class="col-md-3 control-label">Image 2 Alt Text</label>';
												$html .= '<div class="col-md-6">';
													$html .= '<input type="text" name="alt_text2" class="form-control" placeholder="" value="' . $category['alt_text2'] . '">';
												$html .= '</div>';
											$html .= '</div>';
											
											$html .= '<div class="form-actions">';
												$html .= '<div class="col-md-offset-5 col-md-8">';
													$html .= '<a href="javascript:void(0)" data-id="' . $category['category_id'] . '" onclick="uploadMenuImage($(this))" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>';
													$html .= ' &nbsp; ';
													$html .= '<a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>';
												$html .= '</div>';
											$html .= '</div>';
										$html .= '</form>';
									$html .= '</div>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<!--END MODAL upload image 1-->';
					
					$html .= '<!--Modal delete selected items start-->
							<div id="modal-delete-' . $category['category_id'] . '" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
								  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
								</div>
								<div class="modal-body">
								  <p><strong>#' . $category['category_id'] . ':</strong> ' . $category['title'] . '</p>
								  <div class="form-actions">
									<div class="col-md-offset-4 col-md-8">
										<a href="' . url('web88cms/categories/deleteCategory/' . $category['category_id']) . '" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
										<a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
								  </div>
								</div>
							  </div>
							</div>
							</div>
							<!-- modal delete selected items end -->';
					
					if($category['sub_categories']){
						$html .= $this->createTreeHtml($category['sub_categories'], ($lavel + 1));
					}
					
				$html .= '</li>';  
			}
			$html .= '</ol>';
		}
		
		return $html;
	}
	
	public function getHomeCategories($limit){
		$category = DB::table('categories_home as ch');
		$category->select('ch.*', DB::raw('(SELECT COUNT(chtp.id) as total from categories_home_to_product as chtp WHERE chtp.category_home_id = ch.id) as totalProduct'));
		$category->orderBy('ch.createdate', 'DESC');
		
		return $category->paginate($limit);;
	}
	
	public function getHomeCategoryTabs(){
		$category = DB::table('categories_tabs as ct');
		$category->select('ct.*', DB::raw('(SELECT COUNT(chtp.id) as total from categories_home_to_product as chtp WHERE chtp.category_tab_id = ct.id) as totalProduct'));
		$category->orderBy('ct.createdate', 'DESC');
		
		return $category->get();
	}
	
	public function get_paginate_msg($limit, $page){
		$page = ($page ? ($page-1) * $limit : 0);
		
		//First query
		$customers = DB::table('categories_home')->select('id');		
		$results = $customers->skip($page)->take($limit)->get();
		
		//Second query
		$customers = DB::table('categories_home');
		$count = $customers->count();
		
		if($results){
			$message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
		}
		else{
			$message = 'Showing 0 to 0 of ' . $count . ' entries';
		}

		return $message;
	}
	/*****************************************************************************************************/
	/*add home category list data*/
	function addcategoryhomelist($formData)
	{
		 if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
		$data['status'] = $status;
		$data['token'] = $formData['_token'];  
		$data['cat_title'] = $formData['cat_title'];  
		$data['enable_tab'] = $formData['enable_tab']; 
		$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');
			DB::table('category_home_list')->insert($data);
			$curId = DB::select('SELECT id FROM category_home_list order by id desc limit 0,1');
			
			DB::update('UPDATE category_home_list_tablisting set category_id='.$curId[0]->id.' WHERE category_id=0');
	}
	function addtablistingcategoryhomelist($formData)
	{
		 if(isset($formData['status'])){$status = $formData['status'];}else{$status='';}
		$data['status'] = $status;
		$data['token'] = $formData['_token'];  
		$data['title'] = $formData['title'];
		$data['display_order'] = $formData['display_order'];
		 if(isset($formData['category_id'])){$category_id = $formData['category_id'];}else{$category_id='';} 
		$data['category_id'] = $category_id;
		$data['modified'] = date('Y-m-d H:i:s');
			$data['created'] = date('Y-m-d H:i:s');
			DB::table('category_home_list_tablisting')->insert($data);
	}
	
	public function getcatagroyhomelistviewdata()
	{
		$res= DB::table('category_home_list')->get();
		return $res;
	}
	public function gettabhomelistviewdata()
	{
		$res= DB::table('category_home_list_tablisting')->where('category_id',0)->get();
		return $res;
	}
		public function maintabwithcats($catid)
	{
		$res= DB::table('category_home_list_tablisting')->where('category_id',$catid)->get();
		return $res;
	}
	/*******************************************************************************************************/
		// get all products homepage search categroy starts here
	function getProductsforcategory_homeproduct()
	{
		
		if(isset($_GET['catid'])&&$_GET['catid']!='')
		{
			//print_r($_GET['catid']);
			//echo json_encode(array('success' => 'success'));
			if($_GET['catid']=='all'){
				$products = DB::select("SELECT 
					 p.*,
				 	pcat.display_order,
				  	pcat.category_id
				 	
				FROM
					products p, 
					 product_to_category pcat   
					
			   	WHERE
				pcat.product_id = p.id and
					p.status='1'
				");
			}else{
				 $subcatid=DB::select("SELECT `id` FROM `categories` WHERE `parent_id`=".$_GET['catid']);
				 
				 foreach($subcatid as $q){
					$a[]=$q->id;	 
				 }

				 if($subcatid !='')
				 {
					$products = DB::select("SELECT 
				 	p.*,
				 	pcat.display_order,
				  	pcat.category_id
				 	
				FROM
					products p,
					 product_to_category pcat  
			   	WHERE
				pcat.product_id = p.id and (pcat.category_id='".$_GET['catid']."' or pcat.category_id IN (".implode(',', $a)."))and
					p.status='1'
				"); 
				 }
				 else
				 {
				$products = DB::select("SELECT 
				 	p.*,
				 	pcat.display_order,
				  	pcat.category_id
				 	
				FROM
					products p,
					 product_to_category pcat  
					 
				 	 
			   	WHERE
				pcat.product_id = p.id and pcat.category_id='".$_GET['catid']."' and
					p.status='1'
				");
				 }
				
			}
				 	
			
			$i = 1;
            foreach($products as $details){
				$status_class = ($details->status == '0') ? 'label-red' : 'label-success';
				$status = ($details->status == '0') ? 'In-active' : 'Active'; 
							
                echo '<tr>
                		<td>
							<input type="checkbox"  value="'.$details->id.'" data-id="'.$details->id.'" onclick="selectForPost();" class="select_items"/>
						</td>
                    	<input type="hidden" name="productid[]" id="productid" value="'.$details->id.'" />
                        <td class="item-name-col">
							<figure>
								<a href="#link to product item">
									<img src="'.asset('/public/admin/products/large/' .$details->large_image).'" alt="'.$details->product_name.'" class="img-responsive" width="100px">
								</a>
							</figure>
                            <header class="item-name"> <a href="'.url('/web88cms/products/editProduct/'. $details->id).'">'.$details->product_name.'</a> </header>
                           	
						</td>
                        <td class="item-code">Product Code: '. $details->product_code.'</td>
                        <td class="item-price-col"><span class="item-price-special">RM '.number_format($details->list_price, 2).'</span></td>
                        <td>'.$details->quantity_in_stock.'</td>
                      </tr>';
					$i++; 
            }
					
            exit;
		}else{ 
			return DB::select("SELECT 
				 p.*,
			 	pcat.display_order
			 	
			FROM
				products p,
				product_to_category pcat 
				
		  	WHERE
			pcat.product_id = p.id and
				p.status='1'
				group by p.id 
			");	
		}
	}
	
/*******************************************/	
	
	
	function list_selected_producted($start_from, $num_rec_per_page,$tabid,$homecatid)
	{
		return DB::select("SELECT 
			 p.*,
			 chome.display_order as displayord
			
		FROM
			products p,
			 product_to_category pcat, 
		     category_home_addtabproductsdata chome 
			 
		   
		WHERE
		pcat.product_id = p.id and
		 chome.productid = p.id and
			p.status='1' and
			chome.tabid='".$tabid."' and
			chome.homecatid='".$homecatid."'
			group by p.id 
			LIMIT ".$start_from.", ".$num_rec_per_page."");		
		
	}
	/****************************************************************************************************************************/
	
	function search_list_selected_producted($start_from, $num_rec_per_page,$search_for,$tabid,$homecatid)
	{
		$qry = "SELECT 
			 	p.*,
			 	chome.display_order as displayord
			 	
			FROM
				products p,
				 product_to_category pcat,
			 category_home_addtabproductsdata chome  
			WHERE
			pcat.product_id = p.id and
			chome.productid = p.id and
				p.status='1' and chome.tabid='".$tabid."' and chome.homecatid='".$homecatid."'";
		
		if(isset($search_for['product_name']) && $search_for['product_name'] != '')
			$qry .= " and
			p.product_name like '%".$search_for['product_name']."%'";
		
		if(isset($search_for['product_code']) && $search_for['product_code'] != '')
			$qry .= " and
			p.product_code like '%".$search_for['product_code']."%'";
		
		if(isset($search_for['price_from']) && $search_for['price_from'] != '' && isset($search_for['price_to']) && $search_for['price_to'] != '')
			$qry .= " and
			p.sale_price >=".$search_for['price_from']." and p.sale_price <=".$search_for['price_to']."";
		else if(isset($search_for['price_from']) && $search_for['price_from'] != '' && ($search_for['price_to'] == '' || $search_for['price_to'] == 0))
			$qry .= " and
			p.sale_price >=".$search_for['price_from']."";
		else if(isset($search_for['price_to']) && $search_for['price_to'] != '' && ($search_for['price_from'] == '' || $search_for['price_from'] == 0))
			$qry .= " and
			p.sale_price <=".$search_for['price_to']."";
		
		if(isset($search_for['brand_id']) && $search_for['brand_id'] != 'all')
			$qry .= " and
			p.brand_id =".$search_for['brand_id']."";
		
		if(isset($search_for['product_category_id']) && $search_for['product_category_id'] != 'all')
		{
			$product_ids = DB::table('product_to_category')->where('category_id',$search_for['product_category_id'])->lists('category_id');
			if(count($product_ids)>0)
			{$qry .= " and
			pcat.id IN(".implode(',', $product_ids).")";
			}
			
		}
		$qry .= " group by p.id 
			LIMIT ".$start_from.", ".$num_rec_per_page."";
		
		$query = DB::select($qry);
		return $query;		
		
	}
	
	
	function getalldataforedithavingtab()
	{
	}
	
	public function editgettabhomelistviewdata($category_id)
	{
		$res= DB::table('category_home_list_tablisting')->where('category_id',$category_id)->get();
		return $res;
	}
	public function getcattitle($cat_id)
	{
		$cat_title= DB::select('SELECT cat_title FROM category_home_list WHERE id="'.$cat_id.'" ');
		return $cat_title;
	}
	public function gettabtitle($tab_id)
	{
		$tab_title= DB::select('SELECT title FROM category_home_list_tablisting WHERE id="'.$tab_id.'" ');
		return $tab_title;
	}
	
	
	// get all products homepage search categroy ends here
}