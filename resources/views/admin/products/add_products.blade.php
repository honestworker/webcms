@extends('adminLayout')

@section('content')
@push('styles')
<link type="text/css" rel="stylesheet" href="{{ asset('/public/admin/css/price-calendar.css') }}">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
<!--BEGIN PAGE WRAPPER-->
<div id="page-wrapper">

  <!--BEGIN PAGE HEADER & BREADCRUMB-->
  <div class="page-header-breadcrumb">
    <div class="page-heading hidden-xs">
      <h1 class="page-title">Services</h1>
    </div>

    <ol class="breadcrumb page-breadcrumb">
      <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/web88cms/dashboard/') }}">Dashboard</a>&nbsp; <i class="fa fa-angle-right"></i>&nbsp;</li>
      <li>Services &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
      <li><a href="{{ url('/web88cms/products/list') }}">Services Listing</a> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>
      <li class="active">Service - Add New</li>
    </ol>
  </div>
  <!--END PAGE HEADER & BREADCRUMB-->

  <!--BEGIN CONTENT-->
  <div class="page-content">
    <div class="row">
      <div class="col-lg-12">
        <h2>Service <i class="fa fa-angle-right"></i> Add New</h2>
        <div class="clearfix"></div>

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
        <ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab">General</a></li>
          <!--<li><a href="#images" data-toggle="tab">Images</a></li>
          <li><a href="#description-feature" data-toggle="tab">Description &amp; Features</a></li>
          <li><a href="#shipping-info" data-toggle="tab">Shipping Information</a></li>
          <li><a href="#quantity-discount" data-toggle="tab">Quantity Discounts</a></li>-->
        </ul>
        <div id="myTabContent" class="tab-content">
          <div id="general" class="tab-pane fade in active">
            <form class="form-horizontal" method="post" action="{{ url('web88cms/products/addProduct') }}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">General</div>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>

                <?php
                $input = Request::old();
                //if($input) dd($input);
                ?>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <div data-on="success" data-off="primary" class="make-switch" style="height:32px;">
                            <input type="checkbox" name="status" <?php if(isset($input['status']) && $input['status']!='0'){ echo 'checked="checked"'; } ?>/>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Service Name <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <input type="text" name="product_name" class="form-control" placeholder="Service Name" value="{{ old('product_name') }}">
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Type <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <input type="text" name="type" class="form-control" placeholder="eg. Premier Room" value="{{ old('type') }}">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <!-- <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Service Code <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <input type="text" name="product_code" class="form-control" placeholder=Service Code" value="{{ old('product_code') }}">
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Room Code <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <input type="text" name="room_code" class="form-control" placeholder="eg. PR-XXXXX01" value="{{ old('room_code') }}">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Bed </label>
                        <div class="col-md-6">
                          <input type="text" name="bed" class="form-control" placeholder="eg. 1 King or 2 Singles" value="{{ old('bed') }}">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Guest </label>
                        <div class="col-md-6">
                          <input type="text" name="guest" class="form-control" placeholder="eg. Max. 2 guests" value="{{ old('guest') }}">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Meal </label>
                        <div class="col-md-6">
                          <input type="text" name="meal" class="form-control" placeholder="eg. 2 breakfasts" value="{{ old('meal') }}">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Promo Behaviour</label>
                        <div class="col-md-6">
                          <div class="xss-margin"></div>
                          <div class="checkbox-list">
                            <label><input id="inlineCheckbox1" name="promo_behaviour[]" type="radio" value="none" <?php if(isset($input['promo_behaviour']) && in_array('none',$input['promo_behaviour'])){ echo 'checked="checked"'; } ?>/>&nbsp; None</label>
                            <label><input id="inlineCheckbox1" name="promo_behaviour[]" type="radio" value="hot" <?php if(isset($input['promo_behaviour']) && in_array('hot',$input['promo_behaviour'])){ echo 'checked="checked"'; } ?>/>&nbsp; Hot</label>
                            <label><input id="inlineCheckbox2" name="promo_behaviour[]" type="radio" value="new" <?php if(isset($input['promo_behaviour']) && in_array('new',$input['promo_behaviour'])){ echo 'checked="checked"'; } ?>/>&nbsp; New</label>
                            <label><input id="inlineCheckbox3" name="promo_behaviour[]" type="radio" value="sale" <?php if(isset($input['promo_behaviour']) && in_array('sale',$input['promo_behaviour'])){ echo 'checked="checked"'; } ?>/>&nbsp; Sale</label>
                            <label><input id="inlineCheckbox4" name="promo_behaviour[]" type="radio" value="pwp" <?php if(isset($input['promo_behaviour']) && in_array('pwp',$input['promo_behaviour'])){ echo 'checked="checked"'; } ?>/>&nbsp; PWP</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Category <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <select multiple="multiple" name="categories[]" class="form-control" style="height: 350px;">
                            <?php echo $categories; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Room Price / Qty <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <div class="xss-margin"></div>
                          <a href="#" data-target="#modal-add-new" data-toggle="modal" class="btn btn-success">Add New Room Price / Qty &nbsp;<i class="fa fa-plus"></i></a>
                          <div class="xss-margin"></div>
                        </div>
                        <input type="hidden" name="roomPrices" id="roomPrices" />
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 control-label">Upload Thumbnail Image</label>
                        <div class="col-md-9">
                          <div class="text-15px margin-top-10px">
                            <div class="text-blue text-12px">Thumbnails displayed on "Rooms Listing" page.</div>
                          <div class="xss-margin"></div>
                            <input id="exampleInputFile1" type="file" name="thumbnail_image_1"/>
                            <span class="help-block">(Image dimension: 360 x 314 pixels, JPEG/GIF/PNG only, Max. 2MB) </span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group" style="display:none">
                        <label for="inputFirstName" class="col-md-3 control-label">Quantity in Stock (rooms)</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="quantity_in_stock" placeholder="" value="<?php echo (isset($input['quantity_in_stock'])) ? $input['quantity_in_stock'] : ''; ?>">
                          <div class="xss-margin"></div>
                          <div class="text-blue text-12px">Rooms remaining in the hotel.</div>
                        </div>
                      </div>
                      <div class="form-group" style="display:none">
                        <label for="inputFirstName" class="col-md-3 control-label">Low Level in Stock (rooms)</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="low_level_in_stock" placeholder="" value="<?php echo (isset($input['low_level_in_stock'])) ? $input['low_level_in_stock'] : ''; ?>">
                          <div class="xss-margin"></div>
                          <div class="text-blue text-12px">Shows the minimum level of a service in the warehouse, at which the stock is considered to be low.</div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Display Order</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control" name="display_order" placeholder="" value="<?php echo (isset($input['display_order'])) ? $input['display_order'] : ''; ?>">
                          <div class="xss-margin"></div>
                          <div class="text-blue text-12px">The display order of the service.</div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Tax</label>
                        <div class="col-md-6">
                          <div class="xss-margin"></div>
                          <input type="checkbox" name="is_tax" <?php if(isset($input['is_tax'])){ echo 'checked="checked"'; } ?>> GST
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Tag</label>
                        <div class="col-md-5">
                          <input type="text" name="tags" class="form-control" placeholder="eg. Premier Room" value="<?php echo (isset($input['tags'])) ? $input['tags'] : ''; ?>"/><span class="input-group-btn"><!--<button type="button" class="btn btn-primary">Add</button>--></span>
                          <div class="xss-margin"></div>
                          <div class="text-blue text-12px">eg. Hotel Rooms, Premier Room, 50% Room Sales.</div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-md-12 -->
                  </div>
                  <!-- end row -->

                  <div class="clearfix"></div>
                  <!--Modal Add New Banner start-->
                  <div id="modal-add-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label2" class="modal-title">Add New Price</h4>
                        </div>

                        <div class="modal-body">
                          <div id="calendar"></div>
                          <div class="clearfix"></div>
                          <i class="fa fa-square alert-success"></i> <span class="text-success">Availability</span>
                          <i class="fa fa-square alert-error"></i> <span class="text-danger">No Availability</span>
                          <div class="form-actions">
                            <div class="col-md-offset-5 col-md-8">
                              <a href="#" class="btn btn-red" onclick="savePrices(); event.preventDefault();">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp;
                              <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--END MODAL Add New -->

                  <!--Modal add schedule start-->
                  <div id="modal-add-schedule" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title">Add Price / Qty / Restriction</h4>
                        </div>

                        <div class="modal-body">
                          <div class="form-group">
                            <label class="col-md-3 control-label">Status </label>
                            <div class="col-md-9">
                              <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-success active">
                                  <input id="roomStatusAvailable" type="radio" value='1' checked> Availability
                                </label>
                                <label class="btn btn-danger">
                                  <input id="roomStatusUnavailable" type="radio" value='0'> No Availability
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="salePrice" class="col-md-3 control-label">Sale Price (Per Night/nett) <span class="text-red">*</span></label>
                            <div class="col-md-6">
                              <input id="salePrice" type="text" class="form-control" placeholder="0.00" value="0.00">
                              <div class="xss-margin"></div>
                              <div class="text-blue text-12px">The product sale price. The product is sold to customers at this price.</div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="listPrice" class="col-md-3 control-label">List Price (Per Night/nett)</label>
                            <div class="col-md-6">
                              <input id="listPrice" type="text" class="form-control" placeholder="0.00" value="0.00">
                              <div class="xss-margin"></div>
                              <div class="text-blue text-12px">Original room tariff rates.</div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="inputFirstName" class="col-md-3 control-label">Quantity in Stock (rooms)</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" id="quantity_in_stock" placeholder="0.00" value="0.00">
                              <div class="xss-margin"></div>
                              <div class="text-blue text-12px">Rooms remaining in the hotel.</div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputFirstName" class="col-md-3 control-label">Low Level in Stock (rooms)</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" id="low_level_in_stock" placeholder="0.00" value="0.00">
                              <div class="xss-margin"></div>
                              <div class="text-blue text-12px">Shows the minimum level of a service in the warehouse, at which the stock is considered to be low.</div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label">Bulk Options </label>
                            <div class="col-md-9">
                              <div class="xss-margin"></div>
                              <div class="col-md-9">
                              <label><input id="radioBulkDateRange" type="radio" name="radioBulkOptions" value="1" />&nbsp; By Date Range</label>
                              <div class="margin-top-10px text-blue border-bottom">You may set up a single day or a range of dates for the status "No Availability" or promotional price for festive period.</div>

                              <div class="xss-margin"></div>
                              <div class="input-group input-daterange">
                                <input id="start" type="text" class="form-control" placeholder="eg. 01 March, 2017"/>
                                <span class="input-group-addon">to</span>
                                <input id="end" type="text" class="form-control" placeholder="eg. 01 April, 2017"/>
                              </div>
                              <!-- end input daterange -->

                              <div class="xss-margin"></div>
                                <div class="input-group input-daterange">
                                <input id="start" type="text" class="form-control" placeholder="eg. 01 March, 2017"/>
                                <span class="input-group-addon">to</span>
                                <input id="end" type="text" class="form-control" placeholder="eg. 01 April, 2017"/>
                              </div>
                              <!-- end input daterange -->

                              <div class="xss-margin"></div>
                              <div class="input-group input-daterange">
                                <input id="start" type="text" class="form-control" placeholder="eg. 01 March, 2017"/>
                                <span class="input-group-addon">to</span>
                                <input id="end" type="text" class="form-control" placeholder="eg. 01 April, 2017"/>
                              </div>
                              <!-- end input daterange -->

                              <div class="xss-margin"></div>
                              <a href="#" id="btnAddMoreDate" onclick="addMoreDate(); event.preventDefault();" class="btn btn-dark">Add More Date &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                            </div>
                            <!-- end col-md-9 -->

                            <div class="clearfix xs-margin"></div>
                            <div class="col-md-4">
                              <label><input id="radioByDayOfMonth" name="radioBulkOptions" type="radio" value="1" />&nbsp; By Day / Month</label>
                              <div class="clearfix"></div>
                              <span class="inline">Every
                                <select id="day" multiple="multiple" style="height: 180px" class="form-control">
                                  <option>- Select -</option>
                                  <option value="MON">Monday</option>
                                  <option value="TUE">Tuesday</option>
                                  <option value="WED">Wednesday</option>
                                  <option value="THU">Thursday</option>
                                  <option value="FRI">Friday</option>
                                  <option value="SAT">Saturday</option>
                                  <option value="SUN">Sunday</option>
                                </select>
                                of
                                <select id="month" multiple="multiple" style="height: 200px;" class="form-control">
                                  <option>- Select Month -</option>
                                  <option value="ALL">Every Month</option>
                                  <option value="1">January</option>
                                  <option value="2">February</option>
                                  <option value="3">March</option>
                                  <option value="4">April</option>
                                  <option value="5">May</option>
                                  <option value="6">June</option>
                                  <option value="7">July</option>
                                  <option value="8">August</option>
                                  <option value="9">September</option>
                                  <option value="10">October</option>
                                  <option value="11">November</option>
                                  <option value="12">December</option>
                                </select>
                              </span>
                            </div>
                            <!-- end col-md-4 -->

                            <div class="col-md-4">
                              <label><input id="radioByDaysOfYear" type="radio" name="radioBulkOptions" value="1"/>&nbsp; By Days / Year</label>
                              <div class="clearfix"></div>
                              <span class="inline">All
                                <select id="days" multiple="multiple" style="height: 180px;" class="form-control">
                                  <option>- Select -</option>
                                  <option value="MON">Mondays</option>
                                  <option value="TUE">Tuesdays</option>
                                  <option value="WED">Wednesdays</option>
                                  <option value="THU">Thursdays</option>
                                  <option value="FRI">Fridays</option>
                                  <option value="SAT">Saturdays</option>
                                  <option value="SUN">Sundays</option>
                                </select>
                                of
                                <select id="year" multiple="multiple" style="height: 200px;" class="form-control">
                                  <option>- Select Year -</option>
                                  @for($i = 0; $i < 10; $i++)
                                  <option value="{{ date('Y') + $i }}">{{ date('Y') + $i }}</option>
                                  @endfor
                                </select>
                              </span>
                              <div class="margin-top-10px"></div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label">Room Restriction Text</label>
                            <div class="col-md-9">
                              <textarea id="roomRestrictionText" class="form-control" placeholder="eg. This special rate is for online booking only."></textarea>
                            </div>
                          </div>
                          <hr>

                          <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                              <a href="#" class="btn btn-dark" onclick="addMorePrices(); event.preventDefault();">
                                Add More Price &nbsp;
                                <i class="fa fa-plus"></i>
                              </a>&nbsp;
                            </div>
                          </div>
                          <hr>

                          <div class="form-actions">
                            <div class="col-md-offset-5 col-md-8">
                              <a href="#" class="btn btn-red" onclick="renderPricesToCalendar(); event.preventDefault();">Save &nbsp;
                                <i class="fa fa-floppy-o"></i>
                              </a>&nbsp;
                              <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--END MODAL add schedule-->
                </div>
                <!-- end portlet body -->
              </div>
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Purchase Availability</div>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Creation Date</label>
                        <div class="col-md-4">
                          <div class="input-group">
                            <input type="text" name="created" class="datepicker-default form-control" data-date-format="dd/mm/yyyy" placeholder="17 Apr, 2015" value="<?php echo (isset($input['created'])) ? date('d M, Y',strtotime($input['created'])) : date('d M, Y'); ?>"/>
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Out of Stock Actions</label>
                        <div class="col-md-4">
                          <select class="form-control" name="out_of_stock_action">
                            <option value="none" <?php if(isset($input['out_of_stock_action']) && $input['out_of_stock_action'] == 'none'){ echo 'selected="selected"'; }; ?>>None</option>
                            <option value="signup"  <?php if(isset($input['out_of_stock_action']) && $input['out_of_stock_action'] == 'signup'){ echo 'selected="selected"'; }; ?>>Sign up for notification</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- end col-md-12 -->
                  </div>
                  <!-- end row -->
                  <div class="clearfix"></div>
                </div>
                <!-- end portlet body -->
              </div>
              <!-- end purchase availability -->

              <div class="form-actions">
                <div class="col-md-offset-5 col-md-7">
                  <button type="submit" class="btn btn-red" />Add Service &nbsp;<i class="fa fa-floppy-o"></i></button>
                  <!-- <a onclick="$('#addColorForm').submit()" class="btn btn-red" href="#">Save &nbsp;<i class="fa fa-floppy-o"></i></a>-->&nbsp;
                  <a class="btn btn-green" data-dismiss="modal" href="{{ url('/web88cms/products/list') }}">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                </div>
              </div>
            </form>
          </div>
          <!-- end tab general -->

          <div id="images" class="tab-pane fade">
            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Additional Service Images</div>
                <div class="clearfix"></div>
                <span class="text-blue text-15px">Additional product images will be displayed in "Product Details" page. Thumbnails will be generated from detailed images automatically. Thumbnails will be resized to 128 x 128 pixels.</span>
                <div class="xs-margin"></div>
                <div class="clearfix"></div>
                <a href="#" class="btn btn-success">Add More Image &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>

              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <form class="form-horizontal">
                      <div class="form-group border-bottom">
                        <label class="col-md-3 control-label">Upload Popup Larger Image of Additional Thumbnail</label>
                        <div class="col-md-9">
                          <div class="text-15px margin-top-10px">
                            <input id="exampleInputFile1" type="file"/>
                            <span class="help-block">(Image dimension: 800 x 800 pixels, JPEG/GIF/PNG only, Max. 2MB) </span>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="clearfix"></div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
            <!-- end images -->
          </div>
          <!-- end tab images -->

          <div id="description-feature" class="tab-pane fade">
            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Description</div>
                <div class="clearfix"></div>
                <span class="text-blue text-15px">You can edit the text by clicking the content below. </span>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>

              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <div contenteditable="true">
                      <p><strong>Start edit the content by clicking the text.</strong></p>
                      <p>Start edit the content by clicking the text.</p>
                    </div>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="clearfix"></div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
            <!-- end description -->

            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Features &amp; Video</div>
                <div class="clearfix"></div>
                <span class="text-blue text-15px">You can edit the text by clicking the content below.</span>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>

              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <div contenteditable="true">
                      <p>Start edit the content by clicking text.</p>
                      <ul class="product-details-list">
                        <li>Feature 1.</li>
                        <li>Feature 2.</li>
                        <li>Feature 3.</li>
                        <li>Feature 4.</li>
                        <li>Feature 5.</li>
                      </ul>
                      <div class="md-margin"></div>
                      <h4><strong>Video</strong></h4>
                      <hr>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="clearfix"></div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
            <!-- end features & video -->

            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Warranty &amp; Support</div>
                <div class="clearfix"></div>
                <span class="text-blue text-15px">You can edit the text by clicking the content below.</span>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>

              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <div contenteditable="true">
                      <p>Start edit the content by clicking text.</p>
                    </div>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="clearfix"></div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
            <!-- end warranty & support -->

            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Return Policy</div>
                <div class="clearfix"></div>
                <span class="text-blue text-15px">You can edit the text by clicking the content below.</span>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <div contenteditable="true">
                      <h4><strong>Sales Cancellation</strong></h4>
                      <hr>
                      <p>TBM Sdn Bhd remain the rights to refund if the sales cancelation made by purchaser after the payment. TBM Sdn Bhd will check through all the goods before delivery to ensure the goods are complete and remain functional. Any damage to the goods upon receive will be review by TBM Sdn Bhd either to refund, replace or claim warranty from manufacturer authorized office. If delivery has taken place, then the refund will exclude delivery charges paid. Warranty card and valid purchase receipt is required upon refund/replace/repair.</p>
                      <div class="md-margin"></div>
                      <h4><strong>Product Warranty</strong></h4>
                      <hr>
                      <p>TBM Sdn Bhd make no liable to the goods warranty, such Goods are supplied and sold on an "as is where is" basis, unless the manufacturer, or supplier, of such Goods has issued a warranty in respect of such Goods, in which case such Goods are supplied and sold with the warranties issued within three to twelve months and granted by the manufacturer, or supplier, of such Goods only. You hereby agree to look solely to such manufacturer, or supplier, for any claims related to such warranties.</p>
                      <p>All warranty will be covered under respective brands manufacturer, warranty period might be vary according to the types of product. Buyer will need to bear the return shipping fees. All postage fees (if any), will not be refundable. Any goods claimed to be defective must be returned in original condition.</p>
                      <div class="md-margin"></div>
                      <h4><strong>Price Payment Policy</strong></h4>
                      <hr>
                      <p>All price stated on TBM online platform will only be available on trading website platform, and all the specific promotions is not applicable for walk-in customer. All payment must be done within 3 working days, or TBM Sdn Bhd will have the rights to neglect the sales order that has been made. TBM Sdn Bhd has the right to decide for the Item sold out is non-refundable or exchangeable.</p>
                    </div>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="clearfix"></div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
            <!-- end return policy -->
          </div>
          <!-- end tab description & features -->

          <div id="shipping-info" class="tab-pane fade">
            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Shipping Information</div>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              </div>

              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <form class="form-horizontal" method="post" action="{{ url('/web88cms/products/updateShippingInformation') }}">
                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Weight (kg)</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="0.00" value="0.00">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Free Shipping</label>
                        <div class="col-md-2">
                          <select class="form-control">
                              <option value="" selected="selected">No</option>
                              <option>Yes</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Shipping Cost (RM)</label>
                        <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="0.00" value="0.00">
                        </div>
                      </div>
                      <div class="clearfix"></div>

                      <div class="form-actions">
                        <div class="col-md-offset-5 col-md-7">
                          <button type="submit" class="btn btn-red" />Save &nbsp;<i class="fa fa-floppy-o"></i></button>
                          <a class="btn btn-green" data-dismiss="modal" href="{{ url('/web88cms/products/list') }}">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- end col-md-12 -->
                </div>
                <!-- end row -->
                <div class="clearfix"></div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
          </div>
          <!-- end tab shipping information -->

          <div id="quantity-discount" class="tab-pane fade">
            <div class="portlet">
              <div class="portlet-header">
                <div class="caption">Quantity Discounts</div>
                <div class="clearfix"></div>
                <p class="margin-top-10px"></p>
                <a href="#" class="btn btn-success" data-hover="tooltip" data-placement="top" data-target="#modal-add-discount" data-toggle="modal">Add Quantity Discount &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                <div class="btn-group">
                  <button type="button" class="btn btn-primary">Delete</button>
                  <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a href="#" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
                    <li class="divider"></li>
                    <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                  </ul>
                </div>
                <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

                <!--Modal add discount start-->
                <div id="modal-add-discount" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog modal-wide-width">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-login-label3" class="modal-title">Add Quantity Discount</h4>
                      </div>

                      <div class="modal-body">
                        <div class="form">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                              <div class="col-md-6">
                                <div data-on="success" data-off="primary" class="make-switch">
                                  <input type="checkbox" checked="checked"/>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputFirstName" class="col-md-3 control-label">From Quantity</label>
                              <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Qty">
                              </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group">
                              <label for="inputFirstName" class="col-md-3 control-label">To Quantity</label>
                              <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Qty">
                              </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group">
                              <label for="inputFirstName" class="col-md-3 control-label">Discount </label>
                              <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Amount">
                                <div class="xs-margin"></div>
                                <select name="select" class="form-control">
                                  <option value="%" >%</option>
                                  <option value="RM">RM</option>
                                </select>
                              </div>
                            </div>

                            <div class="form-actions">
                              <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--END MODAL add new discount -->

                <!--Modal delete selected items start-->
                <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                      </div>
                      <div class="modal-body">
                        <p><strong>#1:</strong> Price per item - RM 650.00 (Discount - RM 20.00)</p>
                        <div class="form-actions">
                          <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal delete selected items end -->

                <!--Modal delete all items start-->
                <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-actions">
                          <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal delete all items end -->
              </div>

              <div class="portlet-body">
                <div class="form-inline pull-left">
                  <div class="form-group">
                    <select name="select" class="form-control">
                      <option>10</option>
                      <option>20</option>
                      <option selected="selected">30</option>
                      <option>50</option>
                      <option>100</option>
                    </select>
                    &nbsp;
                    <label class="control-label">Records per page</label>
                  </div>
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="table-responsive mtl">
                  <span class="text-red"><b>Sale Price: RM 670.00</b></span>
                  <table id="example1" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th width="1%"><input type="checkbox"/></th>
                        <th>#</th>
                        <th>Product Quantity</th>
                        <th>Product Price/Discount</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox"/></td>
                        <td>1</td>
                        <td>From 1 Item(s) to 99 Item(s)</td>
                        <td>Price per item - RM 650.00<br/>(Discount - RM 20.00)</td>
                        <td><span class="label label-sm label-success">Active</span></td>
                        <td>
                          <a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-discount" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-2" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                          <!--Modal edit discount start-->
                          <div id="modal-edit-discount" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title">Edit Quantity Discount</h4>
                                </div>

                                <div class="modal-body">
                                  <div class="form">
                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div data-on="success" data-off="primary" class="make-switch">
                                            <input type="checkbox" checked="checked"/>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">From Quantity</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Qty" value="1">
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">To Quantity</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Qty" value="99">
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount" value="20">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%" >%</option>
                                            <option value="RM" selected="selected">RM</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL edit discount -->

                          <!--Modal delete start-->
                          <div id="modal-delete-2" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this item? </h4>
                                </div>
                                <div class="modal-body">
                                  <p><strong>#01:</strong> Price per item - RM 650.00 (Discount - RM 20.00)</p>
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal delete end -->
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="6"></td>
                      </tr>
                    </tfoot>
                  </table>
                  <div class="tool-footer text-right">
                    <p class="pull-left">Showing 1 to 10 of 57 entries</p>
                    <ul class="pagination pagination mtm mbm">
                      <li class="disabled"><a href="#">&laquo;</a></li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- end portlet body -->
            </div>
            <!-- end portlet -->
          </div>
          <!-- end tab quantity discounts -->
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
    <div class="copyright">
      <span class="text-15px">2015 &copy; <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
      <div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
    </div>
  </div>
  <!--END FOOTER--></div>
</div>
<!--END PAGE WRAPPER-->

@push('scripts')
<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ asset('/public/admin/js/form-components.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('/public/admin/js/price-calendar.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/public/admin/js/ui-tabs-accordions-navs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush

@endsection
