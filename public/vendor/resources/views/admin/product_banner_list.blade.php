@extends('adminBannerLayout')
<script type="text/javascript">
function chkSizebanner(id){
	if($('#banner'+id).val()!=''){
		var size = $('#banner'+id)[0].files[0].size;
		if(size/1024>1024){
			alert("Error! banner file size exceeds its limit from 1MB. Please try again.");
			$('#banner'+id).replaceWith($('#banner'+id).clone());	
			return false;
		}
	}
}
</script>

@section('content') 
      <div id="page-wrapper">
        
        <div class="page-header-breadcrumb">
    <div class="page-heading hidden-xs">
      <h1 class="page-title">Banners</h1>
    </div>
    <ol class="breadcrumb page-breadcrumb">
      <li><i class="fa fa-home"></i>&nbsp;<a href="">Banners</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
      <li>Banners &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
      <li class="active">Product Banners - Listing</li>
    </ol>
  </div>
        
        
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Product Banners <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              
        <p>@if (Session::has('flash_message'))
        <div class="alert alert-success alert-dismissable">
          <button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
          <i class="fa fa-check-circle"></i> <strong>Success!</strong> {{ Session::get('flash_message') }}</div>
          @endif 
        </p>
             
              
              <div class="pull-left"> Last updated: <span class="text-blue">
        	<?php if(isset($result['lastUpdated'])&&(($result['lastUpdated'])!='')){echo date("d M, Y @ H.i A", strtotime($result['lastUpdated']));}?>
          	</span>
        </div>
              <div class="clearfix"></div>
              <p></p>
              
              
              <div class="clearfix"></div>
              
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Product Banners Listing</div>
                  <br/>
                  <p class="margin-top-10px"></p>
                  <a href="#" data-target="#modal-add-new" data-toggle="modal" class="btn btn-success">Add New Banner &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
            <div class="btn-group">
              <button type="button" class="btn btn-primary">Delete</button>
              <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
              <ul role="menu" class="dropdown-menu">
                <li><a id="sel" href="#" onclick="if($('.select_items:checked').length == 0){alert('Select items to delete.'); $('#sel').attr('data-toggle', '');return false;}else{ $('#sel').attr('data-toggle', 'modal'); }" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                <li class="divider"></li>
                <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
              </ul>
            </div>
                   
				  <div class="tools"> 
                  	<i class="fa fa-chevron-up"></i> 
                  </div>
                  
                  <div id="modal-add-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                      <a name="add"></a>
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                          <h4 id="modal-login-label2" class="modal-title">Add New Banner</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form">
                            <form  method="post" class="form-horizontal" id="product_banner_list" name="product_banner_list"  action="product_banner_list/addproductbanner" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      <div class="form" >
                      <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-6">
                          <div data-on="success" data-off="primary" class="make-switch">
                            <input name="status" value="1" type="checkbox" checked="checked"/>
                          </div>
                        </div>
                      </div>
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Title <span class='require'>*</span> </label>
                        <div class="col-md-6">
                          <input id="title"  type="text" class="form-control" placeholder="Banner 1" name="title"  >
                        </div>
                        <div class="col-md-3">
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                        <div class="col-md-6">
                          <div class="xs-margin"></div>
                          <select id="category" class="form-control" name="category">
                                     <option value="">- Select Category -</option>
                                    <?php echo $result['categories']; ?>
                                  </select>
                                 
                          <input type="checkbox" name="tick" id="tick" value="1" checked="checked">
                          Please tick this box to apply banner to its sub category. </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Upload Banner <span class='require'>*</span></label>
                        <div class="col-md-9">
                          <div class="text-15px margin-top-10px">
                           <input type="file" name="banner" id="banner0" required="required"  onchange="chkSizebanner('0');"/>
                             
                            <br/>
                            <span class="help-block">(Image dimension: 870 x 280 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Start Date to End Date <span class='require'>*</span></label>
                        <div class="col-md-6">
                          <div class="input-group input-daterange">
                            <input type="text" name="start_date" class="form-control" required="required" id="start_date" placeholder="1st Mar, 2015" />
                            <span class="input-group-addon">to</span>
                            <input type="text" name="end_date" class="form-control" required="required" id="end_date" placeholder="03rd Mar ,2015" />
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-offset-5 col-md-8"> 
                        <!-- <input type="submit" name="submit" value="submit" id="submit" /> --> 
                        <a href="#add" onclick="chkSizebanner('0'); addproductBannerlist();" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$('.form-horizontal').trigger('reset');" href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                      </div>
                      <br/><br/>
                    </form>
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
                  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                </div>
                <div class="modal-body"> 
                  <!--<p><strong>#1:</strong> Banner 1</p>-->
                  <div class="form-actions">
                    <form action="product_banner_list/deleteselectedproductbanner" method="post" name="deleteRecord">
                      <input type="hidden" name="id" id="banner_id" value="" />
                      <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                      <div class="col-md-offset-4 col-md-8"> <a onclick="deleteRecord.submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <script>
								function addproductBannerlist(){
									var form_data = new window.FormData($('#product_banner_list')[0]);
																
									$.ajax({			
										url: 'product_banner_list/addproductbanner',
										type:'post',
										dataType:'json',
										data: form_data,
										enctype: 'multipart/form-data',
										processData: false,
										contentType: false,
										success: function(response) {			
											if(response['error'])
											{
												$('#errorAddProductBannerList').remove();
												$('#successAddProductBannerList').remove();
												var error = '<div id="errorAddProductBannerList" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
												if(response['error']=='This Email Id is already in use.'){
													error += '<p>'+ response['error'] +'</p>';
												}else{
													for(var i=0; i < response['error'].length; i++)
													{
														error += '<p>'+ response['error'][i] +'</p>';
													}
												}
													error += '</div>';
													$('#product_banner_list').before(error);	
												}
																				
												if(response['success'])
												{
													$('#errorAddProductBannerList').remove();
													$('#successAddProductBannerList').remove();
													var success = '<div id="successAddProductBannerList" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></div>';
													$('#product_banner_list').before(success);
																				
													$('.product_banner_list').live('load');
													
													setTimeout(function(){
									   					window.location.reload(1);
													}, 2000);
												}
											}
										});
									}
							</script>
                  
                  <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                </div>
                <div class="modal-body">
                  <div class="form-actions">
                    <div class="col-md-offset-4 col-md-8"> <a href="product_banner_list/deleteselectedAllproductdata" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                  <option  <?php if($rec==10)echo ("selected=selected")?> value="{{ url('/web88cms/product_banner_list?rec=10') }}">10</option>
                  <option  <?php if($rec==20)echo ("selected=selected")?> value="{{ url('/web88cms/product_banner_list?rec=20') }}">20</option>
                  <option  <?php if($rec==30)echo ("selected=selected")?> value="{{ url('/web88cms/product_banner_list?rec=30') }}" >30</option>
                  <option  <?php if($rec==50)echo ("selected=selected")?> value="{{ url('/web88cms/product_banner_list?rec=50') }}">50</option>
                  <option  <?php if($rec==100)echo ("selected=selected")?> value="{{ url('/web88cms/product_banner_list?rec=100') }}">100</option>
                </select>
                      &nbsp;
                      <label class="control-label">Records per page</label>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br/>
                  <br/>
                  <div class="table-responsive mtl">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th width="1%"><input type="checkbox"/></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Category</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <script>
								function selectForDelete(){
										$('#banner_id').val('');
										
										$('input.select_items').each(function(){
						
											if($(this).is(':checked'))
											{
												id = $(this).attr('value');
												
												if($('#banner_id').val() == '')
													$('#banner_id').val(id);
												else
												{
													a = $('#banner_id').val();
													
													$('#banner_id').val(a+','+id);	
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
											
										selectForDelete();
									});	
								});
							</script>
                        <tbody>
                        <?php
							 	//echo '<pre>'; print_r($result); echo '</pre>';
							 
							 	$j = $result['start_from'];
								foreach($result['banner_productdata'] as $details)
								{
									$status_class = ($details->status == '1'&&( date("Y-m-d")<=($details->end_date))) ? 'label-success' : 'label-red';
									$status = ($details->status == '1')&&( date("Y-m-d")<=($details->end_date))? 'Active' : 'In-active';
								?>
                          <tr>
                             <td><input type="checkbox" value="<?php echo $details->id; ?>" onclick="selectForDelete();" class="select_items"/></td>
                <td><?php echo ++$j; ?></td>
                <td><span class="label label-sm <?php echo $status_class; ?>" id="banner-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                <td><?php echo $details->title; ?></td>
                <td><?php  $input= $details->start_date; 
							$old_date = date($input);
                               echo  $new_date = date('dS M, Y', strtotime($old_date));?></td>
                <td><?php $input2= $details->end_date;
						 $old_date2 = date($input2);
                               echo  $endnew_date = date('dS M, Y', strtotime($old_date2));?></td>
                <td><?php 
				 // echo $category=$details->category; 
				  
							
							$catid= $details->category;
							
							  $i = 1;
							foreach($result['getcategories'] as $catdataname)
							{
							 if($catdataname->id==$catid)
							 {echo $catdataname->title;}
							 $i++;
							 }
							?></td>
                            <td>
                            <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-banner-<?php echo $details->id; ?>" data-toggle="modal" id="edit_link_<?php echo $details->id; ?>" title="Edit"> <span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> 
                <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-<?php echo $details->id; ?>" data-toggle="modal"> <span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> 
                  <!--Modal Edit banner start-->
                  
                  <div id="modal-edit-banner-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                      <a name="edit"></a>
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                          <h4 id="modal-login-label2" class="modal-title">Edit Banner</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form">
                          <form class="form-horizontal" name="editproductbanner-<?php echo $details->id; ?>" id="editproductbanner-<?php echo $details->id; ?>" enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                            <div class="form-group">
                              <label class="col-md-3 control-label">Status</label>
                              <div class="col-md-6">
                                <div data-on="success" data-off="primary" class="make-switch">
                                  <?php  
											if($details->status=='1'){ $check='checked="checked"';}else { $check='';}?>
                                  <input id="status" type="checkbox" name="status"  <?php echo $check;?>   />
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Title <span class='require'>*</span> </label>
                              <div class="col-md-6">
                                <input required="required" id="title" type="text" class="form-control" placeholder="Banner 1" name="title" value="<?php echo $details->title; ?>" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                              <div class="col-md-6">
                                <div class="xs-margin"></div>
                                <?php  $category=$details->category;
								 ?>
                                
                                <select id="category" class="form-control editselect" name="category">
                                <option value="">- Select Category -</option>
                                   <?php
								   		$categories=$result['categories'];
										echo $categories=str_replace('"'.$details->category.'"', '"'.$details->category.'" selected="selected"', $categories);
									?>
                                    </select>
                                
                              
                                <?php  if($details->tick==1){ $check='checked="checked"';}else { $check='';}?>
                                <input id="tick" type="checkbox" name="tick" value="1"  <?php  echo $check ;?> />
                                Please tick this box to apply banner to its sub category. </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Upload Banner <span class='require'>*</span></label>
                              <div class="col-md-9">
                                <div class="text-15px margin-top-10px"> <br/>
                                  
                                  <?php if($details->banner!='')
												 {?>
                                  <img  alt="" src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/product/', $details->banner?>" class="img-responsive" />
                                  <?php }?>
                                  <br/>
                                   <input type="file" name="banner" id="banner<?php echo $details->id; ?>" onchange="chkSizebanner('<?php echo $details->id; ?>');" />
                                      
                                  <input type="hidden" name="bannername" value="<?php echo $details->banner?>" />
                                  <span class="help-block">(Image dimension: 870 x 280 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Start Date to End Date</label>
                              <div class="col-md-6">
                                <div class="input-group input-daterange">
                                  <input type="text" name="start_date" required="required" class="form-control" id="start_date" placeholder="1st Mar, 2015" value="<?php
											    echo $new_date;  ?>"/>
                                  <span class="input-group-addon">to</span>
                                  <input type="text" name="end_date" required="required" class="form-control" id="end_date" placeholder="03rd Mar ,2015" value="<?php echo $endnew_date; ?>"/>
                                </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-actions">
                              <div class="col-md-offset-5 col-md-8"> <a href="#edit" onClick="chkSizebanner('<?php echo $details->id; ?>'); ediproductbanner(<?php echo $details->id;  ?>);" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a> &nbsp; <a onClick="$('.form-horizontal').trigger('reset');" href="#" data-dismiss="modal" class="btn btn-green">Cancel
                                &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                            </div>
                            
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            
            <!--END MODAL Edit Montage--> 
            <!--Modal delete start-->
            <div id="modal-delete-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this banner? </h4>
                  </div>
                  <div class="modal-body">
                    <p><strong>#<?php echo $j; ?>:</strong> <?php echo $details->title;?></p>
                    <div class="form-actions">
                      <div class="col-md-offset-4 col-md-8">
                        <form  name="deleteform" id="deleteform<?php echo $details->id; ?>" method="post" action="product_banner_list/deleteproductbanner" enctype="multipart/form-data" >
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                         <!-- <span class="btn btn-red">
                          <input  type="submit" value="Yes" class="btn btn-red" name="submit" id="submit"  style="margin:0px; padding:0px;"/>
                          <i class="fa fa-check"></i></span>-->
                        </form>
                        <a href="javascript:" class="btn btn-red" onclick="document.getElementById('deleteform<?php echo $details->id; ?>').submit()">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                        &nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <!-- modal delete end -->
                               
                            </td>
                          </tr>
                          <?php //$i++; 
								}
			?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="8"></td>
                          </tr>
                        </tfoot>
                      </table>
                      
                      
                         <script>
				function ediproductbanner(Id){
					var form_data = new window.FormData($('#editproductbanner-'+Id)[0]);
												
					$.ajax({			
						url: 'product_banner_list/updateproductbanner',
						type:'post',
						dataType:'json',
						data: form_data,
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false,
						success: function(response) {			
							if(response['error'])
							{
								$('#errorEditProductBannerList').remove();
								$('#successEditProductBannerList').remove();
								var error = '<div id="errorEditProductBannerList" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
								if(response['error']=='This Email Id is already in use.'){
									error += '<p>'+ response['error'] +'</p>';
								}else{
									for(var i=0; i < response['error'].length; i++)
									{
										error += '<p>'+ response['error'][i] +'</p>';
									}
								}
									error += '</div>';
										$('#editproductbanner-'+Id).before(error);	

								}
																
								if(response['success'])
								{
									$('#errorEditProductBannerList').remove();
									$('#successEditProductBannerList').remove();
									var success = '<div id="successEditProductBannerList" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></p></div>';
									$('#editproductbanner-'+Id).before(success);
																
									$('.editproductbanner-'+Id).live('load');
									
									setTimeout(function(){
										window.location.reload(1);
									}, 2000);
								}
							}
						});
					}
			</script>
          <div class="tool-footer text-right">
              <p class="pull-left"><?php echo($result['msg']);?><!--Showing 1 to 10 of 57 entries--></p>
              <ul class="pagination pagination mtm mbm">
                <?php 
				if((isset($_GET['page'])&&($_GET['page']==1))||$result['total_pages']==1 || !isset($_GET['page']))
			
			   {
				 $disabled1= 'class="disabled"';
			   }
			   else
			   {$disabled1= '';}
				echo "<li ".$disabled1."><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/product_banner_list?page=1>".'&laquo;'."</a></li> "; // Goto 1st page
				$total_pages=($result['total_pages']);
			   for ($i=1; $i<=$total_pages; $i++) { 
			
			    if(isset($_GET['page'])&&($_GET['page']==$i))
			   {
				 $active= 'class="active"';
			   }
			   else
			   {$active= '';}
			echo "<li ".$active." ><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/product_banner_list?page=".$i.">".$i."</a></li> "; 
}; 
             if((isset($_GET['page'])&&($_GET['page']==$total_pages)) || $total_pages==1)
			
			   {
				 $disabled= 'class="disabled"';
			   }
			   else
			   {$disabled= '';}
            echo "<li ".$disabled."><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/product_banner_list?page=$total_pages>".'&raquo;'."</a></li> "; // Goto last page
?>
              </ul>
            </div>
                      <div class="clearfix"></div>
                   </div>
                  
                </div>
              </div> 
             
              
            </div>
            
            
          </div>
          <!-- end row -->
        </div>
      
  <div class="page-footer">
  <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
    <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png')}}" alt="Webqom Technologies Sdn Bhd"></div>
  </div>

  
</div>

<script src="{{ URL::asset('public/admin/js/jquery-1.9.1.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/jquery-ui.js') }}"></script>

<script src="{{ URL::asset('public/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/html5shiv.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/respond.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/slimScroll/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/jquery.menu.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/jquery-pace/pace.min.js') }}"></script>


<script src="{{ URL::asset('public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/form-components.js') }}"></script>


<script src="{{ URL::asset('public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/ui-tabs-accordions-navs.js') }}"></script>


<script src="{{ URL::asset('public/admin/js/main.js') }}"></script>
<script src="{{ URL::asset('public/admin/js/holder.js') }}"></script>
@endsection


 