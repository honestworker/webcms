@extends('adminLayout')
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/bootstrap-colorpicker/css/colorpicker.css') }}">
@section('content')
<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
        
        <div class="page-header-breadcrumb" style="position:relative; height:40px;">
          <ol class="breadcrumb page-breadcrumb" style="position:absolute; left:0;">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard/') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
            <li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
            <li class="active">Colors - Add New</li>
          </ol>
          <div class="page-heading hidden-xs">
            <h1 class="page-title">Products</h1>
          </div>
          </div>
        <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
        
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Colors <i class="fa fa-angle-right"></i> Add New</h2>
              <div class="clearfix"></div>
              <div class="pull-left"> Last updated: <span class="text-blue"><?php echo date('d M, Y @ g:i A',strtotime($last_modified)); ?></span> </div>
              <div class="clearfix"></div>
            <?php
				//print_r(session('data'));
			?>
            @if(session()->has('data'))
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
			
             
              <div class="clearfix"></div>
              <p></p>


                      <div class="portlet">
                        
                        <div class="portlet-body">
                          <div class="row">
                          	<div class="col-md-12">
                            	
                                <form class="form-horizontal" method="post" action="{{ url('/web88cms/colors/addColor') }}" id="addColorForm">
                                	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                  <div data-on="success" data-off="primary" class="make-switch" style="height: 32px;">
                                                    <input type="checkbox" name="status" checked="checked"/>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Title</label>
                                                <div class="col-md-6">
                                                	<input type="text" class="form-control" name="title" placeholder="Red">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Pick a Color</label>
            
                                                <div class="col-md-3"><input type="text" name="hex_code" class="colorpicker-default form-control" placeholder="#ff0000"/></div>
                                            </div>
											
                                            <div class="form-actions">
                                              <div class="col-md-offset-5 col-md-7"> <a href="#" class="btn btn-red" onclick="$('#addColorForm').submit()">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="{{ url('/web88cms/colors/list') }}" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                             
                                            </div>
                                          </form>
                                          
                                          		
                                
                                
                                
                                  
                            </div>
                            <!-- end col-md-12 -->
                            
                            
                            
                            
                            
                            
                          </div>
                          <!-- end row -->
                          <div class="md-margin"></div>    
                            
                       </div>
                       <!-- end porlet-body -->
                          
                         
                          
                       <div class="clearfix"></div>
                       
                                
                  </div>
                  <!-- End porlet -->
                  

                
              
            </div>
            <!-- end col-lg-12 -->
            
            
            
            
                    
                    
                   
          </div>
        </div>        
        <!--END CONTENT-->
            
            <!--BEGIN FOOTER-->
  <div class="page-footer" style="padding-bottom:35px;">
                <div class="copyright"><span class="text-15px">2015 &copy; <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                	<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
                </div>
        </div>
    <!--END FOOTER--></div>

<script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('/public/admin/js/jquery-ui.js') }}"></script>

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

@endsection