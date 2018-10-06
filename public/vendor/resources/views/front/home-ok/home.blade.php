@extends('front/templateFront')
@section('content')
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row slider-position">
                    <div class="md-margin"></div>
                    <div class="col-md-3 col-sm-4 col-xs-12 sidebar">
                        @include('front.module.shop_categories')
                        @include('front.module.top_selling_brands')
                        @include('front.module.newsletter_module')
                        @include('front.module.most_buy')
                        @include('front.module.latest_promo')
                        @include('front.module.banner_left_slider')
	               </div>       
                    <div class="col-md-9 col-sm-8 col-xs-12 main-content">
                        @include('front.module.banner_top_slider')       
                        @include('front.module.banner_middle_top_slider')   
                        <div class="main-tab-container carousel-wrapper">
                            @include('front.module.latest_arrivals')
                        </div>
                        <!--  <div class="xs-margin"></div>-->
                        @include('front.module.banner_bottom_middle_slider')
                        <!-- <div class="lg-margin2x"></div>-->       
        				@include('front.module.homeCategoryWithoutTab')           
        				<!-- End .hot-items -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
