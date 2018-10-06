@extends('adminBannerLayout')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

<script type="text/javascript"> 
function chkSize(id){
	if($('#pdf_link'+id).val()!=''){
		var size = $('#pdf_link'+id)[0].files[0].size;
		if(size/1024>2048){
			alert("Error! PDF file size exceeds its limit. Please try again.");
			$('#pdf_link'+id).replaceWith($('#pdf_link'+id).clone());	
			return false;
		}
	}
}
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
function chkSizeenlargebanner(id){
	if($('#enlarge_banner'+id).val()!=''){
		var size = $('#enlarge_banner'+id)[0].files[0].size;
		if(size/1024>2048){
			alert("Error!  enlarge banner file size exceeds its limit from 2MB . Please try again.");
			$('#enlarge_banner'+id).replaceWith($('#enlarge_banner'+id).clone());	
			return false;
		}
	}
}

function enlarge(ID)
{
	$( "#enlarge_banner"+ID ).change(function() {
	
	$('#pdf_link'+ID).attr('disabled', 'disabled');
	
    $('#url'+ID).attr('disabled', 'disabled');
	});
}
function pdf(ID)
{
	$( "#pdf_link"+ID ).change(function() {
	$('#enlarge_banner'+ID).attr('disabled', 'disabled');
	
    $('#url'+ID).attr('disabled', 'disabled');
	});
}

function urllink(ID)
{
	if(document.getElementById('url'+ID).value!='')
	{
		$('#enlarge_banner'+ID).attr('disabled', 'disabled');
	
    	$('#pdf_link'+ID).attr('disabled', 'disabled');
	}else{
		$('#enlarge_banner'+ID).removeAttr('disabled');
	
    	$('#pdf_link'+ID).removeAttr('disabled');
	}
}


</script>



<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Banners</h1>
          </div>
           <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="">Banners</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Banners &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Left Promotion Banners - Listing</li>
          </ol>
        </div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Left Promotion Banners <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              <p>@if (Session::has('flash_message'))
        <div class="alert alert-success alert-dismissable">
          <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
          <i class="fa fa-check-circle"></i> <strong>Success!</strong> {{ Session::get('flash_message') }}</div>
          @endif 
        </p>
         {{ $error = Session::get('error') }}
            {{ Session::get('error') }}
            @if($error)
         		<div class="alert alert-danger alert-dismissable">
          			<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
          			<i class="fa fa-times-circle"></i> <strong>Error!</strong>
          			<p>{{ $error }}</p>
                </div>
        	@endif 
            <!--  <div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>
              -->
               <div class="pull-left"> Last updated: <span class="text-blue"><?php if(isset($result['lastUpdated'])&&(($result['lastUpdated'])!='')){echo date("d M, Y @ H.i A", strtotime($result['lastUpdated']));}?></span> </div>
         <div class="clearfix"></div>
              <p></p>
              
              
              <div class="clearfix"></div>
              
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Left Promotion Banners Listing</div>
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
                  <!--Modal Add New Banner start-->
                  <div id="modal-add-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                      	<a name="add"></a>
                        <div class="modal-header">
                          <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label2" class="modal-title">Add New Banner</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form">
                            <form  method="post" class="form-horizontal" id="banner_left_promotion" name="banner_left_promotion"  action="left_promotion_banner_list/addleftpromotionbanner" enctype="multipart/form-data">
                        <script type="text/javascript">
//Edit the counter/limiter value as your wish
var count = "70";
//Example: var count = "175";
function limiters(){
var tex = document.banner_left_promotion.short_description.value;
var len = tex.length;
if(len > count){
tex = tex.substring(0,count);
document.banner_left_promotion.short_description.value =tex;
return false;
}
document.banner_left_promotion.limit.value = count-len;
}
</script>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
                                 <input id="title" type="text" class="form-control" placeholder="Banner 1" name="title"  required="required" >
                                </div>
                                <div class="col-md-3">
                                      
                                    </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Short Description </label>
                                  <div class="col-md-6">
                                     <textarea id="short_description0"  onkeyup=limiters() name="short_description" cols="" rows="" class=" short4 form-control" placeholder="text is limited to 70 words only including space."></textarea> 
                                     <script type="text/javascript">
									document.write("<input type=text name=limit size=4 readonly value="+count+">");
									</script> <span>word count</span>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-md-3 control-label">Upload Banner <span class='require'>*</span></label>
                                <div class="col-md-9">
                                  <div class="text-15px margin-top-10px">
                                    <input type="file" name="banner" id="banner0" required="required"  onchange="chkSizebanner('0');"/>
                             
                                    <br/>
                                    <span class="help-block">(Image dimension: 270 x 120 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                              	<label class="col-md-3 control-label">Start Date to End Date <span class='require'>*</span></label>
                                <div class="col-md-6">
                                  	<div class="input-group input-daterange">
                                    <input type="text" name="start_date" class="form-control" id="start_date" required="required" placeholder="1st Mar, 2015" />
                              <span class="input-group-addon">to</span>
                              <input type="text" name="end_date" class="form-control" id="end_date" required="required" placeholder="03rd Mar ,2015" />
                           
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                          <label class="col-md-3 control-label">Display Order <span class='require'>*</span></label>
                                          <div class="col-md-2">
                                           <input type="text" class="form-control" placeholder="1" id="display_order" name="display_order" required="required" >
                                          </div>
                                          <div class="col-md-9 pull-right"> <span class="help-block">Display order is to determine the item appearing sequence in the website.</span> </div>
                                        </div>
                                      
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Upload Enlarge Banner or</label>
                                        <div class="col-md-9">
                                          <p class="text-blue margin-top-10px border-bottom">Please choose <strong>ONE</strong> of the following options when clicking on the banner for enlarge/detailed view.</p>
                                          <div class="text-15px margin-top-10px">
                                           <input id="enlarge_banner0" type="file" name="enlarge_banner" onchange="chkSizeenlargebanner('0');" onClick="enlarge('0'); return;"  />
                               <br/>
                                            <span class="help-block">(JPEG/GIF/PNG only, Max. 2MB) </span> </div>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Upload PDF(<span class="text-blue"> limit is 2 MB </span>) or </label>
                                        <div class="col-md-9">
                                          <div class="text-15px margin-top-10px">
                                          <input id="pdf_link0" type="file" name="pdf_link" onClick="pdf(0); return;" onchange="chkSize('0');"  />
                                            <br/>
                                          </div>
                                        </div>
                                      </div>
                                         
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Website URL</label>
                                          <div class="col-md-6">
                                            <div class="input-icon"><i class="fa fa-link"></i>
                                               <input type="text" placeholder="http://" class="form-control" name="url" id="url0" onkeyup="urllink(0); return;" onmouseout="urllink(0); return;"  />
                             <span class="help-block">Please enter the page link to link it to the sub page.</span> </div>
                                          </div>
                                        </div>
                              <div class="clearfix"></div>
                              
                              
                              <div class="form-actions">
                              
                             <!-- <input type="submit" value="submit" name="submit" id="submit">--> 
                          <div class="col-md-offset-5 col-md-8"> <a href="#add" onclick="chkSize('0');chkSizebanner('0');chkSizeenlargebanner('0'); addleftpromotionBanner();" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$('.form-horizontal').trigger('reset');" href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                        </div>
                            </form>
                            <script>
								function addleftpromotionBanner(){
									var form_data = new window.FormData($('#banner_left_promotion')[0]);
																
									$.ajax({			
										url: 'left_promotion_banner_list/addleftpromotionbanner',
										type:'post',
										dataType:'json',
										data: form_data,
										enctype: 'multipart/form-data',
										processData: false,
										contentType: false,
										success: function(response) {			
											if(response['error'])
											{
												$('#errorAddLeftPromotion').remove();
												$('#successAddLeftPromotion').remove();
												var error = '<div id="errorAddLeftPromotion" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
												if(response['error']=='This Email Id is already in use.'){
													error += '<p>'+ response['error'] +'</p>';
												}else{
													for(var i=0; i < response['error'].length; i++)
													{
														error += '<p>'+ response['error'][i] +'</p>';
													}
												}
													error += '</div>';
													$('#banner_left_promotion').before(error);	
												}
																				
												if(response['success'])
												{
													$('#errorAddLeftPromotion').remove();
													$('#successAddLeftPromotion').remove();
													var success = '<div id="successAddLeftPromotion" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></div>';
													$('#banner_left_promotion').before(success);
																				
													$('.banner_left_promotion').live('load');
													
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
                  <!--END MODAL Add New banner -->
                  <!--Modal delete selected items start-->
                  <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                        </div>
                        <div class="modal-body">
                          <!--<p><strong>#1:</strong> Hot Selling</p>-->
                          <div class="form-actions">
                            <form action="left_promotion_banner_list/deleteselectedleftpromotionbanner" method="post" name="deleteRecord">
                          		<input type="hidden" name="id" id="banner_id" value="" />
                        		<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                            	<div class="col-md-offset-4 col-md-8"> <a onclick="deleteRecord.submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          	</form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete selected items end -->
                  <!--Modal delete all items start-->
                  <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="left_promotion_banner_list/deleteselectedAllleftpromotiondata" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete all items end -->
                </div>
                <div class="portlet-body">
                  <div class="form-inline pull-left">
                    <div class="form-group">
                     <?php $rec=10; if(isset($_GET['rec'])&&($_GET['rec']!='')){$rec=$_GET['rec'];}?>
                      <select name="select_record" class="form-control" id="select_record" onchange="if (this.value) window.location.href=this.value">
                  <option <?php if($rec==10)echo ("selected=selected")?> value="{{ url('/web88cms/left_promotion_banner_list?rec=10') }}">10</option>
                  <option  <?php if($rec==20)echo ("selected=selected")?> value="{{ url('/web88cms/left_promotion_banner_list?rec=20') }}">20</option>
                  <option <?php if($rec==30)echo ("selected=selected")?> value="{{ url('/web88cms/left_promotion_banner_list?rec=30') }}" >30</option>
                  <option  <?php if($rec==50)echo ("selected=selected")?> value="{{ url('/web88cms/left_promotion_banner_list?rec=50') }}">50</option>
                  <option <?php if($rec==100)echo ("selected=selected")?> value="{{ url('/web88cms/left_promotion_banner_list?rec=100') }}">100</option>
                </select>
                      &nbsp;
                      <label class="control-label">Records per page</label>
                    </div>
                  </div>
                  <div class="pull-right"> <a href="javascript:" onclick="document.getElementById('updatedisplayleftpromotionbanner').submit();"   name="Update_Display_Order"class="btn btn-danger">Update Display Order &nbsp;<i class="fa fa-refresh"></i></a>   
		      </div>
                  <div class="clearfix"></div>
                  <br/>
                  <br/>
                  <div class="table-responsive mtl" >
                      <table class="table table-hover table-striped">
                      
                        <thead>
                          <tr>
                            <th width="1%"><input type="checkbox" id="select_items"/></th>
                            <th>#</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th width="12%">Display Order</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
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
                            <script>
							function uniquefun(val, sn)
							{ 
								var inputs = $(".alldisplayord");

								for(var i = 0; i <= inputs.length; i++){
									if($(inputs[i]).val()==val && i!=sn-1){
										alert("Order '"+val+"' is already in use. Please try another!");
										return false;	
									}
								}
							}
							</script>
                            
                            
                            <form action="left_promotion_banner_list/updateallleftpromotionbanner" method="post" name="updatedisplayleftpromotionbanner" id="updatedisplayleftpromotionbanner" enctype="multipart/form-data" >
                          		
                        		
                                <input type="hidden" id="up_csrf_token" name="_token"  value="{{ csrf_token() }}" />
                                <?php foreach($result['banner_allleftpromotiondata'] as $details)
								{?>
                                 <input type="hidden" name="display_order[<?php echo $details->id; ?>]" id="displayorder_<?php echo $details->id; ?>" class="form-control" value="<?php echo $details->display_order; ?>">
                                 <input type="hidden" class="alldisplayord" value="<?php echo $details->display_order; ?>">
                  <?php } ?>
                    </form>
                         <?php
							 	//echo '<pre>'; print_r($result); echo '</pre>';
							 
							 	$i = $result['start_from'];
								foreach($result['banner_leftpromotiondata'] as $details)
								{
									$status_class = ($details->status == '1'&&( date("Y-m-d")<=($details->end_date))) ? 'label-success' : 'label-red';
									$status = ($details->status == '1')&&( date("Y-m-d")<=($details->end_date))? 'Active' : 'In-active';
								?>
                          <tr>
                          
                            <td><input type="checkbox" value="<?php echo $details->id; ?>" onclick="selectForDelete();" class="select_items"/></td>
                            <td><?php echo ++$i; ?></td>
                            <td><span class="label label-sm <?php echo $status_class; ?>" id="banner-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                    <td><?php echo $details->title; ?></td>
                    <td><?php  $input= $details->start_date; 
                           $old_date = date($input);
                               echo  $new_date = date('dS M, Y', strtotime($old_date));?></td>
                    <td><?php $input2= $details->end_date;
						 $old_date2 = date($input2);
                               echo  $endnew_date = date('dS M, Y', strtotime($old_date2));?></td>
                               <td>
                               
                         <input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, <?php echo $i;?>);document.getElementById('displayorder_<?php echo $details->id; ?>').value=this.value" class="form-control displayord" value="<?php echo $details->display_order; ?>">
                  </td>
                    <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-banner-<?php echo $details->id; ?>" data-toggle="modal" id="edit_link_<?php echo $details->id; ?>" title="Edit"> <span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-<?php echo $details->id; ?>" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> 
                       <!--Modal Edit banner start-->
                              <div id="modal-edit-banner-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-wide-width">
                                  <div class="modal-content">
                                  <a name="edit"></a>
                                    <div class="modal-header">
                                      <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                      <h4 id="modal-login-label2" class="modal-title">Edit Banner</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form" >
                                        <form class="form-horizontal" name="editleftpromotionbanner-<?php echo $details->id; ?>" id="editleftpromotionbanner-<?php echo $details->id; ?>" enctype="multipart/form-data" >
                                  <script type="text/javascript">

(function($){
	$.fn.textareaCounter<?php echo $details->id; ?> = function(options) { 
		// setting the defaults
		// $("textarea").textareaCounter({ limit: 100 });
		var defaults = {
			limit: 70
		};	
		var options = $.extend(defaults, options);
 
		// and the plugin begins
		return this.each(function() {
			var obj, text, wordcount, limited;
			var count = "70";
			obj = $(this);
			obj.after('<span style="font-size: 11px; clear: both; margin-top: 3px; display: block;" id="counter-text<?php echo $details->id; ?>"></span>');

			obj.keyup(function() {
			    text = obj.val();
				
			    if(text === "") {
			    	wordcount = 0;
			    } else {
				    wordcount = text;
					var len = wordcount.length;
					var remain= count-len ;
					if(len>count){
						 wordcounttotal = text.substring(0,count);
						// alert (wordcounttotal);
					
					document.getElementById('short_description<?php echo $details->id; ?>').value = wordcounttotal; remain =0;}
					 document.getElementById('mylimit<?php echo $details->id; ?>').value  = remain;
					 return false;
					
					
				}
				
				document.getElementById('mylimit<?php echo $details->id; ?>').value  = remain;
				
			  
			});
		});
	};
})(jQuery);
</script>
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
                                            <label class="col-md-3 control-label">Title<span class='require'>*</span> </label>
                                            <div class="col-md-6">
                                              <input  required="required" id="title" type="text" class="form-control" placeholder="Banner 1" name="title" value="<?php echo $details->title; ?>"   >
                                    </div>
                                          </div>
                                          <div class="form-group">
                                      <label class="col-md-3 control-label">Short Description</label>
                                      <div class="col-md-6">
                                          <textarea id="short_description<?php echo $details->id; ?>" name="short_description" cols="" rows="" class="short2 form-control" placeholder="text is limited to 70 words only including space."><?php echo $details->short_description; ?></textarea> 
                                        <script type="text/javascript">
	                                    $("#short_description<?php echo $details->id; ?>").textareaCounter<?php echo $details->id; ?>();
										document.write("<input type=text name=mylimit id=mylimit<?php echo $details->id; ?> size=4 readonly value="+count+">");
	                                   </script>
                                      </div>
                                  </div>
     
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Upload Banner <span class='require'>*</span></label>
                                            <div class="col-md-9">
                                              <div class="text-15px margin-top-10px">
                                                <br/>
                                                
                                        <?php if($details->banner!='')
												 {?>
                                        <img  alt="" src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/leftpromotion/', $details->banner?>" class="img-responsive" />
                                        <?php }?>
                                                <br/>
                                                <input type="file" name="banner" id="banner<?php echo $details->id; ?>" onchange="chkSizebanner('<?php echo $details->id; ?>');" />
                                        
                                        <input type="hidden" name="bannername" value="<?php echo $details->banner?>" />
                                                <span class="help-block">(Image dimension: 270 x 120 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Start Date to End Date <span class='require'>*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group input-daterange">
                                              <input type="text" name="start_date" required="required" class="form-control" id="start_date" placeholder="1st Mar, 2015" value="<?php
											    echo $new_date;  ?>"/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" name="end_date" class="form-control" required="required" id="end_date" placeholder="03rd Mar ,2015" value="<?php echo $endnew_date; ?>"/>
                                     
                                                </div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Display Order <span class='require'>*</span></label>
                                              <div class="col-md-2">
                                      <input type="text" class="form-control" placeholder="1" id="display_order" name="display_order" required="required" value="<?php echo $details->display_order; ?>">
                                    </div>
                                              <div class="col-md-9 pull-right"> 
                                              <span class="help-block">Display order is to determine the item appearing sequence in the website.</span> </div>
                                            </div>
    
                                        <div class="form-group">
                                  <label class="col-md-3 control-label">Upload Enlarge Banner or</label>
                                  <div class="col-md-9">
                                    <p class="text-blue margin-top-10px border-bottom">Please choose <strong>ONE</strong> of the following options when clicking on the banner for enlarge/detailed view.</p>
                                    <div class="text-15px margin-top-10px"> <!--<img src="../images/homeslider/slide1_large.jpg" alt="Banner" class="img-responsive"><--><br/>
                                    <div id="enl-ban<?php echo $details->id; ?>" class="enb">
									<?php if($details->enlarge_banner!='')
												 {?>
                                    <img alt="" src="<?php echo "http://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/leftpromotion/', $details->enlarge_banner?>" class="img-responsive" /> <br/>
                                  <br/>  
                                   <a href="javascript:void(0);" data-hover="tooltip" data-placement="top" title="Delete" data-target="#enlargemodal-delete-<?php echo $details->id; ?>" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> 
                                     
                                   
                                    <?php }?>
                                    <br/>
                                    <br/>
                                   <input id="enlarge_banner<?php echo $details->id; ?>" type="file" name="enlarge_banner" onchange="chkSizeenlargebanner('<?php echo $details->id; ?>');" onClick="enlarge('<?php echo $details->id; ?>'); return;" <?php if(($details->pdf_link!='')||($details->url!='')){ echo 'disabled="disabled"'; }?>/>
                                    <input type="hidden" name="enlarge_bannername" value="<?php echo $details->enlarge_banner?>" />
                                    </div>
                                      <span class="help-block">(JPEG/GIF/PNG only, Max. 2MB) </span> </div>
                                  </div>
                                </div>
                                  <div class="form-group">
                                  <label class="col-md-3 control-label">Upload PDF(<span class="text-blue"> Max. file size: 2MB</span> ) or</label>
                                  <div class="col-md-9">
                                    
                                    <div class="text-15px margin-top-10px">
                                     <div id="pdf-data<?php echo $details->id; ?>" class="pdf-data">
                                    <?php if($details->pdf_link!='')
												 {?>
                                    <a href="<?php echo "http://".$_SERVER['HTTP_HOST']. '/laravel/public/admin/images/banner/leftpromotion/', $details->pdf_link?>"><?php echo $details->pdf_link;?></a> <br/>
                                    <a href="javascript:void(0);" data-hover="tooltip" data-placement="top" title="Delete" data-target="#pdfmodal-delete-<?php echo $details->id; ?>" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> 
                                 
                                  
                                   <!--<input type="checkbox"  id="Delete_pdf_link" name="Delete_pdf_link" value="1"  class="select_itemspdf"/>
                                    click here to Remove selected pdf link-->
                                    <?php }?>
                                    <br/>
                                    <br/>
                                    <input id="pdf_link<?php echo $details->id; ?>" type="file" name="pdf_link" onchange="chkSize('<?php echo $details->id; ?>');" onClick="pdf('<?php echo $details->id; ?>'); return;" <?php if(( $details->enlarge_banner!='')||($details->url!='')){ echo 'disabled="disabled"'; }?>/>
                                    <input type="hidden" name="pdf_linkname" value="<?php echo $details->pdf_link?>" />
                                  </div></div>
                                  </div>
                                </div>
                                  <div class="form-group">
                                  <label class="col-md-3 control-label">Website URL</label>
                                  <div class="col-md-6">
                                    <div class="input-icon"><i class="fa fa-link"></i>
                                      <div id="urlldata<?php echo $details->id; ?>" class="urlldata">
                                    <input type="text" placeholder="http://" class="form-control" name="url" id="url<?php echo $details->id; ?>" onkeyup="urllink('<?php echo $details->id; ?>'); return;" onmouseout="urllink('<?php echo $details->id; ?>'); return;"   value="<?php if(($details->url)!=''){echo $details->url;}  ?>" <?php if(( $details->enlarge_banner!='')||($details->pdf_link!='')){ echo 'disabled="disabled"'; }?>/>
                                    </div>
                                      <span class="help-block">Please enter the page link to link it to the sub page.</span> </div>
                                  </div>
                                </div>
                                          <div class="clearfix"></div>
                                          
                                          <div class="form-actions">
                                            <div class="col-md-offset-5 col-md-8">
                                              <a href="#edit" onClick="chkSize('<?php echo $details->id; ?>');chkSizebanner('<?php echo $details->id; ?>');chkSizeenlargebanner('<?php echo $details->id; ?>'); editleftpromotionbanner(<?php echo $details->id;  ?>);" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$('.form-horizontal').trigger('reset');" href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                </div>
                                         
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div >
                              <!--END MODAL Edit Montage-->
                                <!--Modal delete start-->
                                <div id="modal-delete-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this banner? </h4>
                                      </div>
                                      <div class="modal-body">
                                        <p><strong>#<?php echo $i; ?>:</strong> <?php echo $details->title; ?></p>
                                        <div class="form-actions">
                                          <div class="col-md-offset-4 col-md-8" > 
                                          <form  name="deleteform" id="deleteform<?php echo $details->id; ?>" method="post" action="left_promotion_banner_list/deleteleftpromotionbanner" enctype="multipart/form-data" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   
                                    <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                                    <a onclick="javascript:document.getElementById('deleteform<?php echo $details->id; ?>').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; 
                          			<a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> 
                                    </form>
                                    </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <!-- modal delete end -->
                                <!--add trash file-->
                  
                  <div id="enlargemodal-delete-<?php echo $details->id; ?>" tabindex="99999" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this  enlarge banner image ? </h4>
                        </div>
                        <div class="modal-body">
                          <p><strong>#:</strong> <?php echo $details->enlarge_banner; ?></p>
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8">
                              <form  name="delete_enlarge" id="delete_enlarge<?php echo $details->id; ?>" method="post" action="left_promotion_banner_list/delete_enlarge" enctype="multipart/form-data" class="delete_enlarge<?php echo $details->id; ?>" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="method" value="deletetop_enlargebanner_image" id="deletetop_enlargebanner_image">
                                <input type="hidden" name="enl-banner" value="<?php echo $details->enlarge_banner; ?>" id="enl-banner">
                                <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                                <a onclick="deletemiddleopenlargeBanner<?php echo $details->id; ?>();" data-dismiss="modal" aria-hidden="true" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                              </form>
                              <script>
											function deletemiddleopenlargeBanner<?php echo $details->id; ?>(){
												
												var form_data = new window.FormData($('#delete_enlarge<?php echo $details->id; ?>')[0]);
												
												$.ajax({			
													url: 'left_promotion_banner_list/delete_enlarge',
													type:'post',
													dataType:'json',
													data: form_data,
													enctype: 'multipart/form-data',
													processData: false,
													contentType: false,
													success: function(response) {
														if(response['success'])
															{
																$('#successdelete_enlarge<?php echo $details->id; ?>').remove();
																var success = '<div id="successdelete_enlarge<?php echo $details->id; ?>" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></p></div>';
																$('#delete_enlarge<?php echo $details->id; ?>').before(success);
																$("#enl-ban<?php echo $details->id; ?>").html('<input id="enlarge_banner<?php echo $details->id; ?>" type="file" name="enlarge_banner" onchange="chkSizeenlargebanner(<?php echo $details->id; ?>);" onClick="enlarge(<?php echo $details->id; ?>); return;"  /><input type="hidden" name="enlarge_bannername" value="" />');
																$("#pdf-data<?php echo $details->id; ?>").html('<input id="pdf_link<?php echo $details->id; ?>" type="file" name="pdf_link"  onchange="chkSize(<?php echo $details->id; ?>);" onClick="pdf(<?php echo $details->id; ?>); return;"  /><input type="hidden" name="pdf_linkname" value="" />');
																$("#urlldata<?php echo $details->id; ?>").html('<input type="text" placeholder="http://" class="form-control" name="url" id="url<?php echo $details->id; ?>" onClick="urllink(<?php echo $details->id; ?>); return;"  />');
															
																
															}
														}
													});
													  // avoid to execute the actual submit of the form.
												}
										</script> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!--add trash file end-->
                
                    <!--pdf trash data-->
     <div id="pdfmodal-delete-<?php echo $details->id; ?>" tabindex="99999" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button onClick="$('.form-horizontal').trigger('reset');" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this  PDF  ? </h4>
                        </div>
                        <div class="modal-body">
                          <p><strong>#:</strong> <?php echo $details->pdf_link; ?></p>
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8">
                              <form  name="delete_pdf" id="delete_pdf<?php echo $details->id; ?>" method="post" action="left_promotion_banner_list/delete_enlarge" enctype="multipart/form-data" class="delete_enlarge<?php echo $details->id; ?>" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="pd-banner" value="<?php echo $details->pdf_link; ?>" id="pd-banner">
                                <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                                <a onclick="deletemiddle_top_pdfBanner<?php echo $details->id; ?>();" data-dismiss="modal" aria-hidden="true" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                              </form>
                              <script>
											function deletemiddle_top_pdfBanner<?php echo $details->id; ?>(){
												
												var form_data = new window.FormData($('#delete_pdf<?php echo $details->id; ?>')[0]);
												
												$.ajax({			
													url: 'left_promotion_banner_list/delete_pdf',
													type:'post',
													dataType:'json',
													data: form_data,
													enctype: 'multipart/form-data',
													processData: false,
													contentType: false,
													success: function(response) {
														if(response['success'])
															{
																$('#successdelete_pdf<?php echo $details->id; ?>').remove();
																var success = '<div id="successdelete_pdf<?php echo $details->id; ?>" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></p></div>';
																$('#delete_pdf<?php echo $details->id; ?>').before(success);
																
																document.getElementById("enl-ban<?php echo $details->id; ?>").innerHTML = '<input id="enlarge_banner<?php echo $details->id; ?>" type="file" name="enlarge_banner" onchange="chkSizeenlargebanner(<?php echo $details->id; ?>);" onClick="enlarge(<?php echo $details->id; ?>); return;"  /><input type="hidden" name="enlarge_bannername" value="" />';
																document.getElementById("pdf-data<?php echo $details->id; ?>").innerHTML = '<input id="pdf_link<?php echo $details->id; ?>" type="file" name="pdf_link"  onchange="chkSize(<?php echo $details->id; ?>);" onClick="pdf(<?php echo $details->id; ?>); return;"  /><input type="hidden" name="pdf_linkname" value="" />';
																document.getElementById("urlldata<?php echo $details->id; ?>").innerHTML = '<input type="text" placeholder="http://" class="form-control" name="url" id="url<?php echo $details->id; ?>" onClick="urllink(<?php echo $details->id; ?>); return;"  />';
																
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
                  </div>
                  
<!--pdf trash data end-->   
                  
                  
                            </td>
                          </tr>
                          <?php // $i++;
						  
						  }?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="8"></td>
                          </tr>
                        </tfoot>
                      </table>
                      
                      <script>
				function editleftpromotionbanner(Id){
					var form_data = new window.FormData($('#editleftpromotionbanner-'+Id)[0]);
												
					$.ajax({			
						url: 'left_promotion_banner_list/updateleftpromotionbanner',
						type:'post',
						dataType:'json',
						data: form_data,
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false,
						success: function(response) {			
							if(response['error'])
							{
								$('#errorEditLeftPromotion').remove();
								$('#successEditLeftPromotion').remove();
								var error = '<div id="errorEditLeftPromotion" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
								if(response['error']=='This Email Id is already in use.'){
									error += '<p>'+ response['error'] +'</p>';
								}if(response['error']=='Please fill unique display order Field..'){
									error += response['error'] ;
								}
								else{
									for(var i=0; i < response['error'].length; i++)
									{
										error += '<p>'+ response['error'][i] +'</p>';
									}
								}
									error += '</div>';
										$('#editleftpromotionbanner-'+Id).before(error);	

								}
																
								if(response['success'])
								{
									$('#errorEditLeftPromotion').remove();
									$('#successEditLeftPromotion').remove();
									var success = '<div id="successEditLeftPromotion" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></p></div>';
									$('#editleftpromotionbanner-'+Id).before(success);
																
									$('.editleftpromotionbanner-'+Id).live('load');
									
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
				echo "<li ".$disabled1."><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/left_promotion_banner_list?page=1>".'&laquo;'."</a></li> "; // Goto 1st page

				$total_pages=($result['total_pages']);
			   for ($i=1; $i<=$total_pages; $i++) { 
			
			    if(isset($_GET['page'])&&($_GET['page']==$i))
			   {
				 $active= 'class="active"';
			   }
			   else
			   {$active= '';}
			echo "<li ".$active." ><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/left_promotion_banner_list?page=".$i.">".$i."</a></li> "; 
}; 
           if((isset($_GET['page'])&&($_GET['page']==$total_pages)) || $total_pages==1)
			
			   {
				 $disabled= 'class="disabled"';
			   }
			   else
			   {$disabled= '';}
            echo "<li ".$disabled."><a href= http://".$_SERVER['HTTP_HOST']."/web88cms/left_promotion_banner_list?page=$total_pages>".'&raquo;'."</a></li> "; // Goto last page
?>
              </ul>
            </div>
                      <div class="clearfix"></div>
                    </div>
                    <!-- end table responsive -->
                </div>
              </div> 
              <!-- end portlet --> 
              
            </div>
            <!-- end col-lg-12 -->
            
          </div></div>  
          <!-- end row -->
        <!--END CONTENT-->
            
            <!--BEGIN FOOTER-->
            <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
        <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png')}}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>
    <!--END FOOTER-->
  
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


 
