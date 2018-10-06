<div id="room-amenities" class="tab-pane fade {{ (($tab) && ($tab=='room-amenities'))?'in active':'' }}">

    <form action="#" method="post" onsubmit="return gliss.rooms.saveAmenities(this, event, '{{$productDetails->id}}')">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <div class="portlet">

            <div class="portlet-header">
                <div class="alert alert-success alert-dismissable amenities" style="display:none">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                    <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                    <p>The parameters have been successfully saved</p>
                </div>
                <div class="caption">Room Amenities</div>
                <div class="clearfix"></div>
                <p class="margin-top-10px"></p>
            </div>

            <div class="portlet-body">
                <div class="room-service-area clearfix">
					
                    <div class="col-md-6">

                    <!--<div class="form-group">
                        <input type="checkbox" name="r_size" id="r-size" @if(isset($amenities->r_size)) checked @endif>
                        <label for="r-size" class="control-label"><i class="fa fa-home"></i>Room Size
                            <input type="number" name="r_size_ft" value="{{$amenities->r_size_ft or ''}}" style="width: 50px;"> FT<sup>2</sup></label>
                    </div>-->
                     <div class="form-group">
                        <input type="checkbox" name="aircon" id="aircon" @if(isset($amenities->aircon)) checked @endif>
                        <label for="aircon" class="control-label"><i class="fa fa-thermometer"></i> Individually controllable Air-conditioning</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="shower" id="shower" @if(isset($amenities->shower)) checked @endif>
                        <label for="shower" class="control-label"><i class="fa fa-shower"></i> Bathroom with cold/hot shower</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="coffee" id="coffee" @if(isset($amenities->coffee)) checked @endif>
                        <label for="coffee" class="control-label"><i class="fa fa-coffee"></i> Coffee and tea facility</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="water" id="water" @if(isset($amenities->water)) checked @endif>
                        <label for="water" class="control-label"><i class="fa fa-check-circle-o"></i> Bottled drinking water</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="bathroom" id="bathroom" @if(isset($amenities->bathroom)) checked @endif>
                        <label for="bathroom" class="control-label"><i class="fa fa-bath"></i> Bathroom amenities</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="safe" id="safe" @if(isset($amenities->safe)) checked @endif>
                        <label for="safe" class="control-label"><i class="fa fa-lock"></i> In room electronic safe</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="hairdryer" id="hairdryer" @if(isset($amenities->hairdryer)) checked @endif>
                        <label for="hairdryer" class="control-label"><i class="fa fa-check-circle-o"></i> Built-in hairdryer</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="minibar" id="minibar" @if(isset($amenities->minibar)) checked @endif>
                        <label for="minibar" class="control-label"><i class="fa fa-glass"></i> Mini-bar</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="phone" id="phone" @if(isset($amenities->phone)) checked @endif>
                        <label for="phone" class="control-label"><i class="fa fa-fax"></i> IDD phone</label>
                    </div>
                    <!--<div class="form-group">
                        <input type="checkbox" name="computer" id="computer" @if(isset($amenities->computer)) checked @endif>
                        <label for="computer" class="control-label"><i class="fa fa-laptop"></i>computer</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="awesome" id="awesome" @if(isset($amenities->awesome)) checked @endif>
                        <label for="awesome" class="control-label"><i class="fa fa-eye"></i>Awesome View</label>
                    </div>-->
                    <div class="form-group">
                        <input type="checkbox" name="wifi" id="wifi" @if(isset($amenities->wifi)) checked @endif>
                        <label for="wifi" class="control-label"><i class="fa fa-wifi"></i> Wireless internet access (FREE)</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="tv" id="tv" @if(isset($amenities->tv)) checked @endif>
                        <label for="tv" class="control-label"><i class="fa fa-television"></i> Television with Astro channels</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="kiblat" id="kiblat" @if(isset($amenities->kiblat)) checked @endif>
                        <label for="kiblat" class="control-label"><i class="fa fa-arrows"></i> Kiblat directional sign</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="laundry" id="laundry" @if(isset($amenities->laundry)) checked @endif>
                        <label for="laundry" class="control-label"><i class="fa fa-check-circle-o"></i> Laundry service</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="ironboard" id="ironboard" @if(isset($amenities->ironboard)) checked @endif>
                        <label for="ironboard" class="control-label"><i class="fa fa-check-circle-o"></i> Ironing board</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="pool" id="pool" @if(isset($amenities->pool)) checked @endif>
                        <label for="pool" class="control-label"><i class="fa fa-check-circle-o"></i> Private swimming pool</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="jacuzzi" id="jacuzzi" @if(isset($amenities->jacuzzi)) checked @endif>
                        <label for="jacuzzi" class="control-label"><i class="fa fa-check-circle-o"></i> Cool Jacuzzi</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="sauna" id="sauna" @if(isset($amenities->sauna)) checked @endif>
                        <label for="sauna" class="control-label"><i class="fa fa-check-circle-o"></i> Steam/sauna bath</label>
                    </div>
                    <!--<div class="form-group">
                        <input type="checkbox" name="air" id="air" @if(isset($amenities->air)) checked @endif>
                        <label for="air" class="control-label"><i class="fa fa-microphone"></i>Air Conditioning</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="lock" id="2lock" @if(isset($amenities->lock)) checked @endif>
                        <label for="2lock" class="control-label"><i class="fa fa-eye"></i>Double Locking Doors</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="coffee" id="coffee" @if(isset($amenities->coffee)) checked @endif>
                        <label for="coffee" class="control-label"><i class="fa fa-coffee"></i>Tea/Coffee Making Facilities</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="service" id="service" @if(isset($amenities->service)) checked @endif>
                        <label for="service" class="control-label"><i class="fa fa-microphone-slash"></i>Room Service</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="pickup" id="pickup" @if(isset($amenities->pickup)) checked @endif>
                        <label for="pickup" class="control-label"><i class="fa fa-plane"></i>Airport Pickup</label>
                    </div>-->
				</div><!-- end col-md-6-->
                
                <div class="col-md-6">

                	<div class="form-group">
                        <input type="checkbox" name="kitchen" id="kitchen" @if(isset($amenities->kitchen)) checked @endif>
                        <label for="kitchen" class="control-label"><i class="fa fa-free-code-camp"></i> Kitchen facilities</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="flatscreen" id="flatscreen" @if(isset($amenities->flatscreen)) checked @endif>
                        <label for="flatscreen" class="control-label"><i class="fa fa-television"></i> Flat screen TV in all rooms</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="sitting" id="sitting" @if(isset($amenities->sitting)) checked @endif>
                        <label for="sitting" class="control-label"><i class="fa fa-check-circle-o"></i> Comfortable sitting room with sofa &amp; dining table</label>
                    </div>
                	
                </div><!-- end col-md-6-->
                
                </div>

            </div>
            <!-- end portlet body -->

        </div>
        <!-- end portlet -->

        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>&nbsp;
        </div>

    </form>

</div>