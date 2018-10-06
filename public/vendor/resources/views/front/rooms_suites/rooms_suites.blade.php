@extends('front/templateFront')

@section('content')

<!--================= Page Wellcome Area ===================-->
    <div class="page-heading-area sub-banner1">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="page-heading">
            </h2><!--/.page-heading-->
          </div><!--/.col-md-12-->
        </div><!--/.row-->
      </div><!--/.container--> 
    </div><!--/.page-heading-area-->
    <!--================= Content Area ===================-->
    <div class="room-grid-area bg-grey">
      <div class="container">
      	<div class="row">
          <div class="col-md-8 col-full-width">
            <div class="section-title-area text-center">
              <h2 class="section-title">Rooms &amp; Suites</h2>
              <p class="section-title-dec">Our varied choice of rooms has been designed to suit your needs, be it for business travellers, family or group leisure.</p>
            </div><!--/.section-title-area-->
          </div><!--/.col-md-8-->
        </div><!--/.row-->
        
        <div class="row">
         
         
         
         
         
         
         @foreach($product as $products)
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/admin/products/medium/'.$products->thumbnail_image_1) }}" alt="deluxe room" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM {{$products->sale_price}} nett / Night </h5>
                <h3 class="room-title"><a href="#">{{$products->type}}</a></h3>
                <h4 class="room-structure">{{$products->guest}}</h4>
                <div class="room-services">
                    <?php $amen = json_decode($products->amenities); ?>
                    @if(isset($amen->computer)) <i class="fa fa-computer"></i> @endif
                    @if(isset($amen->tv)) <i class="fa fa-television"></i> @endif
                    @if(isset($amen->air)) <i class="fa-air-conditioner"></i> @endif
                    @if(isset($amen->awesome)) <i class="fa fa-eye"></i> @endif
                    @if(isset($amen->service )) <i class="fa fa-diamond"></i> @endif
                    @if(isset($amen->pickup)) <i class="fa fa-plane"></i> @endif
                    @if(isset($amen->wifi)) <i class="fa fa-wifi"></i> @endif
                    @if(isset($amen->coffee )) <i class="fa fa-coffee"></i> @endif
                  @if(isset($amen->lock )) <i class="fa fa-key"></i> @endif
                </div>
                  <a href="{{route('rooms-suites/show',$products->id)}}" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div><!--/.col-md-4-->
         
       @endforeach  
         
         
         
         
         
         
         
         
         
         <?php /*?>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img_super_deluxe.jpg') }}" alt="Super Deluxe Room" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 168 nett / Night </h5><a href="#" class="room-title"></a>
                <h3 class="room-title"><a href="#">Super Deluxe Room</a></h3>
                <h4 class="room-structure">Max 2 People  </h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img_family_deluxe.jpg') }}" alt="Family Deluxe Room" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 200 nett / Night </h5>
                <h3 class="room-title"><a href="#">Family Deluxe Room</a></h3>
                <h4 class="room-structure">Max 2 Adults / 2 Kids  </h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div><?php */?>
          <div class="clearfix hidden-xs"></div>
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
        <?php /*?>  <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img_premier.jpg') }}" alt="Premier Room" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 240 nett / Night </h5>
                <h3 class="room-title"><a href="#">Premier Room</a></h3>
                <h4 class="room-structure">Max 2 People</h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img_family_premier.jpg') }}" alt="Family Premier Room" class="room-thumb">
              <div class="room-info box-radius">
                <h5>Starting from RM 270 nett / Night </h5>
                <h3 class="room-title"><a href="#">Family Premier Room</a></h3>
                <h4 class="room-structure">Max 3 People / Max 4 People</h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img_executive_suite.jpg') }}" alt="Executive Suite" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 260 nett / Night </h5>
                <h3 class="room-title"><a href="#">Executive Suite</a></h3>
                <h4 class="room-structure">Max 2 People  </h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div>
          <div class="clearfix hidden-xs"></div>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img-5.jpg') }}" alt="Family Suite" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 402 nett/ Night </h5>
                <h3 class="room-title"><a href="#">Family Suite</a></h3>
                <h4 class="room-structure">Max 2 Adults / 2 Kids</h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-microphone-slash"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img-2.jpg') }}" alt="Garden Suite" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 460 nett / Night </h5>
                <h3 class="room-title"><a href="#">Garden Suite</a></h3>
                <h4 class="room-structure">Max 2 People</h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="#" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="single-room grid"><img src="{{ asset('public/front/images/rooms/img-4.jpg') }}" alt="Ritz Suite" class="room-thumb">
              <div class="room-info box-radius">
                <h5>RM 1500 nett / Night </h5>
                <h3 class="room-title"><a href="room-single-page.html">Ritz Suite</a></h3>
                <h4 class="room-structure">Max 2 People</h4>
                <div class="room-services"><i class="fa fa-television"></i><i class="fa fa-coffee"></i><i class="fa fa-cutlery"></i><i class="fa fa-wifi"></i></div><a href="room-single-page.html" class="btn btn-details">more details</a>
              </div>
            </div><!--/.single-room-->
          </div><?php */?>
        </div><!--/.row-->
        
      </div><!--/.container-->
    </div><!--/.room-grid-area-->
    
@endsection    