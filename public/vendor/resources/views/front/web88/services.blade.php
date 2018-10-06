@extends('front/templateFront')

@section('content')
        <section id="content">
            <div id="page-header" class="parallax">
			{!! $data['header'] !!}
            </div><!--end #page-header-->
            <div class="md-margin2x"></div>
            <div class="container">
                <div class="row">
                	<div class="col-md-12">

                        <div class="row">

                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                        {!! $data['icon'][0]['img'] !!}
                                    </div>
                                    {!! $data['icon'][0]['title'] !!}
                                    {!! $data['icon'][0]['sm-descr'] !!}
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-delivery-installation">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end delivery & installation -->

                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                       {!! $data['icon'][1]['img'] !!}
                                    </div>
                                    {!! $data['icon'][1]['title'] !!}
                                   {!! $data['icon'][1]['sm-descr'] !!}
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-product-reservation">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                            </div>
                            <!-- end product reservation -->

                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                        {!! $data['icon'][2]['img'] !!}
                                    </div>
                                    {!! $data['icon'][2]['title'] !!}
                                    {!! $data['icon'][2]['sm-descr'] !!}
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-credit-card">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                            </div>
                            <!-- end credit card point redemption -->
                            <div class="md-margin clearfix"></div>


                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                        {!! $data['icon'][3]['img'] !!}
                                    </div>
                                    {!! $data['icon'][3]['title'] !!}
                                    {!! $data['icon'][3]['sm-descr'] !!}
                                     <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-instalment-plans">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end instalment plans -->

                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                       {!! $data['icon'][4]['img'] !!}
                                    </div>
                                    {!! $data['icon'][4]['title'] !!}
                                    {!! $data['icon'][4]['sm-descr'] !!}
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-extended-warranty">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end extended warranty -->

                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                        {!! $data['icon'][5]['img'] !!}
                                    </div>
                                    {!! $data['icon'][5]['title'] !!}
                                    {!! $data['icon'][5]['sm-descr'] !!}
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-product-exchange">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end product exchange -->
                            <div class="md-margin clearfix"></div>

                            <div class="col-md-4 col-sm-4 col-xs-12 service-box-container small-services">
                                <div class="services-box">
                                    <div class="items">
                                        {!! $data['icon'][6]['img'] !!}
                                    </div>
                                    {!! $data['icon'][6]['title'] !!}
                                    {!! $data['icon'][6]['sm-descr'] !!}
                                    <a href="#" class="label label-primary" data-toggle="modal" data-target="#modal-accessories-spare-parts">Terms &amp; Conditions</a>
                                    <div class="sm-margin"></div>
                                </div>
                        	</div>
                            <!-- end accessories & spare parts -->

                        </div>
                        <!-- end row -->
                        <div class="xs-margin"></div>

                        <!-- Modal delivery & installation start -->
                        <div class="modal fade" id="modal-delivery-installation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                </div><!-- End .modal-header -->
                                                <div class="modal-body">
    												{!! $data['icon'][0]['descr'] !!}

                                                </div><!-- End .modal-body -->
                                                <div class="modal-footer">
                                                	<button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                </div><!-- End .modal-footer -->
                                            </div><!-- End .modal-content -->
                                        </div><!-- End .modal-dialog -->
                                    </div>
                                    <!-- End .modal delivery & installation -->

                                    <!-- Modal product reservation start -->
                                    <div class="modal fade" id="modal-product-reservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body">
                                                                {!! $data['icon'][1]['descr'] !!}

                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </div>
                                                <!-- End .modal product reservation -->

                                                <!-- Modal credit card start -->
                                    			<div class="modal fade" id="modal-credit-card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body">
                                                                {!! $data['icon'][2]['descr'] !!}

                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </div>
                                                <!-- End .modal credit card -->

                                                <!-- Modal instalment plans start -->
                                    			<div class="modal fade" id="modal-instalment-plans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body">
                                                                {!! $data['icon'][3]['descr'] !!}

                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </div>
                                                <!-- End .modal instalment plans -->

                                                <!-- Modal extended warranty start -->
                                    			<div class="modal fade" id="modal-extended-warranty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body">
                                                               {!! $data['icon'][4]['descr'] !!}

                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </div>
                                                <!-- End .modal extended warranty -->

                                                <!-- Modal product exchange start -->
                                    			<div class="modal fade" id="modal-product-exchange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body">
                                                                {!! $data['icon'][5]['descr'] !!}

                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </div>
                                                <!-- End .modal product exchange -->

                                                <!-- Modal accessories & spare parts start -->
                                    			<div class="modal fade" id="modal-accessories-spare-parts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title" id="myModalLabel3">Terms &amp; Conditions</h4>
                                                            </div><!-- End .modal-header -->
                                                            <div class="modal-body">
                                                               {!! $data['icon'][6]['descr'] !!}

                                                            </div><!-- End .modal-body -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-custom-2" data-dismiss="modal">Close</button>
                                                            </div><!-- End .modal-footer -->
                                                        </div><!-- End .modal-content -->
                                                    </div><!-- End .modal-dialog -->
                                                </div>
                                                <!-- End .modal accessories & spare parts -->


                    </div>
                    <!-- end col-md-12 -->

            	</div>
                <!-- end row -->

    		</div>
            <!-- end container -->

    </section>

@endsection
