<div id="room-amenities" class="tab-pane fade {{ (($tab) && ($tab=='room-amenities'))?'in active':'' }}">

    <form action="#" method="post" onsubmit="return gliss.rooms.saveAmenities(this, event, '{{$productDetails->id}}')">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <div class="portlet">

            <div class="portlet-header">
                <div class="alert-success amenities" style="display:none">The parameters have been successfully saved</div>
                <div class="caption">Room Amenities</div>
                <div class="clearfix"></div>
                <p class="margin-top-10px"></p>
            </div>

            <div class="portlet-body">
                <div class="room-service-area clearfix">

                    <div class="form-group">
                        <input type="checkbox" name="r_size" id="r-size" @if(isset($amenities->r_size)) checked @endif>
                        <label for="r-size" class="control-label"><i class="fa fa-home"></i>Room Size
                            <input type="number" name="r_size_ft" value="{{$amenities->r_size_ft or ''}}" style="width: 50px;"> FT<sup>2</sup></label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="computer" id="computer" @if(isset($amenities->computer)) checked @endif>
                        <label for="computer" class="control-label"><i class="fa fa-laptop"></i>computer</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="awesome" id="awesome" @if(isset($amenities->awesome)) checked @endif>
                        <label for="awesome" class="control-label"><i class="fa fa-eye"></i>Awesome View</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="wifi" id="wifi" @if(isset($amenities->wifi)) checked @endif>
                        <label for="wifi" class="control-label"><i class="fa fa-wifi"></i>WIFI</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="tv" id="tv" @if(isset($amenities->tv)) checked @endif>
                        <label for="tv" class="control-label"><i class="fa fa-television"></i>Flat Screen TV</label>
                    </div>
                    <div class="form-group">
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
                    </div>

                </div>

            </div>
            <!-- end portlet body -->

        </div>
        <!-- end portlet -->

        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>&nbsp;
            <a href="#" class="btn btn-danger" data-hover="tooltip" >Cancel</a>&nbsp;
        </div>

    </form>

</div>