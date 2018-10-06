@extends('front/templateFront')

@section('content')

<section id="content">
        	{!! $about['title'] !!}
            <div class="md-margin2x"></div>
            <div class="container">
                <div class="row">
                	<div class="col-md-12">
                        <div class="hero-unit">
                           {!! $about['info-title'] !!}
                            <span class="small-bottom-border big"></span>
                           {!! $about['info-name'] !!}
                        </div>
                        <div class="md-margin2x"></div>
                        <div class="row">
                        	<div class="col-md-12">
                            	 {!! $about['info-description'] !!} 
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
                                    <div class="items">
                                    	<div class="circle"><i class="fa {!! $about['icon-img1'] !!}"></i></div>
                                    </div>
                                   {!! $about['first-icon-title'] !!}
                                   {!! $about['first-icon-description'] !!}
                                </div>
                            </div>
                            <!-- end col-md-6 -->
                            
                            <div class="col-md-6 col-sm-3 col-xs-6 service-box-container">
                                <div class="services-box">
                                    <div class="items">
                                    	<div class="circle"><i class="fa {!! $about['icon-img2'] !!}"></i></div>
                                    </div>
                                    {!! $about['second-icon-title'] !!}
                                     {!! $about['second-icon-description'] !!}
                                </div>
                            </div>
                            <!-- end col-md-6 -->
                            <div class="lg-margin"></div>
   
                        </div>
                        <!-- end row vision & mission -->
                         <div class="xlg-margin"></div> 
                       
                    </div>
                    <!-- end col-md-12 -->
                    
            	</div>
                <!-- end row -->
                
    		</div>
            <!-- end container -->
            
            <!-- objective start -->
            <div id="testimonials-section" style="background-image:url('../'.{{ $abbgimage }});">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1>Objective</h1>
                            <p class="line">&nbsp;</p>
                            <div class="about-us-testimonials flexslider">
                                <ul class="slides">
								@if(isset($textslider) && !empty($textslider))
								@foreach($textslider as $item)
                                    <li><h2>{!! $item['title'] !!}</h2></li>
                                @endforeach
								@endif
                                </ul> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="xlg-margin"></div>
            <!-- objective end -->

			<div class="container">
                <div class="row">
                	<div class="col-md-12">
                    	<!-- our story start -->
                        <div class="hero-unit">
                            {!! $about['content-title1'] !!}
                            <span class="small-bottom-border big"></span>
                           {!! $about['content-signature1'] !!}
                        </div>
                        <div class="md-margin2x"></div>
                        {!! $about['content-text1'] !!}    <hr>
                        <div class="md-margin"></div>
                        <!-- end our story -->
                        
                        <!-- our business strategy start -->
                        <div class="hero-unit">
                            {!! $about['content-title2'] !!}  
                            <span class="small-bottom-border big"></span>
                           {!! $about['content-signature2'] !!}  
                        </div>
                        <div class="md-margin2x"></div>
                        {!! $about['content-text2'] !!}  
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
                             {!! $about['content-title3'] !!}
                            <span class="small-bottom-border big"></span>
                             {!! $about['content-signature3'] !!}  
                        </div>
                        <div class="md-margin2x"></div>
                        {!! $about['content-text3'] !!}  </div>
                    <!-- end how to choose our logo concept -->
                    
                    <!-- responses to the logo start -->
                    <div class="col-md-6 col-sm-3 col-xs-6">
                        <div class="hero-unit">
                           {!! $about['content-title4'] !!} 
                            <span class="small-bottom-border big"></span>
                             {!! $about['content-signature4'] !!} 
                        </div>
                        <div class="md-margin2x"></div>
                       {!! $about['content-text4'] !!}          
                    </div>
                    <div class="xlg-margin"></div>
                    <!-- end responses to the logo -->
                    
                </div>
                <!-- end row -->
                
           </div>
           <!-- end container -->
           <!-- end our story -->
    
    </section>

@endsection
