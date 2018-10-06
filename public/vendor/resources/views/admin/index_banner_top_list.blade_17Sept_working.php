@extends('adminBannerLayout')
@section('title', 'Top Banner')
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
			alert("Error!  enlarge banner file size exceeds its limit from 2MB. Please try again.");
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
      <li class="active">Index Top Banners - Listing</li>
    </ol>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <h2>Index Top Banners <i class="fa fa-angle-right"></i> Listing</h2>
        <div class="clearfix" id="flash_message"></div>
        <p>@if (Session::has('flash_message'))
        	<div class="alert alert-success alert-dismissable">
          		<button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
          		<i class="fa fa-check-circle"></i> <strong>Success!</strong> {{ Session::get('flash_message') }}
            </div>
          @endif
        </p>

        <!-- {{ $error = Session::get('error') }}
            {{ Session::get('error') }}-->
            @if($error)
         		<div class="alert alert-danger alert-dismissable">
          			<button type="button" data-dismiss="alert" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
          			<i class="fa fa-times-circle"></i> <strong>Error!</strong>
          			<p>{{ $error }}</p>
                </div>
        	@endif

        <div class="pull-left"> Last updated: <span class="text-blue"><?php if(isset($result['lastUpdated'])&&(($result['lastUpdated'])!='')){echo date("d M, Y @ H.i A", strtotime($result['lastUpdated']));}?></span> </div>
         <div class="clearfix"></div>
        <p></p>
        <div class="clearfix"></div>
        <div class="portlet">
          <div class="portlet-header">
            <div class="caption">Index Top Banners Listing</div>
            <br/>
            <p class="margin-top-10px"></p>
            <a href="#" data-target="#modal-add-new" data-toggle="modal" class="btn btn-success">Add New Banner &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
            <div class="btn-group">
              <button type="button" class="btn btn-primary">Delete</button>
              <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
              <ul role="menu" class="dropdown-menu">
                    	 <li><a href="#" onclick="deleteSelected()">Delete selected item(s)</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
            </div>
            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

            <!--Modal Add New Banner start-->
            <div id="modal-add-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
              <div class="modal-dialog modal-wide-width">
                <div class="modal-content">
                <a name="add"></a>
                  <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                    <h4 id="modal-login-label3" class="modal-title">Add New Banner</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form">
                      <form class="form-horizontal" name="topbanner" id="topbanner" method="post" action="" enctype="multipart/form-data" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="method" value="addtopbannerform" id="addtopbannerform">
                        <div class="form-group">
                          <label class="col-md-3 control-label">Status<span class='require'></span></label>
                          <div class="col-md-6" style="height:32px;">
                            <div data-on="success" data-off="primary" class="make-switch">
                               <input id="status" name="status" value="1" type="checkbox" checked="checked"/>
                            </div>
                          </div>
                        </div>
                        <div class="form-group " id="title_div_group_id">
                          <label class="col-md-3 control-label">Title <span class='require'></span></label>
                          <div class="col-md-6">
                            <input id="title" type="text" class="form-control"  placeholder="Banner 1" name="title"  required="required">
                          </div>
                          <div class="col-md-3" id="title_div_id">
                              <div class="popover popover-validator right" >
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                      <p class="mbn">Title is empty!</p>
                                    </div>
                              </div>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 control-label">Upload Banner <span class='require'>*</span></label>
                          <div class="col-md-9">
                            <div class="text-15px margin-top-10px">
                              <input type="file" name="banner" id="banner0" required="required" onchange="chkSizebanner('0');" />
                              <br/>
                              <span class="help-block">(Image dimension: 1920 x 580 pixels, JPEG/GIF/PNG only, Max. 1MB)</span> </div>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 control-label">Start Date to End Date<span class='require'></span></label>
                          <div class="col-md-6">
                            <div class="input-group input-daterange">
                              <input type="text" name="start_date" class="form-control" id="start_date" required="required"/>
                              <span class="input-group-addon">to</span>
                              <input type="text" name="end_date" class="form-control" id="end_date" required="required" />
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Display Order <span class='require'>*</span></label>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="1" id="display_order" name="display_order" required="required">
                          </div>
                          <div class="col-md-9 pull-right"> <span class="help-block">Display order is to determine the item appearing sequence in the website.</span> </div>
                        </div>

                         <h5 class="border-bottom">Banner Text &amp; Link Buttons</h5>
                         <p class="text-blue">Please choose <strong>ONE</strong> of the following options for adding the banner text and icon.</p>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Banner Heading Text (Middle)</label>

                                <div class="col-md-9">
                                    <input id="text" type="text" class="form-control" name="heading_text_middle"  placeholder="eg. Premier Room">
                                </div>
                           </div>

                              <div class="form-group">
                                <label class="col-md-3 control-label"> Banner Sub Heading Text (Top Line 1)</label>
                                <div class="col-md-9">
                                  <textarea  class="form-control"  name="heading_text_top_1" placeholder="eg. Special Offer"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-3 control-label"> Banner Sub Heading Text (Top Line 2)</label>
                                <div class="col-md-9">
                                  <textarea  class="form-control" name="heading_text_top_2" placeholder="eg. Always Warm &amp; Welcoming"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-3 control-label">Enable Link Button (Left)</label>
                                <div class="col-md-6">
                                  <div class="xss-margin"></div>
                                  <div class="radio-list">
                                  @foreach (config('defines.link_text_left') as $key=>  $val)
                                      <label>
                                      <input id="link_text_left_id_{{$key}}" name="link_text_left" type="radio" value="{{$val}}"/>
                                      &nbsp; {{$val}}</label>
                                  @endforeach
                                    <input type="text" class="form-control" name="link_text_left_other">
                                    <div class="margin-top-10px"></div>
                                    <label>
                                     Button URL Link: <input type="text" class="form-control" name="url_left">
                                     <div class="xss-margin"></div>
                                     <div class="text-blue text-12px">You can specify the button link to the sub pages.</div>
                                  </label>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-3 control-label">Enable Link Button (Right)</label>
                                <div class="col-md-6">
                                  <div class="xss-margin"></div>
                                  <div class="radio-list">
                                     @foreach (config('defines.link_text_right') as $key=>  $val)
                                      <label>
                                      <input id="link_text_right_id_{{$key}}" name="link_text_right" type="radio" value="{{$val}}"/>
                                      &nbsp; {{$val}}</label>
                                    @endforeach
                                    <input type="text" class="form-control" placeholder="eg. 25% off - Grand Ballroom" name="link_text_right_other">
                                    <div class="margin-top-10px"></div>
                                    <label>
                                     Button URL Link: <input type="text" class="form-control"  name="url_right">
                                     <div class="xss-margin"></div>
                                     <div class="text-blue text-12px">You can specify the button link to the sub pages.</div>
                                  </label>
                                  </div>
                                </div>
                              </div>

                              <div class="clearfix"></div>
                                <div class="form-actions">
                                  <div class="col-md-offset-5 col-md-8">
                                       <a  href="#add" onclick="chkSizebanner('0'); addmaintopBanner();"class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a onClick="$('.form-horizontal').trigger('reset');" href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                                  </div>
                                </div>
                            </form>

                      <script>
								function addmaintopBanner(){

                                      var title = $('#title').val();
                                      if(title==''){

                                        $('.popover popover-validator right').css("display", "block");
                                        $('#title_div_id').show();
                                        $('#title_div_group_id').attr('class', 'form-group has-error');

                                      } else {
                                        $('#title_div_id').hide();
                                        $('#title_div_group_id').attr('class', 'form-group');
                                      }

									var form_data = new window.FormData($('#topbanner')[0]);

									$.ajax({
                                        url: 'index_banner_top_list/addtopbanner',
                                        type:'post',
                                        dataType:'json',
                                        data: form_data,
                                        enctype: 'multipart/form-data',
                                        processData: false,
                                        contentType: false,
										success: function(response) {
											if(response['error'])
											{
												$('#errorAddMiddleBanner').remove();
												$('#successAddMiddleBanner').remove();
												var error = '<div id="errorAddMiddleBanner" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
												if(response['error']=='This  is already in use.'){
													error += '<p>'+ response['error'] +'</p>';
												}else{
													for(var i=0; i < response['error'].length; i++)
													{
														error += '<p>'+ response['error'][i] +'</p>';
													}
												}
													error += '</div>';
													$('#topbanner').before(error);
												}

												if(response['success'])
												{
                                                    $('#title_div_group_id').attr('class', 'form-group');
													$('#errorAddMiddleBanner').remove();
													$('#successAddMiddleBanner').remove();
													var success = '<div id="successAddMiddleBanner" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></div>';
													$('#topbanner').before(success);

													$('.topbanner').live('load');

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
                    <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                  </div>
                  <div class="modal-body" >
                    {{-- <p><strong>#1:</strong> Banner 1</p> --}}
                    <div class="form-actions" id="modal-body-delete-selected">
                    <form action="index_banner_top_list/deleteTopbanner" method="post" name="deleteRecord">
                          		<input type="hidden" name="id" id="banner_id" value="" />
                        		<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                            	<div class="col-md-offset-4 col-md-8"> <a  href="javascript:void(0)" onclick="delete_selected('banners')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          	</form>
                  </div></div>
                </div>
              </div>
            </div>
            <!-- modal delete selected items end -->
            <!--Modal delete all items start-->
            <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="index_banner_top_list/deleteAlltopdata" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            <!-- modal delete all items end -->
          </div>
          <div class="portlet-body">

           <?php

               $arr_get = Input::get();
               $query_string = http_build_query($arr_get);

               ?>

            <div class="form-inline pull-left">
              <div class="form-group">
               <?php $rec='10'; if(isset($_GET['rec'])&&($_GET['rec']!='')){$rec=$_GET['rec'];}?>
                <select name="select_record" class="form-control" id="select_record" onchange="if (this.value) window.location.href=this.value">
                  <option <?php if($rec==10)echo ("selected=selected")?> value="{{ url('/web88cms/index_banner_top_list?rec=10') }}">10</option>
                  <option <?php if($rec==20)echo ("selected=selected")?> value="{{ url('/web88cms/index_banner_top_list?rec=20') }}">20</option>
                  <option <?php if($rec==30)echo ("selected=selected")?> value="{{ url('/web88cms/index_banner_top_list?rec=30') }}">30</option>
                  <option  <?php if($rec==50)echo ("selected=selected")?> value="{{ url('/web88cms/index_banner_top_list?rec=50') }}">50</option>
                  <option <?php if($rec==100)echo ("selected=selected")?> value="{{ url('/web88cms/index_banner_top_list?rec=100') }}">100</option>
                </select>
                &nbsp;
                <label class="control-label">Records per page</label>
              </div>
            </div>

               <div class="pull-right"> <a href="javascript:" onclick="document.getElementById('updatedisplaytopbanner').submit();"   name="Update_Display_Order"class="btn btn-danger">Update Display Order &nbsp;<i class="fa fa-refresh"></i></a> </div>

            <div class="clearfix"></div>
            <br/>
            <br/>
            <div class="table-responsive mtl">

                <input type="hidden" id="delete_item_ids" value="0" />
                <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" id="query_string" value="{{ $query_string }}" />

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
                            <form action="index_banner_top_list/updatealltopbanner" method="post" name="updatedisplaytopbanner" id="updatedisplaytopbanner" enctype="multipart/form-data" >
                                <input type="hidden" id="up_csrf_token" name="_token"  value="{{ csrf_token() }}" />
                                <?php foreach($result['banner_alltopdata'] as $details){?>
                    				<input type="hidden" name="display_order[<?php echo $details->id; ?>]" id="displayorder_<?php echo $details->id; ?>" class="form-control" value="<?php echo $details->display_order; ?>">
                    			 <input type="hidden" class="alldisplayord" value="<?php echo $details->display_order; ?>">
								<?php } ?>
                    		</form>
                  			<?php



							 	//$i = 1;
								$i = $result['start_from'];
								foreach($result['banner_topdata'] as $details)
								{
									$status_class = ($details->status == '1'&&( date("Y-m-d")<=($details->end_date))) ? 'label-success' : 'label-red';
									$status = ($details->status == '1')&&( date("Y-m-d")<=($details->end_date))? 'Active' : 'In-active';
								?>

                  <tr>
                    <td><input type="checkbox" value="<?php echo $details->id; ?>"  data-id="<?php echo $details->id; ?>"   onclick="selectForDelete();" class="select_items"/></td>
                    <td><?php echo ++$i; ?></td>
                    <td><span class="label label-sm <?php echo $status_class; ?>" id="banner-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                    <td data-title="<?php echo $details->title; ?>" class="select_items"><?php echo $details->title; ?></td>
                    <td><?php  $input= $details->start_date;
							$old_date = date($input);
                               echo  $new_date = date('dS M, Y', strtotime($old_date));?></td>
                    <td><?php $input2= $details->end_date;
						 $old_date2 = date($input2);
                               echo  $endnew_date = date('dS M, Y', strtotime($old_date2));?></td>

                    <td>

                    <input type="text" name="display_order" id="displayorder" onchange="uniquefun(this.value, <?php echo $i;?>);document.getElementById('displayorder_<?php echo $details->id; ?>').value=this.value" class="form-control displayord" value="<?php echo $details->display_order; ?>">

                    </td>



                    <!-- <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-banner" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                       -->
                    <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-banner-<?php echo $details->id; ?>" data-toggle="modal" id="edit_link_<?php echo $details->id; ?>" title="Edit"> <span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-<?php echo $details->id; ?>" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                      <!--Modal Edit banner start-->

                      <div id="modal-edit-banner-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                           <a name="edit"></a>
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Edit Banner</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                 <form class="form-horizontal" name="edittopbanner-<?php echo $details->id; ?>" id="edittopbanner-<?php echo $details->id; ?>" method="post" action="index_banner_top_list/updateTopBannerdata " enctype="multipart/form-data" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="method" value="edittopbannerform" id="edittopform">
                                  <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6" style="height:32px;">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <?php
											if($details->status=='1'){ $check='checked="checked"';}else { $check='';}?>
                                        <input id="status" type="checkbox" name="status"  <?php echo $check;?>  />
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group" id="title_div_group_id_edit-<?php echo $details->id; ?>">
                                    <label class="col-md-3 control-label">Title </label>
                                    <div class="col-md-6">
                                      <input id="title-<?php echo $details->id; ?>" type="text" class="form-control" placeholder="Banner 1" name="title" value="<?php echo $details->title; ?>" >
                                    </div>

                                    <div class="col-md-3" id="title_div_id_edit-<?php echo $details->id; ?>">
                                        <div class="popover popover-validator right" >
                                              <div class="arrow"></div>
                                              <div class="popover-content">
                                                <p class="mbn">Title is empty!</p>
                                              </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                       $(document).ready(function(){
                                          $('#title_div_id_edit-<?php echo $details->id; ?>').hide();
                                        });
                                    </script>

                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Upload Banner <span class='require'>*</span></label>
                                    <div class="col-md-9">
                                      <div class="text-15px margin-top-10px"> <!--<img src="../images/homeslider/slide1.jpg" alt="Banner" class="img-responsive">-->

                                        <?php if($details->banner!='')
												 {?>
                                        <img  id="banner_image_<?php echo $details->id; ?>" alt="" src="<?php echo "https://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/top/', $details->banner?>" class="img-responsive" />
                                        <?php }?>

                                        <br/>
                                        <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-banner-image-<?php echo $details->id; ?>" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                          <div class="clearfix"></div>
                                              <br/>

                                        <input type="file" name="banner" id="banner<?php echo $details->id; ?>" onchange="chkSizebanner('<?php echo $details->id; ?>');" />
                                       <input type="hidden" name="bannername"  id="bannername<?php echo $details->id; ?>" value="<?php echo $details->banner?>" />
                                         <br/>
                                        <span class="help-block">(Image dimension: 1920 x 580 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Start Date to End Date</label>
                                    <div class="col-md-6">
                                      <div class="input-group input-daterange">
                                        <input type="text" name="start_date" class="form-control" id="start_date" placeholder="1st Mar, 2015" value="<?php
											    echo $new_date;
											   ?>" required="required"/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" name="end_date" class="form-control" id="end_date" placeholder="03rd Mar ,2015" value="<?php echo $endnew_date; ?>" required="required"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Display Order <span class='require'>*</span></label>

                                    <div class="col-md-2">
                                      <input type="text" class="form-control" placeholder="1" id="display_order" name="display_order" required="required" value="<?php echo $details->display_order; ?>">
                                    </div>
                                    <div class="col-md-9 pull-right"> <span class="help-block">Display order is to determine the item appearing sequence in the website.</span> </div>
                                  </div>
                                  <h5 class="border-bottom">Banner Text &amp; Link Buttons</h5>
                                  <p class="text-blue">Please choose <strong>ONE</strong> of the following options for adding the banner text and icon.</p>
                                   <div class="form-group">
                                                <label class="col-md-3 control-label"> Banner Heading Text (Middle)</label>
                                                <div class="col-md-9">
                                                  <input id="text" type="text"  name="heading_text_middle" class="form-control" placeholder="eg. Premier Room" value="{{$details->heading_text_middle}}">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="col-md-3 control-label"> Banner Sub Heading Text (Top Line 1)</label>
                                                <div class="col-md-9">
                                                  <textarea name="heading_text_top_1" class="form-control"  placeholder="eg. Special Offer">{{$details->heading_text_top_1}}</textarea>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="col-md-3 control-label"> Banner Sub Heading Text (Top Line 2)</label>
                                                <div class="col-md-9">
                                                  <textarea  class="form-control" name="heading_text_top_2"   placeholder="eg. Always Warm &amp; Welcoming">{{$details->heading_text_top_2}}</textarea>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="col-md-3 control-label">Enable Link Button (Left)</label>
                                                <div class="col-md-6">
                                                  <div class="xss-margin"></div>
                                                  <div class="radio-list">
                                                    @foreach (config('defines.link_text_left') as $key=>  $val)
                                                        <label>
                                                        <input id="link_text_left_id_{{$key}}" name="link_text_left" <?php if ($details->link_text_left_value == $key) {    echo "checked"; } ?> type="radio" value="{{$val}}"/>
                                                        &nbsp; {{$val}}</label>
                                                    @endforeach
                                                    <input type="text" class="form-control" name="link_text_left_other" value="<?php if ($details->link_text_left_value == '5') {    echo $details->link_text_left; } ?>">
                                                    <div class="margin-top-10px"></div>
                                                    <label>
                                                     Button URL Link: <input type="text"  name="url_left" class="form-control" value="{{$details->url_left}}">
                                                     <div class="xss-margin"></div>
                                                     <div class="text-blue text-12px">You can specify the button link to the sub pages.</div>
                                                  </label>
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label class="col-md-3 control-label">Enable Link Button (Right)</label>
                                                <div class="col-md-6">
                                                  <div class="xss-margin"></div>
                                                  <div class="radio-list">
                                                      @foreach (config('defines.link_text_right') as $key=>  $val)
                                                        <label>
                                                        <input id="link_text_right_id_{{$key}}" name="link_text_right" <?php if ($details->link_text_right_value == $key) {    echo "checked"; } ?>  type="radio" value="{{$val}}"/>
                                                        &nbsp; {{$val}}</label>
                                                      @endforeach
                                                        <input type="text" class="form-control" placeholder="eg. 25% off - Grand Ballroom" name="link_text_right_other" value="<?php if ($details->link_text_right_value == '5') {    echo $details->link_text_right; } ?>">
                                                    <div class="margin-top-10px"></div>
                                                    <label>

                                                     Button URL Link: <input type="text" class="form-control" name="url_right" value="{{$details->url_right}}">
                                                     <div class="xss-margin"></div>
                                                     <div class="text-blue text-12px">You can specify the button link to the sub pages.</div>
                                                  </label>
                                                  </div>
                                                </div>
                                              </div>






                                  <div class="clearfix"></div>
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8">
                                     <a  onClick="chkSizebanner('<?php echo $details->id; ?>'); edittopbanner(<?php echo $details->id;  ?>);" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp;
                                      <a onClick="$('.form-horizontal').trigger('reset');" href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                   </div>
                                </form>
                                <script>
				function edittopbanner(Id){
					var form_data = new window.FormData($('#edittopbanner-'+Id)[0]);

                   var title = $('#title-<?php echo $details->id; ?>').val();
                      if(title==''){
                            $('#title_div_id_edit-<?php echo $details->id; ?>').show();
                            $('#title_div_group_id_edit-<?php echo $details->id; ?>').attr('class', 'form-group has-error');

                        } else {
                            $('#title_div_id_edit-<?php echo $details->id; ?>').hide();
                            $('#title_div_group_id_edit-<?php echo $details->id; ?>').attr('class', 'form-group');
                        }


					$.ajax({
						url: 'index_banner_top_list/updateTopBannerdata',
						type:'post',
						dataType:'json',
						data: form_data,
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false,
						success: function(response) {
							if(response['error'])
							{
								$('#errorEditTopBanner').remove();
								$('#successEditTopBanner').remove();
								var error = '<div id="errorEditTopBanner" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
								if(response['error']=='This Email Id is already in use.'){
									error += '<p>'+ response['error'] +'</p>';
								}
								if(response['error']=='Please fill unique display order Field..'){
									error += response['error'] ;
								}
								else{
									for(var i=0; i < response['error'].length; i++)
									{
										error += '<p>'+ response['error'][i] +'</p>';
									}
								}
									error += '</div>';
										$('#edittopbanner-'+Id).before(error);

								}

								if(response['success'])
								{
                                    $('#title_div_group_id_edit-<?php echo $details->id; ?>').attr('class', 'form-group');

									$('#errorEditTopBanner').remove();
									$('#successEditTopBanner').remove();
									var success = '<div id="successEditTopBanner" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.<br />Page will be reload in 2 sec, Please Wait....</p></p></div>';
									$('#edittopbanner-'+Id).before(success);

									$('.edittopbanner-'+Id).live('load');

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

                        <!--END MODAL Edit Montage-->
                            <!--Modal delete banner image start-->
                            <div id="modal-delete-banner-image-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this banner image? </h4>
                                  </div>
                                  <div class="modal-body">
                                      <?php if($details->banner!='')
                           {?>
                                    <p><img   alt="" src="<?php echo "https://".$_SERVER['HTTP_HOST']. '/public/admin/images/banner/top/'. $details->banner?>"" class="img-responsive" /></p>
                          <?php } ?>
                                    <div class="form-actions">
                                        <form  name="delete_Banner_image" id="delete_Banner_image<?php echo $details->id; ?>" method="post" action="index_banner_top_list/delete_enlarge" enctype="multipart/form-data" class="delete_enlarge<?php echo $details->id; ?>" >
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                           <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                                          <div class="col-md-offset-4 col-md-8">

                                           <a onclick="delete_Banner_image<?php echo $details->id; ?>();" data-dismiss="modal" aria-hidden="true" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;

                                          <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                        </form>

                                                 <script>
                      function delete_Banner_image<?php echo $details->id; ?>(){

                        var form_data = new window.FormData($('#delete_Banner_image<?php echo $details->id; ?>')[0]);
                        $.ajax({
                          url: 'index_banner_top_list/delete_banner_image',
                          type:'post',
                          dataType:'json',
                          data: form_data,
                          enctype: 'multipart/form-data',
                          processData: false,
                          contentType: false,
                          success: function(response) {
                            if(response['success'])
                              {
                                $('#successdelete_banner_image<?php echo $details->id; ?>').remove();
                                var success = '<div id="successdelete_banner_image<?php echo $details->id; ?>" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The banner image has been updated successfully.<br /></p></p></div>';
                                $('#edittopbanner-<?php echo $details->id; ?>').before(success);

                                //remove after 2 seconds
                                setTimeout(function(){
                                    $('#successdelete_banner_image<?php echo $details->id; ?>').remove();
                                    //remove banner image source
                                    $('#banner_image_<?php echo $details->id; ?>').attr('src', '');
                                    //remove hidden value for bannerName
                                    $('#bannername<?php echo $details->id; ?>').val('');

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
                          <!-- modal delete banner image end -->

                           <!--modal delete selected  at least one items start-->
                            <div id="modal-selected-least-one" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                      Please select at least one element for delete
                                    </div>
                                    <div class="form-actions">
                                      <div class="col-md-offset-4 col-md-8">
                                       <a href="javascript:void(0)" data-dismiss="modal" onclick="cancel_delete()" class="btn btn-green">OK &nbsp;<i class="fa fa-times-circle"></i>
                                       </a>

                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- modal delete selected  at least one items end -->


                              <!--Modal delete start-->

                      <div id="modal-delete-<?php echo $details->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" onClick="$('.form-horizontal').trigger('reset');" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this banner? </h4>
                            </div>
                            <div class="modal-body">
                              <p><strong>#<?php echo $i; ?>:</strong> <?php echo $details->title; ?></p>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8">
                                 <form  name="deleteform" id="deleteform<?php echo $details->id; ?>" method="post" action="index_banner_top_list/deleteTopBannerdata" enctype="multipart/form-data" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="method" value="deletetopbannerdata" id="deletetopbannerdata">
                                    <input type="hidden" name="id" id="banner_id" value="<?php echo $details->id; ?>" />
                                     <a onclick="javascript:document.getElementById('deleteform<?php echo $details->id; ?>').submit();" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                          <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                          </form></div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                       <!--add trash file-->


                      <!--add trash file end-->

                      </td>
                  </tr>
                  <?php
									//$i++;
                                } // end foreach
                                ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="8"></td>
                  </tr>
                </tfoot>
              </table>





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
				echo "<li ".$disabled1."><a href= https://".$_SERVER['HTTP_HOST']."/web88cms/index_banner_top_list?page=1>".'&laquo;'."</a></li> "; // Goto 1st page
				$total_pages=($result['total_pages']);
			   for ($i=1; $i<=$total_pages; $i++) {

			    if(isset($_GET['page'])&&($_GET['page']==$i))
			   {
				 $active= 'class="active"';
			   }
			   else
			   {$active= '';}
			echo "<li ".$active." ><a href= https://".$_SERVER['HTTP_HOST']."/web88cms/index_banner_top_list?page=".$i.">".$i."</a></li> ";
};

		if((isset($_GET['page'])&&($_GET['page']==$total_pages)) || $total_pages==1)

			   {
				 $disabled= 'class="disabled"';
			   }
			   else
			   {$disabled= '';}
            echo "<li ".$disabled."><a href= https://".$_SERVER['HTTP_HOST']."/web88cms/index_banner_top_list?page=$total_pages>".'&raquo;'."</a></li> "; // Goto last page
?>
              </ul>
            </div>
              <div class="clearfix"></div>
            </div>
          </div>
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

<script type="text/javascript">

    function deleteSelected(){
        if($('.select_items:checked').length == 0)
        {
          $('#modal-selected-least-one').modal('show');
        }else{

            $('#delete_item_ids').val('');
            $('.delete_banner_class').remove();

            var success = '';
            $('input.select_items').each(function(){

                if($(this).is(':checked'))
                {
                    id    = $(this).attr('data-id');
                    title = $(this).parent('td').parent('tr').children('td:eq(3)').attr('data-title');

                    success = success + '<p class="delete_banner_class"><strong>#'+id+':</strong>'+ title+'</p>';

                    if($('#delete_item_ids').val() == '')
                        $('#delete_item_ids').val(id);
                    else
                    {
                        $('#delete_item_ids').val($('#delete_item_ids').val()+','+id);
                    }

                }
            });
            $('#modal-body-delete-selected').before(success);
          $('#modal-delete-selected').modal('show');
        }
    }

    // select all checkboxes
    $(document).ready(function(){
         $('#title_div_id').hide();
        $('#select_items').click(function(){
            if($('#select_items').is(':checked'))
            {
                $('.select_items').prop('checked',true);
            }
            else
                $('.select_items').prop('checked',false);
        });
    });


</script>
@endsection



