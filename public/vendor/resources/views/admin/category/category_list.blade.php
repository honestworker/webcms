@extends('adminLayout')
@section('title', 'Categories')
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/vendors/jquery-nestable/nestable.css') }}" />

<div id="page-wrapper">
	<!--BEGIN PAGE HEADER & BREADCRUMB-->
    <div class="page-header-breadcrumb">
        <div class="page-heading hidden-xs">
        	<h1 class="page-title">Products</h1>
        </div>
    
        <ol class="breadcrumb page-breadcrumb">
        	<li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li>Products &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
        	<li class="active">All Categories - Listing</li>
        </ol>
    </div>
	<!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>All Categories <i class="fa fa-angle-right"></i> Listing</h2>
            	<div class="clearfix"></div>
                <div class="pull-left"> Last updated: <span class="text-blue"><?php echo date('d M, Y @ g:i A',strtotime($last_modified)); ?></span> </div>
              	<div class="clearfix"></div>
                @if ($success)
                    <div class="alert alert-success alert-dismissable">
	                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
    	                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
        	            <p>{{ $success }}</p>
                    </div>  	
                @endif
                
                @if ($warning)
                    <div class="alert alert-danger alert-dismissable">
	                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
    	                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
        	            <p>{{ $warning }}</p>
                    </div>
                @endif
                
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-header">
	                    <div class="caption">Categories Listing</div>                    
                    	<div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
					       
                    <div class="portlet-body">
						<div class="text-blue text-15px" style="line-height: 150%">
						You can drag and drop the categories. To add a new category/sub category, please click the "Duplicate" icon to edit it. Then drag and drop the position according to your preference. <!--Add/upload/edit "Menu Image" is only applicable for the first level of the category, eg. Audio Visual, Home Appliances, etc...--></div>
						<div class="sm-margin"></div> 
        	            
						<div id="nestable" class="dd"><?php echo $categoriesHtml; ?></div>
	                    <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-footer">
        <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
        <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png')}}" alt="Webqom Technologies Sdn Bhd"></div>
        </div>
    </div>
	<!--END FOOTER-->
</div>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<input id="_category_post" type="hidden" name="_category_post" value="{{ url('web88cms/categories/listAjax') }}">

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





<!--CORE JAVASCRIPT-->
<script src="{{ asset('/public/admin/js/main.js') }}"></script>
<script src="{{ asset('/public/admin/js/holder.js') }}"></script>

<script src="{{ asset('/public/admin/vendors/jquery-nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('/public/admin/js/ui-nestable-list.js') }}"></script>

<script type="text/javascript" language="javascript">
	function saveCategory(obj){
		var category_id = obj.attr('data-id');
		
		$.ajax({
			url: "{{ url('web88cms/categories/editCategory') }}/" + category_id,
			type: 'POST',
			dataType: 'json',
			data: $('#modal-edit-category-' + category_id + ' input[type=text], #modal-edit-category-' + category_id + ' input[type=checkbox]:checked, #_token'),
			beforeSend:function (){
				obj.html('Saving... <i class="fa fa-floppy-o"></i>');
			},
			complete: function(){
				obj.html('Save <i class="fa fa-floppy-o"></i>');
			},
			success: function(response){
				var html = '';
				
				$('#errorEditBrand').remove();
				$('#successEditBrand').remove();
				
				if(response['error'])
				{
					var html = '<div id="errorEditBrand" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					for(var i=0; i < response['error'].length; i++)
					{
						html += '<p>'+ response['error'][i] +'</p>';
					}
					html += '</div>';
					$('#modal-edit-category-' + category_id + ' .modal-header').after(html); 
				}
				
				if(response['success'])
				{	
					html += '<div id="successEditBrand" class="alert alert-success alert-dismissable">';
						html += '<i class="fa fa-times-circle"></i> <strong>Success!</strong>';
						html += '<p>'+ response['success'] +'</p>';
					html += '</div>';
					
					$('#modal-edit-category-' + category_id + ' .modal-header').after(html);
					$('#text-category-' + category_id).html($('#modal-edit-category-' + category_id + ' input[name=title]').val());
					setTimeout(function(){
						$('#successEditBrand').remove();
					}, 5000);
				}
			}
		});
	}
	
	function uploadMenuImage(obj){
		var category_id = obj.attr('data-id');		
		var formData = new FormData();
		
        formData.append( "image", $('#modal-upload-image-' + category_id + ' input[name=image]')[0].files[0]);
		formData.append( "image2", $('#modal-upload-image-' + category_id + ' input[name=image2]')[0].files[0]);
		
		formData.append( "alt_text", $('#modal-upload-image-' + category_id + ' input[name=alt_text]').val());
		formData.append( "alt_text2", $('#modal-upload-image-' + category_id + ' input[name=alt_text2]').val());
		
		formData.append( "_token", $('#_token').val());

        $.ajax({
            url: "{{ url('web88cms/categories/uploadMenuImage') }}/" + category_id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            beforeSend:function (){
				obj.html('Saving... <i class="fa fa-floppy-o"></i>');
			},
			complete: function(){
				obj.html('Save <i class="fa fa-floppy-o"></i>');
			},
            success: function (response) {
                var html = '';
				
				$('#warning-box').remove();
				$('#success-box').remove();
				
				if(response['error'])
				{
					 html += '<div id="warning-box" class="alert alert-danger alert-dismissable">';
	                 	html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
						html += '<i class="fa fa-times-circle"></i> <strong>Error!</strong>';

						for(var i=0; i < response['error'].length; i++)
						{
							html += '<p>'+ response['error'][i] +'</p>';
						}
					
					html += '</div>';
					$('#modal-upload-image-' + category_id + ' .modal-header').after(html); 
				}
				
				if(response['success'])
				{	
					html += '<div id="success-box" class="alert alert-success alert-dismissable">';
	                    html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
    	                html += '<i class="fa fa-check-circle"></i> <strong>Success!</strong>';
        	            html += '<p>'+ response['success'] +'</p>';
                    html += '</div>';
					
					$('#modal-upload-image-' + category_id + ' .modal-header').after(html); 
					
					$('#modal-upload-image-' + category_id + ' #cat-image-1').attr('src', "{{ asset('/public/images/category') }}/" + response['data']['image']); 
					if(response['data']['image2'] != ''){
						$('#modal-upload-image-' + category_id + ' #cat-image-2').attr('src', "{{ asset('/public/images/category') }}/" + response['data']['image2']); 
					}
				}
            }
        });
	}
</script>
<style>
.pull-right a{ display:inline-block;}
</style>
@endsection
