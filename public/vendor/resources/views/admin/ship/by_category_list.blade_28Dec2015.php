<div class="portlet">
  <div class="portlet-header">
    <div class="caption">By Product Category Listing</div>
    <br/>
    <p class="margin-top-10px"></p>
    <a href="#" class="btn btn-success" data-target="#modal-add-shipping" data-toggle="modal">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
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
    <!--Modal Add New shipping start-->
    <div id="modal-add-shipping" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
      <div class="modal-dialog modal-wide-width">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
            <h4 id="modal-login-label3" class="modal-title">Add New Shipping Method</h4>
          </div>
          <div class="modal-body">
            <div class="form">
              <form class="form-horizontal" id="form-add-shipping">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="type" value="{{config('ship.category')}}">
                <div class="form-group">
                  <label class="col-md-3 control-label">Status</label>
                  <div class="col-md-6">
                    <div data-on="success" data-off="primary" class="make-switch">
                      <input type="checkbox" name="status" value="1" checked="checked"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Title <span class='require'>*</span></label>
                  <div class="col-md-6">
                    <input type="text" name="title" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                	<label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                      <div class="col-md-6">
                          <div class="xs-margin"></div>
                          <select name="product_cat" class="form-control">
                              <option value="">- Select Category -</option>
                              {!!$categories!!}
                          </select>
                      </div>
                  </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Courier Charge (RM)</label>
                  <div class="col-md-6">
                      <input type="text" name="courier_charge" class="form-control">
                      <div class="xss-margin"></div>
                      <div class="text-red text-12px">If you set courier charges to <strong>"RM 0.00"</strong>, it indicates that is <strong>"FREE Shipping"</strong>.</div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="col-md-offset-5 col-md-8"> <a href="#" id="save-shipping" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--END MODAL Add New shipping method-->
    <!--Modal delete selected items start-->
    <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
          </div>
          <div class="modal-body">
            <div class="form-actions">
              <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="return deleteShipping($(this), 'selected');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
          </div>
          <div class="modal-body">
            <div class="form-actions">
              <div class="col-md-offset-4 col-md-8"> <a href="#" onclick="return deleteShipping($(this), 'all');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- modal delete all items end -->
  </div>
  <div class="portlet-body">
    <div class="table-responsive mtl">
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th width="1%"><input type="checkbox"/></th>
            <th>#</th>
            <th>Status</th>
            <th>Title</th>
            <th>Product Category</th>
            <th>Courier Charge (RM)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @if (!$ships->isEmpty())
          @foreach($ships as $ship)
          <tr>
            <td><input type="checkbox" name="ships[]" class="chk-ship" value="{{$ship->id}}" /></td>
            <td>{{$ship->id}}</td>
            <td>
              @if ($ship->status == 1)
                <span class="label label-sm label-success">Active</span>
              @else
                <span class="label label-sm label-red" id="brand-status-26">In-active</span>
              @endif
            </td>
            <td>{{$ship->title}}</td>
            <td>{{$ship->category->title}}</td>
            <td>{{number_format($ship->courier_charge, 2)}}</td>
            <td><a href="#" rel="#modal-edit-shipping-{{$ship->id}}" onclick="return selectedCategory($(this));" data-hover="tooltip" data-placement="top" title="View/Edit" data-target="#modal-edit-shipping-{{$ship->id}}" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{$ship->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

            <!--Modal edit shipping start-->
            <div id="modal-edit-shipping-{{$ship->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
              <div class="modal-dialog modal-wide-width">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-login-label3" class="modal-title">Edit Shipping Method</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form">
                      <form class="form-horizontal" id="form-edit-shipping-{{$ship->id}}">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="type" value="{{config('ship.category')}}">
                        <input type="hidden" name="id" value="{{$ship->id}}">
                        <div class="form-group">
                          <label class="col-md-3 control-label">Status</label>
                          <div class="col-md-6">
                            <div data-on="success" data-off="primary" class="make-switch">
                              <input type="checkbox" name="status" value="1" <?php if ($ship->status == '1') echo 'checked="checked"'; ?>/>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Title <span class='require'>*</span></label>
                          <div class="col-md-6">
                            <input type="text" name="title" value="{{$ship->title}}" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                              <div class="col-md-6">
                                  <div class="xs-margin"></div>
                                  <select name="product_cat" class="form-control">
                                      <option value="">- Select Category -</option>
                                      {!!$categories!!}
                                  </select>
                                  <input type="hidden" name="selected_cat_id" class="selected_cat_id" value="{{$ship->category->id}}" />
                              </div>
                          </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Courier Charge (RM)</label>
                          <div class="col-md-6">
                              <input type="text" name="courier_charge" value="{{$ship->courier_charge}}" class="form-control">
                              <div class="xss-margin"></div>
                              <div class="text-red text-12px">If you set courier charges to <strong>"RM 0.00"</strong>, it indicates that is <strong>"FREE Shipping"</strong>.</div>
                          </div>
                        </div>
                        <div class="form-actions">
                          <div class="col-md-offset-5 col-md-8"> <a href="#" rel="form-edit-shipping-{{$ship->id}}" class="edit-shipping btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--END MODAL Add New shipping method-->
            <!--Modal delete start-->
            <div id="modal-delete-{{$ship->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                  </div>
                  <div class="modal-body">
                    <p><strong>#{{$ship->id}}:</strong> {{$ship->title}}</p>
                    <div class="form-actions">
                      <div class="col-md-offset-4 col-md-8"> <a href="#" rel="{{$ship->id}}" onclick="return deleteShipping($(this), 'id');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- modal delete end -->

            </td>
          </tr>
          @endforeach
        @else
        <div class="alert alert-danger alert-dismissable">
        <p>No Shipping Found!</p>
        </div>
        @endif
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7"></td>
          </tr>
        </tfoot>
      </table>
      <div class="clearfix"></div>
    </div>
    <!-- end table responsive -->
  </div>
</div>
<script type="text/javascript">
var clickable = true;

$(document).ready(function (){

  $('#save-shipping').click(function() {
    saveShipping($(this), 'form-add-shipping');
    return false;
  });

  $('.edit-shipping').click(function () {
    saveShipping($(this), $(this).attr('rel'));
    return false;
  });


});//end document ready

function deleteShipping(obj, type){
  if (!clickable) {
    return false;
  }

  if(type == 'selected'){
    values = $('.chk-ship:checked, #_token');
  } else if (type == 'all'){
    values = $('.chk-ship, #_token');
  } else {
    var id = obj.attr('rel');
    var token = '{{csrf_token()}}';
    values = 'id=' + id + '&_token=' + token;
  }

  var total = values.length;
  if(total > 0){
    clickable = false;
    $.ajax({
      url: "{{ route('ship.delete') }}",
      type: 'POST',
      data: values,
      dataType: 'json',
      async: false,
      cache: false,
      beforeSend:function (){
        obj.html('Saving... <i class="fa fa-floppy-o"></i>');
      },
      complete: function(){
        obj.html('Save <i class="fa fa-floppy-o"></i>');
      },
      success: function (response) {
        clickable = true;
        if(response['success'])
        {
          window.location.reload();
        }
      }
    });
  }
  else{
    alert('Please select at least one shipping method before delete.');
  }

  return false;
}

function selectedCategory(obj) {
  var target = $(obj.attr('rel'));
  var selected_cat_id = target.find('.selected_cat_id').val();
  target.find('select[name="product_cat"]').val(selected_cat_id);

  return false;
}

function saveShipping(obj, form_id) {
  if (!clickable) {
    return false;
  }

  var url = '{{route('ship.setup')}}';

  // Create a formdata object and add the files
  var data = new FormData(document.getElementById(form_id));

  clickable = false;
  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    dataType: 'json',
    processData: false,
    contentType: false,
    beforeSend:function (){
      obj.html('Saving... <i class="fa fa-floppy-o"></i>');
    },
    complete: function(){
      obj.html('Save <i class="fa fa-floppy-o"></i>');
    },
    success: function (response) {
      clickable = true;
      var html = '';

      $('#warning-box').remove();
      $('#success-box').remove();

      if(response['error'])
      {
        html += '<div id="warning-box" class="alert alert-danger alert-dismissable">';
        html += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>';
        html += '<i class="fa fa-times-circle"></i> <strong>Error!</strong>';

        for(var i in response['error'])
        {
          html += '<p>'+ response['error'][i] +'</p>';
        }

        html += '</div>';
        $('#'+form_id).before(html);
      }

      if(response['success'])
      {
        window.location.reload();
      }
    }
  });
}

</script>