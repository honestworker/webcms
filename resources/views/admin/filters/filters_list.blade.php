@extends('adminLayout')

@section('content')         
       
  <!--BEGIN PAGE WRAPPER-->
      <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
        
        <div class="page-header-breadcrumb">
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Products</h1>
          </div>

          <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard/') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Filters - Listing</li>
          </ol>
          </div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Filters <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              
              @if(session()->has('data.success'))
                    <div class="alert alert-success alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                    <p>{{  session('data.success') }}</p>
                  </div>
                @endif
               
               <!-- validation errors -->
			 	@if($errors->has())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                        @foreach ($errors->all() as $error)
                          <p>{{ $error }}</p>
                        @endforeach
                    </div>
				@endif 
              
              <div class="pull-left"> Last updated: <span class="text-blue"><?php echo date('d M, Y @ g:i A',strtotime($last_modified)); ?></span> </div>
              <div class="clearfix"></div>
              <p></p>
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#filter" data-toggle="tab">Filters Listing</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                
                <div id="filter" class="tab-pane fade in active">
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Filters Listing</div>
                      <br/>
                      <p class="margin-top-10px"></p>
                     
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive mtl">
                      
                      <?php
						if(sizeof($filters) > 0)
						{
						?>
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
                              
                              <?php
							  $i = 1;
							  foreach($filters as $details)
							  {
								$status_class = ($details->status == '0') ? 'label-red' : 'label-success';
								$status = ($details->status == '0') ? 'In-active' : 'Active';
							  ?>
								<tr>                               
                                <td>{{ $i }}</td>
                                <td><span class="label label-sm <?php echo $status_class; ?>" id="brand-status-<?php echo $details->id; ?>"><?php echo $status; ?></span></td>
                                <td>{{ $details->title }}</td>
                                <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-{{ $details->id }}" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> 
                                    <!--Modal Edit brand start-->
                                    <div id="modal-edit-{{ $details->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close" onclick="window.location.href='{{ url('/web88cms/filters/list') }}'">&times;</button>
                                            <h4 id="modal-login-label3" class="modal-title">{{ $details->title }} Filter Edit</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form">
                                              <form class="form-horizontal" method="post">
                                              	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input type="hidden" name="id" value="{{ $details->id }}" />
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Status</label>
                                                  <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch2">
                                                      <input type="checkbox" name="status" <?php if($details->status == '1'){ echo 'checked="checked"'; } ?> />
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label class="col-md-3 control-label">Title </label>
                                                  <div class="col-md-6">
                                                    <input id="text" type="text" name="title" class="form-control" placeholder="Brand" value="{{ $details->title }}">
                                                  </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                                                    <div class="col-md-6">                  
                                                        <div class="xs-margin"></div>
                                                        <select multiple="multiple" name="category_id[]" class="form-control" style="height: 350px;">
                                                            <?php echo $filter_categories[$i-1]; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-actions">
                                                  <div class="col-md-offset-5 col-md-8"> <button type="submit" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green" onclick="window.location.href='{{ url('/web88cms/filters/list') }}'">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <!--END MODAL Edit brand image -->
                                </td>
                              </tr> 
                              <?php
							  $i++;
							  } // end foreach
							  ?>
                              
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5"></td>
                              </tr>
                            </tfoot>
                          </table>
                          <?php
						} // end if
						?>
                          <div class="clearfix"></div>
                        </div>
                        <!-- end table responsive -->
                    </div>
                  </div>
                </div>
                <!-- end background image -->
                
              </div>
              <!-- end tab content -->
              <div class="clearfix"></div>
            </div>
            <!-- end col-lg-12 -->
          </div>
          <!-- end row -->
        </div>
        <!--END CONTENT-->
            
            <!--BEGIN FOOTER-->
  <div class="page-footer">
                <div class="copyright"><span class="text-15px">2015 &copy; <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                	<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
                </div>
        </div>
    <!--END FOOTER--></div>
  <!--END PAGE WRAPPER-->      
        

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


<script>
  $(document).ready(function(){
    $(".make-switch2").bootstrapSwitch();
  });
</script>
@endsection
