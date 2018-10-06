@extends('adminLayout')

@section('content')

<div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

	<div class="page-header-breadcrumb">
	  <div class="page-heading hidden-xs">
	    <h1 class="page-title">Shipping Setup</h1>
	  </div>

	  
	  <ol class="breadcrumb page-breadcrumb">
	    <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('web88cms/dashboard')}}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
	    <li>Shipping Setup &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
	    <li class="active">{{$title}} - Listing</li>
	  </ol>
	  </div>
	<!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
	
	<div class="page-content">
	  <div class="row">
	    <div class="col-lg-12">
	      <h2>{{$title}} <i class="fa fa-angle-right"></i> Listing</h2>
	      <div class="clearfix"></div>
	      @if (Session::has('success'))
	      <div class="alert alert-success alert-dismissable">
	        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
	        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
	        <p>{{Session::get('success')}}</p>
	      </div>
	      @elseif (Session::has('error'))
	      <div class="alert alert-danger alert-dismissable">
	        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
	        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
	        <p>{{Session::get('error')}}</p>
	      </div>
	      @endif
	      <div class="pull-left"> Last updated: <span class="text-blue">{{ ($lastUpdate)?date('d M, Y @ g:i A', strtotime($lastUpdate)):'Last Update date not available' }}</span> </div>
	      <div class="clearfix"></div>
	      <p></p>
	      
	      @if ($type == config('ship.csv'))
	      	@include('admin.ship.csv_import_list', ['ships' => $ships, 'type' => $type])
	      @elseif ($type == config('ship.category'))
	      	@include('admin.ship.by_category_list', ['ships' => $ships, 'type' => $type])
	      @elseif ($type == config('ship.weight'))
	      	@include('admin.ship.by_total_weight_list', ['ships' => $ships, 'type' => $type])
	      @elseif ($type == config('ship.amount'))
	      	@include('admin.ship.by_total_amount_list', ['ships' => $ships, 'type' => $type])
	      @endif
	      <div class="clearfix"></div>
	      <div class="tool-footer text-right">
           	<p class="pull-left">{{ $paginate_msg }}</p>
           	{!! $ships->setPath(Request::url())->render() !!}
          </div>
		  <div class="clearfix"></div>
	    </div>
	    <!-- end col-lg-12 -->
	  </div>
	  <!-- end row -->
	</div>
	
	<!--END CONTENT-->

	    <!--BEGIN FOOTER-->
		<div class="page-footer">
                <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                	<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
                </div>
        </div>
    <!--END FOOTER--></div>
  <!--END PAGE WRAPPER-->
<script>
$(function(){
	$('select[name="select_per_page"]').change(function(){
		url = '<?= url("web88cms/shipping_method") . '/'.$typeName .'/' ?>' + $(this).val();
		@if ($_SERVER['QUERY_STRING'])
			url += "?{{ $_SERVER['QUERY_STRING'] }}";
		@endif

		window.location = url;	
	});
})
</script>
@stop