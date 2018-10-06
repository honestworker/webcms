@extends('adminLayout')



@section('content')
<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

        

        <div class="page-header-breadcrumb">

          <div class="page-heading hidden-xs">

            <h1 class="page-title">CMS Pages</h1>

          </div>

          <ol class="breadcrumb page-breadcrumb">
			<li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>CMS Pages &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">About Us - Edit</li>
          </ol>

        </div>

        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

        

        <div class="page-content">

                <div id="tab-shopping">

                    <div class="row">

                        <div class="col-lg-12">
							
                            
                            <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>About Us <i class="fa fa-angle-right"></i> Edit</h2>
              <div class="clearfix"></div>
              <!--<div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>-->
              <div class="pull-left"> Last updated: <span class="text-blue">15 Sept, 2014 @ 12.00PM</span> </div>
              <div class="clearfix"></div>
              <p></p>
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Page Info</div>
                  <br/>
                  <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                  <div id="textToBeSavedcontent1" contenteditable="true"> 
                  	<?php echo $result['content'][0]->content1;?>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Page Content</div>
                  <br/>
                  <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                  <div class="tools"><i class="fa fa-chevron-up"></i></div>
                </div>
                <div class="portlet-body">
                  <!-- message from MD start -->
                  	<div class="row">
                    <div class="col-md-12">
                      <div class="hero-unit">
                        <div id="textToBeSavedcontent2" contenteditable="true">
                          <?php echo $result['content'][0]->content2;?>
                        </div>
                        <span class="small-bottom-border big"></span>
                        <div id="textToBeSavedcontent3" contenteditable="true">
                        	<?php echo $result['content'][0]->content3;?>
                        </div>
                      </div>
                      <div class="md-margin2x"></div>
                      <div class="row">
                        <div class="col-md-12">
                          <div id="textToBeSavedcontent4" contenteditable="true">
                            <?php echo $result['content'][0]->content4;?>
                          </div>
                          <div class="md-margin"></div>
                          <hr>
                        </div>
                        <!-- end col-12 -->
                      </div>
                      <!-- end row -->
                      <div class="xs-margin"></div>
                      <div class="row">
                        <div class="col-md-6 col-sm-3 col-xs-6 service-box-container">
                          <div class="services-box">
                            <div class="items"> <a href="#" data-placement="top" data-target="#modal-edit-vision-icon" data-toggle="modal" title="Edit">
                              <div class="circle"><i id="icon1Img" class="fa fa-<?php echo $result['content'][0]->icon1;?>"></i></div>
                            </a> </div>
                            Please fix the red bottom border missing issue due to inline editor when mouse-hover and edit the text.
                            <div id="textToBeSavedcontent5" contenteditable="true">
                            	<?php echo $result['content'][0]->content5;?>
                            </div>
                            <div id="textToBeSavedcontent6" contenteditable="true">
                            	<?php echo $result['content'][0]->content6;?>
                            </div>
                          </div>
                        </div>
                        <!--Modal edit vision icon start-->
                        <div id="modal-edit-vision-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                          <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-login-label3" class="modal-title">Edit Icon</h4>
                              </div>
                              <div class="modal-body">
                                <div class="form">
                                  <form class="form-horizontal">
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                      <div class="col-md-6">
                                        <input type="text" class="form-control" id="icon1" value="<?php echo $result['content'][0]->icon1;?>">
                                        <div class="help-block">Please refer here for more <a href="icons.html" target="_blank">icon options.</a></div>
                                      </div>
                                    </div>
                                    <div class="form-actions">
                                      <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0);" class="btn btn-red" onclick="SaveIcon1()" data-dismiss="modal">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--END MODAL edit vision icon -->
                        <!-- end col-md-6 -->
                        <div class="col-md-6 col-sm-3 col-xs-6 service-box-container">
                          <div class="services-box">
                            <div class="items"> <a href="#" data-placement="top" data-target="#modal-edit-mission-icon" data-toggle="modal" title="Edit">
                              <div class="circle"><i id="icon2Img" class="fa fa-<?php echo $result['content'][0]->icon2;?>"></i></div>
                            </a> </div>
                            Please fix the red bottom border missing issue due to inline editor when mouse-hover and edit the text.
                            <div id="textToBeSavedcontent7" contenteditable="true">
                            	<?php echo $result['content'][0]->content7;?>
                            </div>
                            <div id="textToBeSavedcontent8" contenteditable="true">
                            	<?php echo $result['content'][0]->content8;?>
                            </div>
                          </div>
                        </div>
                        <!--Modal edit mission icon start-->
                        <div id="modal-edit-mission-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                          <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-login-label3" class="modal-title">Edit Icon</h4>
                              </div>
                              <div class="modal-body">
                                <div class="form">
                                  <form class="form-horizontal">
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Icon <span class='require'>*</span></label>
                                      <div class="col-md-6">
                                        <input id="icon2" type="text" class="form-control" id="inputContent" value="<?php echo $result['content'][0]->icon2;?>">
                                        <div class="help-block">Please refer here for more <a href="icons.html" target="_blank">icon options.</a></div>
                                      </div>
                                    </div>
                                    <div class="form-actions">
                                      <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0);" class="btn btn-red" onclick="SaveIcon2()" data-dismiss="modal">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--END MODAL edit mission icon -->
                        <!-- end col-md-6 -->
                        <div class="lg-margin"></div>
                      </div>
                      <!-- end row vision & mission -->
                      <div class="xlg-margin"></div>
                    </div>
                    <!-- end col-md-12 -->
                  </div>
                  <!-- end message from MD -->
                  <!-- our story start -->
                  <div class="row">
                    <div class="col-md-12">
                      <!-- our story start -->
                      <div class="hero-unit">
                        <div id="textToBeSavedcontent9" contenteditable="true">
                        	<?php echo $result['content'][0]->content9;?>
                        </div>
                        <span class="small-bottom-border big"></span>
                        <div id="textToBeSavedcontent10" contenteditable="true">
                        	<?php echo $result['content'][0]->content10;?>
                        </div>
                      </div>
                      <div class="md-margin2x"></div>
                      <div id="textToBeSavedcontent11" contenteditable="true">
                      	<?php echo $result['content'][0]->content11;?>
                      </div>
                      <hr>
                      <div class="md-margin"></div>
                      <!-- end our story -->
                      <!-- our business strategy start -->
                      <div class="hero-unit">
                        <div id="textToBeSavedcontent12" contenteditable="true">
                        	<?php echo $result['content'][0]->content12;?>
                        </div>
                        <span class="small-bottom-border big"></span>
                        <div id="textToBeSavedcontent13" contenteditable="true">
                        	<?php echo $result['content'][0]->content13;?>
                        </div>
                      </div>
                      <div class="md-margin2x"></div>
                      <div id="textToBeSavedcontent14" contenteditable="true">
                      	<?php echo $result['content'][0]->content14;?>
                      </div>
                      <div class="xlg-margin"></div>
                      <!-- end our business strategy -->
                    </div>
                    <!-- end col-md-12 -->
                  </div>
                  <!-- end row -->
                  <div class="row">
                    <!-- how to choose our logo concept start -->
                    <div class="col-md-6 col-sm-3 col-xs-6">
                      <div class="hero-unit">
                        <div id="textToBeSavedcontent15" contenteditable="true">
                          <?php echo $result['content'][0]->content15;?>
                        </div>
                        <span class="small-bottom-border big"></span>
                        <div id="textToBeSavedcontent16" contenteditable="true">
                        	<?php echo $result['content'][0]->content16;?>
                        </div>
                      </div>
                      <div class="md-margin2x"></div>
                      <div id="textToBeSavedcontent17" contenteditable="true">
                      	<?php echo $result['content'][0]->content17;?>
                      </div>
                    </div>
                    <!-- end how to choose our logo concept -->
                    <!-- responses to the logo start -->
                    <div class="col-md-6 col-sm-3 col-xs-6">
                      <div class="hero-unit">
                        <div id="textToBeSavedcontent18" contenteditable="true">
                        	<?php echo $result['content'][0]->content18;?>
                        </div>
                        <span class="small-bottom-border big"></span>
                        <div id="textToBeSavedcontent19" contenteditable="true">
                        	<?php echo $result['content'][0]->content19;?>
                        </div>
                      </div>
                      <div class="md-margin2x"></div>
                      <div id="textToBeSavedcontent20" contenteditable="true">
                      	<?php echo $result['content'][0]->content20;?>
                      </div>
                    </div>
                    <div class="xlg-margin"></div>
                    <!-- end responses to the logo -->
                  </div>
                  <!-- end row -->
                  <!-- end our story -->
                </div>
                <!-- End portlet body -->
                <!-- save button start -->
                <div class="form-actions none-bg"> <a href="#preview in browser/not yet published" onclick="ClickToSave()" class="btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a href="#publish online" class="btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="#" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                <!-- save button end -->
                <div id="saved" style="display:none;" class="alert alert-success alert-dismissable">
                    <button type="button" onclick="document.getElementById('saved').style.display='none'" class="close">&times;</button>
                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                    <p>The information has been saved/updated successfully.</p>
                </div>
				<script type='text/javascript' language='javascript'>
                	// <![CDATA[
                    function ClickToSave () {
                    	//var content1 = document.getElementById('textToBeSavedcontent1').innerHTML;//CKEDITOR.instances.textToBeSavedcontent1.getData();
						//var content2 = document.getElementById('textToBeSavedcontent2').innerHTML;//CKEDITOR.instances.textToBeSavedcontent2.getData();

                        $.post("aboutusUpdate",
                        {
                        	 _token : 	'{{{ csrf_token() }}}',
                             content1 : document.getElementById('textToBeSavedcontent1').innerHTML,
							 content2 : document.getElementById('textToBeSavedcontent2').innerHTML,
							 content3 : document.getElementById('textToBeSavedcontent3').innerHTML,
							 content4 : document.getElementById('textToBeSavedcontent4').innerHTML,
							 content5 : document.getElementById('textToBeSavedcontent5').innerHTML,
							 content6 : document.getElementById('textToBeSavedcontent6').innerHTML,
							 content7 : document.getElementById('textToBeSavedcontent7').innerHTML,
							 content8 : document.getElementById('textToBeSavedcontent8').innerHTML,
							 content9 : document.getElementById('textToBeSavedcontent9').innerHTML,
							 content10 : document.getElementById('textToBeSavedcontent10').innerHTML,
							 content11 : document.getElementById('textToBeSavedcontent11').innerHTML,
							 content12 : document.getElementById('textToBeSavedcontent12').innerHTML,
							 content13 : document.getElementById('textToBeSavedcontent13').innerHTML,
							 content14 : document.getElementById('textToBeSavedcontent14').innerHTML,
							 content15 : document.getElementById('textToBeSavedcontent15').innerHTML,
							 content16 : document.getElementById('textToBeSavedcontent16').innerHTML,
							 content17 : document.getElementById('textToBeSavedcontent17').innerHTML,
							 content18 : document.getElementById('textToBeSavedcontent18').innerHTML,
							 content19 : document.getElementById('textToBeSavedcontent19').innerHTML,
							 content20 : document.getElementById('textToBeSavedcontent20').innerHTML,
							 icon1 : document.getElementById('icon1').value,
							 icon2 : document.getElementById('icon2').value
                        },
                        function(data,status){
                        	//alert("Status: " + status);
							document.getElementById('saved').style.display='block';
                        });
                    }
					
					function SaveIcon1 () {
                    	document.getElementById('icon1Img').className="fa fa-"+document.getElementById('icon1').value;
                    }
					
					function SaveIcon2 () {
                    	document.getElementById('icon2Img').className="fa fa-"+document.getElementById('icon2').value;
                    }
					
                    // ]]>
                </script>
              </div>
              <!-- End portlet -->
              <h4 class="block-heading">Objective</h4>
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#objectivetext" data-toggle="tab">Objective Text</a></li>
                <li><a href="#backgroundimage" data-toggle="tab">Background Image</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div id="objectivetext" class="tab-pane fade in active">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Objective</div>
                      <br/>
                      <p class="margin-top-10px"></p>
                      <a href="#" data-target="#modal-add-objective" data-toggle="modal" class="btn btn-success">Add New Objective &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                       
<div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      <!--Modal Add New Objective start-->
                      <div id="modal-add-objective" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New Objective</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form id="addObj" class="form-horizontal" method="post">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" checked="checked" name="status" value="1"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Objective Text </label>
                                    <div class="col-md-6">
                                      <textarea name="objText" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-3"> </div>
                                  </div>
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0);" onClick="aboutusObjective();" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                  <script>
								  	function aboutusObjective(){
										var form_data = new window.FormData($('#addObj')[0]);
										
										$.ajax({			
												url: 'aboutusObjective',
												type:'post',
												dataType:'json',
												data: form_data,
												enctype: 'multipart/form-data',
												processData: false,
												contentType: false,
												success: function(response) {			
													if(response['error'])
													{
														$('#errorAboutusObjective').remove();
														$('#successAboutusObjective').remove();
														var error = '<div id="errorAboutusObjective" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
														for(var i=0; i < response['error'].length; i++)
														{
															error += '<p>'+ response['error'][i] +'</p>';
														}
														error += '</div>';
														$('#addObj').before(error);	
													}
													
													if(response['success'])
													{
														$('#errorAboutusObjective').remove();
														$('#successAboutusObjective').remove();
														var success = '<div id="successAboutusObjective" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
														$('#addObj').before(success);
														
														$('.addObj').live('load');
													}
												}
											});
									}
                                  </script>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New Objective-->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
                              <p><strong>#1:</strong> To build long-term relationship with all stakeholders for sustainable growth.</p>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                          <select name="select" class="form-control">
                            <option>10</option>
                            <option>20</option>
                            <option selected="selected">30</option>
                            <option>50</option>
                            <option>100</option>
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
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;foreach($result['obj'] as $objective) { ?>
                              <tr>
                                <td><input type="checkbox"/></td>
                                <td><?php echo $i++;?></td>
                                <td><?php if($objective->status==1){?><span class="label label-sm label-success">Active</span><?php }else{ ?><span class="label label-sm label-red">In-Active</span><?php } ?></td>
                                <td><?php echo $objective->objText;?></td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-objective-<?php echo $objective->id;?>" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-<?php echo $objective->id;?>" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                    <!--Modal Edit Objective start-->
                                    <div id="modal-edit-objective-<?php echo $objective->id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label3" class="modal-title">Edit Objective</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form">
                                              <form id="addUpdateObj-<?php echo $objective->id;?>" method="post" class="form-horizontal">
                                              	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <input type="hidden" name="objId" value="<?php echo $objective->id;?>" />
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Status</label>
                                                  <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                      <input name="status" value="1" type="checkbox" <?php if($objective->status==1){?>checked="checked"<?php } ?>/>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Objective Text </label>
                                                  <div class="col-md-9">
                                                    <textarea name="objText" rows="3" class="form-control"><?php echo $objective->objText;?></textarea>
                                                  </div>
                                                </div>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red" onclick="aboutusUpdateObjective();">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                	
                                                </div>
                                              </form>
                                              <script>
												function aboutusUpdateObjective(){
													var form_data = new window.FormData($('#addUpdateObj-<?php echo $objective->id;?>')[0]);
													
													$.ajax({			
															url: 'aboutusUpdateObjective',
															type:'post',
															dataType:'json',
															data: form_data,
															enctype: 'multipart/form-data',
															processData: false,
															contentType: false,
															success: function(response) {			
																if(response['error'])
																{
																	$('#errorAboutusUpdateObjective').remove();
																	$('#successAboutusUpdateObjective').remove();
																	var error = '<div id="errorAboutusUpdateObjective" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
																	for(var i=0; i < response['error'].length; i++)
																	{
																		error += '<p>'+ response['error'][i] +'</p>';
																	}
																	error += '</div>';
																	$('#addUpdateObj-<?php echo $objective->id;?>').before(error);	
																}
																
																if(response['success'])
																{
																	$('#errorAboutusUpdateObjective').remove();
																	$('#successAboutusUpdateObjective').remove();
																	var success = '<div id="successAboutusUpdateObjective" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
																	$('#addUpdateObj-<?php echo $objective->id;?>').before(success);
																	
																	$('.addUpdateObj-<?php echo $objective->id;?>').live('load');
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
                                    <!--Modal delete start-->
                                    <div id="modal-delete-<?php echo $objective->id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <form id="objDelete-<?php echo $objective->id;?>" method="post" class="form-horizontal">
                                            	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <input type="hidden" name="objId" value="<?php echo $objective->id;?>" />
                                            
                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this objective? </h4>
                                          </div>
                                          <div class="modal-body">
                                            <p><strong>#1:</strong> <?php echo $objective->objText;?></p>
                                            <div class="form-actions">
                                              <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red" onclick="aboutusDeleteObjective();">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                            </div>
                                          </div>
                                          </form>
                                        </div>
                                      </div>
                                  </div>
                                  <script>
												function aboutusDeleteObjective(){
													var form_data = new window.FormData($('#objDelete-<?php echo $objective->id;?>')[0]);
													
													$.ajax({			
															url: 'aboutusDeleteObjective',
															type:'post',
															dataType:'json',
															data: form_data,
															enctype: 'multipart/form-data',
															processData: false,
															contentType: false,
															success: function(response) {	
																if(response['success'])
																{
																	$('#successAboutusDeleteObjective').remove();
																	var success = '<div id="successAboutusDeleteObjective" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
																	$('#objDelete-<?php echo $objective->id;?>').before(success);
																	$('.objDelete-<?php echo $objective->id;?>').live('load');
																}
															}
														});
												}
											  </script>
                                  <!-- modal delete end -->
                                </td>
                              </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5"></td>
                              </tr>
                            </tfoot>
                          </table>
                          <div class="tool-footer text-right">
                            <p class="pull-left">Showing 1 to 10 of 57 entries</p>
                            <ul class="pagination pagination mtm mbm">
                              <li class="disabled"><a href="#">&laquo;</a></li>
                              <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
    </ul>
                          </div>
                          <div class="clearfix"></div>
                       </div>
                       <!-- end table responsiev -->
                    </div>
                  </div>
                  <!-- End porlet -->
                </div>
                <!-- end tab objective text -->
                <div id="backgroundimage" class="tab-pane fade">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Edit Objective Background Image</div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td><span class="label label-sm label-success">Active</span></td>
                            <td>Objective Background Image</td>
                            <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-objective-background" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                <!--Modal Edit Objective Background image start-->
                                <div id="modal-edit-objective-background" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                  <div class="modal-dialog modal-wide-width">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                        <h4 id="modal-login-label3" class="modal-title">Edit Objective Background Image</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="form">
                                          <form id="bgImg" class="form-horizontal" method="post">
                                          	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Status</label>
                                              <div class="col-md-6">
                                                <div data-on="success" data-off="primary" class="make-switch">
                                                  <input type="checkbox" checked="checked"/>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Title </label>
                                              <div class="col-md-6">
                                                <input id="text" type="text" class="form-control" placeholder="Objective Background Image" value="Objective Background Image">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Upload Background Image <span class='require'>*</span></label>
                                              <div class="col-md-9">
                                                <div class="text-15px margin-top-10px"> <img src="../../images/testimonialsbg.jpg" alt="Objective" class="img-responsive"><br/>
                                                    <input id="exampleInputFile2" type="file"/>
                                                    <br/>
                                                    <span class="help-block">(Image dimension: min. 1543 x 600 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                              </div>
                                            </div>
                                            <div class="form-actions">
                                              <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <!--END MODAL Edit Objective background image -->
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="4"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <!-- end background image -->
              </div>
              <!-- end tab content -->
            </div>
          </div>
        </div>
                            
                            
                            
                            
                            
                            
                            
                        </div>

                        

                    </div>

                </div>

            </div>

        <!--END CONTENT-->

            

            <!--BEGIN FOOTER-->

            <div class="page-footer">

                <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>

                	<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies"></div>

                </div>

            </div>

    <!--END FOOTER--></div>

@endsection

