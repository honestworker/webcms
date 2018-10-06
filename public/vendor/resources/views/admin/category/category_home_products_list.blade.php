<?php 
	use App\Http\Models\Admin\Category;
	$CategoryModel = new Category();

	use Illuminate\Support\Facades\Route;
	$current_route = Route::getCurrentRoute()->getActionName();
?>
@extends('adminBannerLayout')

@section('content') 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
 if(isset($_GET['tabid'])&&($_GET['tabid']!=''))
{	
  $tabid=$_GET['tabid'];
 }
	else
	{
		$tabid='0';
		}
	/*************************************************/	
		if(isset($_GET['homecatid'])&&($_GET['homecatid']!=''))
{	
  $homecatid=$_GET['homecatid'];
 }
	else
	{
		$homecatid='0';
		}
		
		
		if(isset($_GET['category_id'])&&($_GET['category_id']!=''))
{	
  $category_id=$_GET['category_id'];
 }
	else
	{
		$category_id='0';
		}
		
?>



<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/jquery-nestable/nestable.css') }}" />
<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

<div class="page-header-breadcrumb">
  <div class="page-heading hidden-xs">
    <h1 class="page-title">Products</h1>
  </div>
  <ol class="breadcrumb page-breadcrumb">
    <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
    <li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
    <li><a href="{{ url('/web88cms/categories/list') }}">All Categories Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
    <li><a href="{{ url('/web88cms/categories/category_home_list') }}">Home Categories Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
    <li class="active"> 
    	<a href="{{ url('/web88cms/categories/category_home_list') }}">
			<?php $cat_titlemain = $CategoryModel->getcattitle($category_id);
				foreach($cat_titlemain as $cat_titledata){
					echo $cat_titledata->cat_title;
				}
			?>
            &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
        </a>
        <a href="{{ url('/web88cms/categories/category_home_list') }}">
			<?php if($tabid!=0){ 
				$tab_titlemain = $CategoryModel->gettabtitle($tabid);
				foreach($tab_titlemain as $tab_titledata){
					echo $tab_titledata->title;
				}
			?> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
			<?php }?>
        </a> Products - Listing</li>
 
  </ol>
</div>
<div class="page-content">
  <div class="row">
    <div class="col-lg-12">
       <h2><?php  $cat_titlemain = $CategoryModel->getcattitle($category_id);foreach($cat_titlemain as $cat_titledata){echo $cat_titledata->cat_title;}?>&nbsp;<i class="fa fa-angle-right"></i>&nbsp;<?php if($tabid!=0){ $tab_titlemain = $CategoryModel->gettabtitle($tabid);foreach($tab_titlemain as $tab_titledata){echo $tab_titledata->title;}?> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;<?php }?>   Products <i class="fa fa-angle-right"></i> Listing</h2>
     <div class="clearfix"></div>
      
      <!--  <div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>-->
      <p>@if (Session::has('flash_message'))
      <div class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong> {{ Session::get('flash_message') }}</div>
      @endif
      </p>
      {{ $error = Session::get('error') }}
      {{ Session::get('error') }}
      @if($error)
      <div class="alert alert-danger alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
        <p>{{ $error }}</p>
      </div>
      @endif 
      @if ($success)
      <div class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
        <p>{{ $success }}</p>
      </div>
      @endif
      <div class="pull-left"> Last updated: <span class="text-blue"><?php echo date('d M, Y @ g:i A',strtotime($last_modified)); ?></span> </div>
      <div class="clearfix"></div>
      <p></p>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-6">
      <div class="portlet portlet-blue">
        <div class="portlet-header">
          <div class="caption text-white">Search Products</div>
        </div>
        <div class="portlet-body">
          <form class="form-horizontal">
           <input type="hidden" name="tabid" id="tabid" value="{{ Input::get('tabid') }}" />
            <input type="hidden" name="homecatid" id="homecatid" value="{{ Input::get('homecatid') }}" />
            <input type="hidden" name="category_id" id="category_id" value="{{ Input::get('category_id') }}" />
            <div class="form-group">
              <label class="col-md-4 control-label">Name </label>
              <div class="col-md-8">
                <input type="text" name="product_name" class="form-control" value="{{ Input::get('product_name') }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Product Code </label>
              <div class="col-md-8">
                <input type="text" name="product_code" class="form-control" value="{{ Input::get('product_code') }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Price From </label>
              <div class="col-md-8">
                <input type="text" name="price_from" class="form-control" placeholder="0.00" value="{{ Input::get('price_from') }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Price To </label>
              <div class="col-md-8">
                <input type="text" name="price_to" class="form-control" placeholder="0.00" value="{{ Input::get('price_to') }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Brand </label>
              <div class="col-md-8">
                <select name="brand_id" class="form-control">
                  <option value="all">All Brands</option>
                  <?php
							if(sizeof($brands) > 0)
							{
								foreach($brands as $brandDetails)
								{
									$selected = (Input::get('brand_id') == $brandDetails->id) ? 'selected="selected"' : '';
									echo '<option value="'.$brandDetails->id.'" '.$selected.'>'.$brandDetails->title.'</option>';
								}	
							}
							?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Category </label>
              <div class="col-md-8">
                <select name="product_category_id" class="form-control">
                  <option value="all">- All Categories -</option>
                  <?php echo $categories; ?>
                </select>
              </div>
            </div>
            <!-- save button start -->
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></button>
            </div>
            <!-- save button end --> 
            <!-- <div class="form-actions text-center"> <a href="#" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></a> </div>-->
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#brand-image" data-toggle="tab"><?php  $cat_titlemain = $CategoryModel->getcattitle($category_id);foreach($cat_titlemain as $cat_titledata){echo $cat_titledata->cat_title;}?>&nbsp;-&nbsp;<?php if($tabid!=0){ $tab_titlemain = $CategoryModel->gettabtitle($tabid);foreach($tab_titlemain as $tab_titledata){echo $tab_titledata->title;}?> &nbsp;-&nbsp;<?php }?>   Products  Listing
</a></li>  </ul>
      <div id="myTabContent" class="tab-content">
        <div id="brand-image" class="tab-pane fade in active">
          <div class="portlet">
            <div class="portlet-header">
              <div class="caption"> <?php  $cat_titlemain = $CategoryModel->getcattitle($category_id);foreach($cat_titlemain as $cat_titledata){echo $cat_titledata->cat_title;}?>&nbsp;-&nbsp;<?php if($tabid!=0){ $tab_titlemain = $CategoryModel->gettabtitle($tabid);foreach($tab_titlemain as $tab_titledata){echo $tab_titledata->title;}?> &nbsp;-&nbsp;<?php }?>   Products  Listing
</div>
              <br/>
              <p class="margin-top-10px"></p>
              <a href="#" class="btn btn-success" data-target="#modal-browse-products" data-toggle="modal">Browse Products &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
              <div class="btn-group">
                <button type="button" class="btn btn-primary">Delete</button>
                <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
               <ul role="menu" class="dropdown-menu">
                    	<li><a id="sel" href="#" onclick="if($('.select_itemsmain:checked').length == 0){alert('Select items to delete.'); $('#sel').attr('data-toggle', '');return false;}else{ $('#sel').attr('data-toggle', 'modal'); }" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
              </div>
              <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              <div id="modal-browse-products" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-wide-width">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                      <h4 id="modal-login-label3" class="modal-title">Browse Products</h4>
                    </div>
                    <div class="modal-body"> 
                      <script>
											 function funmain(val)
											 {var catid=val;
												 
												var catvalue= $("#category_id2 :selected").text();
												document.getElementById("selectedcategoryvalue").value = catvalue;
												document.getElementById("selectedcategoryid").value = catid;
												var form_data = new window.FormData($('#browse-products')[0]);	
                                        $.ajax({			
										url: 'category_home_products_list?catid='+catid,
										type:'get',
										dataType:'html',
										data: form_data,
										enctype: 'multipart/form-data',
										processData: false,
										contentType: false,
										success: function(response) {			
												$("#afterSelectCategory").html(response);
											}
										});
					
										
												
											 }
											 </script> 
                      <script>
								function selectForPost(){
										$('#productid').val('');
										
										$('input.select_items').each(function(){
						
											if($(this).is(':checked'))
											{
												id = $(this).attr('value');
												
												if($('#productid').val() == '')
													$('#productid').val(id);
												else
												{
													a = $('#productid').val();
													
													$('#productid').val(a+','+id);	
												}
												
											}
									});
								}
								
								// select all checkboxes
								$(document).ready(function(){
									$('#select_items').click(function(){
										//alert('asd');
										//if($('.select_items').length() > 0)
										if($('#select_items').is(':checked'))
										{
											$('.select_items').prop('checked',true);
										}
										else
											$('.select_items').prop('checked',false);
											
										selectForPost();
									});	
								});
							</script>
                      <div class="form">
                      <script>
                                function validate_form()
{
//valid = true;

if($('input[type=checkbox].select_items:checked').length == 0)
{
	
    alert ( "ERROR! Please select at least one checkbox" );
	return false;
}else{
	addmainhomeproduct();
}
//return valid;
}
</script>
                        <form class="form-horizontal browse-products" name="browse-products" id="browse-products" method="post" onsubmit="return validate_form();" enctype="multipart/form-data" action="category_home_products_list/addtabproducts">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="tabid" id="tabid" value="{{ Input::get('tabid') }}" />
                          <input type="hidden" name="category_id" id="category_id" value="{{ Input::get('category_id') }}" />
                          <input type="hidden" name="homecatid" id="homecatid" value="{{ Input::get('homecatid') }}" />
                          
                          <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-6">
                              <div data-on="success" data-off="primary" class="make-switch">
                                <input name="status" id="status" type="checkbox" checked="checked" value="1" />
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Display Order</label>
                            <div class="col-md-2">
                              <input name="display_order" id="display_order" type="text" class="form-control" placeholder="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Category </label>
                            <div class="col-md-6">
                              <select name="category_id2" id="category_id2" class="form-control" onchange="funmain(this.value); return">
                                <option value="all">- All Categories -</option>
                                <?php echo $categories; ?>
                              </select>
                              <input type="hidden" name="selectedcategoryvalue" id="selectedcategoryvalue" value="" />
                              <input type="hidden" name="selectedcategoryid" id="selectedcategoryid" value="" />
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Apply to Products</label>
                            <div class="col-md-9"> <!--note to programmer: display all related products according to the category that admin selects above.
                              <input type="checkbox" name="selectall" id="selectall">
                              Add all products.-->
                              <table class="table checkout-table table-responsive">
                                <thead>
                                  <tr>
                                    <th width="1%"><input type="checkbox" id="select_items"/></th>
                                    <th class="table-title"><a herf="sort by name">Product Name</a></th>
                                    <th class="table-title"><a herf="sort by product code">Product Code</a></th>
                                    <th class="table-title"><a herf="sort by list price"> Price</a></th>
                                    <th class="table-title"><a herf="sort by qty">Quantity</a></th>
                                  </tr>
                                </thead>
                                <tbody id="afterSelectCategory">
                                <?php
									$selectedProductId = array();
									foreach($listselectedproducts as $selectedProduct){
										$selectedProductId[] = $selectedProduct->id;
									}
								?>
                                <input type="hidden" name="productid[]" id="productid" value="<?php echo implode(',', $selectedProductId);?>" />
                                
                                <?php
									
						  	$i = 1;
							
                            foreach($products as $details)
                            {
								$status_class = ($details->status == '0') ? 'label-red' : 'label-success';
								$status = ($details->status == '0') ? 'In-active' : 'Active'; 
							?>
                                  <tr>
                                    <td>
                                    	<?php 
											if(in_array($details->id, $selectedProductId)){
												$check = 'checked="checked"';	
											}else{
												$check = '';
											}
										?>
                                        <input <?php echo $check;?> type="checkbox" data-id="<?php echo $details->id; ?>" value="<?php echo $details->id; ?>" onclick="selectForPost();" class="select_items"/>
                                    </td>
                                    
                                    <td class="item-name-col"><figure><a href="#link to product item"><img src="{{ asset('/public/admin/products/large/' .$details->large_image) }}" alt="{{ $details->product_name }}" class="img-responsive" width="100px"></a></figure>
                                      <header class="item-name"> <a href="{{ url('/web88cms/products/editProduct/'. $details->id) }}">{{ $details->product_name }}</a> </header>
                                     </td>
                                    <td class="item-code">Product Code: {{ $details->product_code }}</td>
                                    <td class="item-price-col"><span class="item-price-special">RM {{ number_format($details->list_price, 2) }}</span></td>
                                    <td>{{ $details->quantity_in_stock }}</td>
                                  </tr>
                                  <?php 	 
						 	$i++; 
                            }
						?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="form-actions"> 
                           <!-- <input type="submit" name="submit" value="submit" />-->
                            <div class="col-md-offset-5 col-md-8"> <a href="#modal-login-label3" onclick=" validate_form();  " class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" onClick="$('.form-horizontal').trigger('reset');" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                          </div>
                        </form>
                        <script>
                                        function addmainhomeproduct(){
											
                                    var form_data = new window.FormData($('#browse-products')[0]);	
                                    $.ajax({			
										url: 'category_home_products_list/addtabproducts',
										type:'post',
										dataType:'json',
										data: form_data,
										enctype: 'multipart/form-data',
										processData: false,
										contentType: false,
										success: function(response) {			
											if(response['error'])
											{
												$('#erroraddtabproducts').remove();
												$('#successaddtabproducts').remove();
												var error = '<div id="erroraddtabproducts" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
												if(response['error']=='This  is already in use.'){
													error += '<p>'+ response['error'] +'</p>';
												}else{
													for(var i=0; i < response['error'].length; i++)
													{
														error += '<p>'+ response['error'][i] +'</p>';
													}
												}
													error += '</div>';
													$('#browse-products').before(error);	
												}
																				
												if(response['success'])
												{
													$('#erroraddtabproducts').remove();
													$('#successaddtabproducts').remove();
													var success = '<div id="successaddtabproducts" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></div>';
													$('#browse-products').before(success);
																				
													$('.browse-products').live('load');
													
													setTimeout(function(){
									   					window.location.reload(1);
													}, 2000);
												}
											}
										});
                                        }
										</script> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                      <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                    </div>
                    <div class="modal-body">
                     <!-- <p><strong>#1:</strong> Panasonic DMC-GX1WGC Camera Twin Lense</a> <br/>
                        Product Code: DMC-GX1WGC</p>-->
                      <div class="form-actions">
                       <form action="category_home_products_list/deleteselectcats" method="post" name="deleteRecord" id="deleteRecord">
                        <input type="hidden" name="tabid" id="tabid" value="{{ Input::get('tabid') }}" />
                        <input type="hidden" name="homecatid" id="homecatid" value="{{ Input::get('homecatid') }}" />
                        <input type="hidden" name="category_id" id="category_id" value="{{ Input::get('category_id') }}" />
                          		<input type="hidden" name="product_id" id="product_id" value="" />
                        		<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                            	<div class="col-md-offset-4 col-md-8"> <a onclick="deleteRecord.submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          	</form> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                      <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-actions">
                        <div class="col-md-offset-4 col-md-8"> <a href="category_home_products_list/deleteAllhomecategrylistdata?tabid=<?php echo $tabid;?>&homecatid=<?php echo $homecatid;?>&category_id=<?php echo $category_id;?>" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <div class="portlet-body">
              <div class="form-inline pull-left">
                <div class="form-group">
                <?php $rec=10; if(isset($_GET['rec'])&&($_GET['rec']!='')){$rec=$_GET['rec'];}?>
                 <select name="select_record" class="form-control" id="select_record" onchange="if (this.value) window.location.href=this.value">
                  <option <?php if($rec==10)echo ("selected=selected")?>value="http://<?php echo $_SERVER['HTTP_HOST'];?>/web88cms/categories/category_home_products_list?tabid=<?php echo $tabid;?>&homecatid=<?php echo $homecatid;?>&category_id=<?php echo $category_id;?>&rec=10">10</option>
                  <option <?php if($rec==20)echo ("selected=selected")?> value="http://<?php echo $_SERVER['HTTP_HOST'];?>/web88cms/categories/category_home_products_list?tabid=<?php echo $tabid;?>&homecatid=<?php echo $homecatid;?>&category_id=<?php echo $category_id;?>&rec=20">20</option>
                  <option <?php if($rec==30)echo ("selected=selected")?> value="http://<?php echo $_SERVER['HTTP_HOST'];?>/web88cms/categories/category_home_products_list?tabid=<?php echo $tabid;?>&homecatid=<?php echo $homecatid;?>&category_id=<?php echo $category_id;?>&rec=30">30</option>
                  <option <?php if($rec==50)echo ("selected=selected")?>value="http://<?php echo $_SERVER['HTTP_HOST'];?>/web88cms/categories/category_home_products_list?tabid=<?php echo $tabid;?>&homecatid=<?php echo $homecatid;?>&category_id=<?php echo $category_id;?>&rec=50">50</option>
                  <option <?php if($rec==100)echo ("selected=selected")?> value="http://<?php echo $_SERVER['HTTP_HOST'];?>/web88cms/categories/category_home_products_list?tabid=<?php echo $tabid;?>&homecatid=<?php echo $homecatid;?>&category_id=<?php echo $category_id;?>&rec=100">100</option>
                </select>
                  &nbsp;
                  <label class="control-label">Records per page</label>
                </div>
              </div>
              <div class="pull-right"> <a  href="javascript:" onclick="document.getElementById('myform').submit()" class="btn btn-danger">Update Display Order &nbsp;<i class="fa fa-refresh"></i></a> </div>
              <div class="clearfix"></div>
              <br/>
              <br/>
              <div class="table-responsive mtl"> 
              <script>
								function selectForDelete(){
										$('#product_id').val('');
										
										$('input.select_itemsmain').each(function(){
						
											if($(this).is(':checked'))
											{
												id = $(this).attr('value');
												
												if($('#product_id').val() == '')
													$('#product_id').val(id);
												else
												{
													a = $('#product_id').val();
													
													$('#product_id').val(a+','+id);	
												}
												
											}
									});
								}
								
								// select all checkboxes
								$(document).ready(function(){
									$('#select_itemsmain').click(function(){
										//alert('asd');
										//if($('.select_items').length() > 0)
										if($('#select_itemsmain').is(':checked'))
										{
											$('.select_itemsmain').prop('checked',true);
										}
										else
											$('.select_itemsmain').prop('checked',false);
											
										selectForDelete();
									});	
								});
							</script>
                <script>
							function uniquefun(val, sn)
							{ 
								var inputs = $(".displayord");

								for(var i = 0; i <= inputs.length; i++){
									if($(inputs[i]).val()==val && i!=sn-1){
										alert("Order '"+val+"' is already in use. Please try another!");
										return false;	
									}
								}
							}
							</script>
                <form name="myform" id="myform" action="category_home_products_list/updateallhome_products_list" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tabid" id="tabid" value="{{ Input::get('tabid') }}" />
                     <input type="hidden" name="homecatid" id="homecatid" value="{{ Input::get('homecatid') }}" />
                  <input type="hidden" id="up_csrf_token" name="_token"  value="{{ csrf_token() }}" />
                 <input type="hidden" name="category_id" id="category_id" value="{{ Input::get('category_id') }}" />
                  <?php  $i = 1;foreach($listselectedproducts as $details){?>
					  <input type="hidden" name="id" id="product_id" value="<?php echo $details->id; ?>" />
					
                  <?php /*?> <input type="hidden" name="myid[]" value="<?php echo $details->id; ?>"  id="myid_<?php echo $details->id; ?>"/><?php */?>
                  <input type="hidden"  name="myorder[<?php echo $details->id; ?>]" value="<?php if($details->displayord==0){ echo $i;} else{ echo $details->displayord;}?>" class="form-control"  id="myorder_<?php echo $details->id; ?>"/>
                  <?php $i++; } ?>
                </form>
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th width="1%"><input type="checkbox" id="select_itemsmain"/></th>
                      <th>#</th>
                      <th><a herf="sort by status">Status</a></th>
                      <th>Image</th>
                      <th><a herf="sort by name">Name</a> / <a herf="sort by product code">Product Code</a></th>
                      <th><a herf="sort by sale price">Sale Price (RM)</a></th>
                      <th><a herf="sort by list price">List Price (RM)</a></th>
                      <th><a herf="sort by qty">Qty</a></th>
                      <th width="12%">Display Order</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                   <tbody>
                  
                  <?php
						  	//$i = 1;
							$i = $start_from;
                            foreach($listselectedproducts as $details)
                            {
								$status_class = ($details->status == '0') ? 'label-red' : 'label-success';
								$status = ($details->status == '0') ? 'In-active' : 'Active';
								
							?>
                 
                  
                    <tr>
                      <td><input type="checkbox" value="<?php echo $details->id; ?>" onclick="selectForDelete();" class="select_itemsmain"/></td>
                      <td><?php echo ++$i; ?></td>
                      <td><span class="label label-sm <?php echo $status_class; ?>" id="brand-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                      <td>
                      @if($details->thumbnail_image_1 != '')
                      <img src="{{ asset('/public/admin/products/medium/' .$details->thumbnail_image_1) }}" alt="{{ $details->product_name }}" class="img-responsive" width="100px">
                     @endif
                     @if($details->thumbnail_image_1 == '')
                     <img src="{{ asset('/public/admin/products/no-image.jpg') }}" alt="{{ $details->product_name }}" class="img-responsive" width="100px">
                     @endif</td>
                     <td><a href="{{ url('/web88cms/products/editProduct/'. $details->id) }}">{{ $details->product_name }}</a> <br/>
                        Product Code: {{ $details->product_code }}</td>
                      <td>{{ number_format($details->sale_price, 2) }}</td>
                      <td>{{ number_format($details->list_price, 2) }}</td>
                      <td>{{ $details->quantity_in_stock }}</td>
                      <td><input name="display_order" id="display_order<?php echo $details->id; ?>" type="text" class="form-control displayord" value="<?php if($details->displayord==0){ echo $i;} else{ echo $details->displayord;}?>" onchange="uniquefun(this.value, <?php echo $i;?>);document.getElementById('myorder_<?php echo $details->id; ?>').value=this.value"></td>
                      <td><!--<a href="{{ url('/web88cms/products/editProduct/'. $details->id) }}" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>--> 
                        <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-<?php echo $details->id; ?>" data-toggle="modal" onclick="delete_item(<?php echo $details->id; ?>)"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> 
                        <!--Modal delete start-->
                        
                        <div id="modal-delete-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                              </div>
                              <div class="modal-body">
                                <p><strong>#<?php echo $i; ?>:</strong> <?php echo $details->product_name; ?> <br/>
                                  Product Code: <?php echo $details->product_code; ?></p>
                                <div class="form-actions">
                                  <div class="col-md-offset-4 col-md-8"> 
                                  <form  name="deleteform" id="deleteform<?php echo $details->id; ?>" method="post" action="category_home_products_list/deletechoosenhomeproduct" enctype="multipart/form-data" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="tabid" id="tabid" value="{{ Input::get('tabid') }}" />
                                 <input type="hidden" name="homecatid" id="homecatid" value="{{ Input::get('homecatid') }}" />
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $details->id; ?>" />
                               <input type="hidden" name="category_id" id="category_id" value="{{ Input::get('category_id') }}" />
                                <a onclick="javascript:document.getElementById('deleteform<?php echo $details->id; ?>').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;  <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green" onclick=" $('.form-horizontal').trigger('reset'); cancel_delete()">No &nbsp;<i class="fa fa-times-circle"></i></a> 
                              
                              </form>
                              </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- modal delete end --></td>
                    </tr>
                  
                  <?php 	 
						 	
                            }
						?>
                        </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="10"></td>
                    </tr>
                  </tfoot>
                </table>
                <div class="tool-footer text-right">
              		<p class="pull-left"><?php echo($msg);?><!--Showing 1 to 10 of 57 entries--></p>
              		<ul class="pagination pagination mtm mbm">
                	<?php 
					
						if((isset($_GET['page'])&&($_GET['page']==1))||$total_pages==1 || !isset($_GET['page']))
			
			   {
				 $disabled1= 'class="disabled"';
			   }
			   else
			   {$disabled1= '';} 
				echo "<li ".$disabled1."><a href= http://".$_SERVER['HTTP_HOST']."web88cms/categories/category_home_products_list?tabid=".$_GET['tabid']."&homecatid=".$_GET['homecatid']."&category_id=".$_GET['category_id']."&page=1>".'&laquo;'."</a></li> "; // Goto 1st page
						$total_pages=($total_pages);
			   			for ($j=1; $j<=$total_pages; $j++) { 
						    if(isset($_GET['page'])&&($_GET['page']==$j)){
				 				$active= 'class="active"';
			   				}else{
								$active= '';
							}
							echo "<li ".$active." ><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/categories/category_home_products_list?tabid=".$_GET['tabid']."&homecatid=".$_GET['homecatid']."&category_id=".$_GET['category_id']."&page=".$j.">".$j."</a></li> "; 
						}; 

            			if((isset($_GET['page'])&&($_GET['page']==$total_pages)) || $total_pages==1)
			
			   {
				 $disabled= 'class="disabled"';
			   }
			   else
			   {$disabled= '';}
            echo "<li ".$disabled."><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/categories/category_home_products_list?tabid=".$_GET['tabid']."&homecatid=".$_GET['homecatid']."&category_id=".$_GET['category_id']."&page=$total_pages>".'&raquo;'."</a></li> "; // Goto last page
					?>
              		</ul>
            	</div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>  
    <!--BEGIN FOOTER-->
  <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
        <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png')}}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>
  <!--END FOOTER-->

</div>
<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script> 
<script src="{{ asset('/public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script> 
<script src="{{ asset('/public/admin/js/jquery-ui.js') }}"></script> 
<!--loading bootstrap js--> 
<script src="{{ asset('/public/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script> 
<script src="{{ asset('/public/admin/js/html5shiv.js') }}"></script> 
<script src="{{ asset('/public/admin/js/respond.min.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/metisMenu/jquery.metisMenu.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/slimScroll/jquery.slimscroll.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/jquery-cookie/jquery.cookie.js') }}"></script> 
<script src="{{ asset('/public/admin/js/jquery.menu.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/jquery-pace/pace.min.js') }}"></script> 

<!--LOADING SCRIPTS FOR PAGE--> 
<script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script> 
<script src="{{ asset('/public/admin/js/form-components.js') }}"></script> 
<!--LOADING SCRIPTS FOR PAGE--> 

<script src="{{ asset('/public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script> 
<script src="{{ asset('/public/admin/vendors/ckeditor/ckeditor.js') }}"></script> 
<script src="{{ asset('/public/admin/js/ui-tabs-accordions-navs.js') }}"></script> 

<!--CORE JAVASCRIPT--> 
<script src="{{ asset('/public/admin/js/main.js') }}"></script> 
<script src="{{ asset('/public/admin/js/holder.js') }}"></script> 
<script type="text/javascript">
$(function(){
	$('select[name="select_per_page"]').change(function(){
		window.location = '{{ url("web88cms/categories/homeList") }}/' + $(this).val();
	});
})
</script> 
@endsection 