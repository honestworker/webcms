<div class="portlet">
  <div class="portlet-header">
    <div class="caption">By Total Order Amount Listing</div>
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
                <input type="hidden" name="type" value="{{config('ship.amount')}}">
                <div class="form-group">
                  <label class="col-md-4 control-label">Status</label>
                  <div class="col-md-6">
                    <div data-on="success" data-off="primary" class="make-switch">
                      <input type="checkbox" name="status" value="1" checked="checked"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Title <span class='require'>*</span></label>
                  <div class="col-md-6">
                    <input type="text" name="title" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label">From Total Order Amount (RM)</label>
                  <div class="col-md-6">
                    <input type="text" name="from_amount" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">To Total Order Amount (RM)</label>
                  <div class="col-md-6">
                      <input type="text" name="to_amount" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Courier Charge (RM)</label>
                  <div class="col-md-6">
                      <input type="text" name="courier_charge" class="form-control">
                      <div class="xss-margin"></div>
                      <div class="text-red text-12px">If you set courier charges to <strong>"RM 0.00"</strong>, it indicates that is <strong>"FREE Shipping"</strong>.</div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="col-md-offset-5 col-md-8"> <a href="#" rel="form-add-shipping" class="save-shipping btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
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
              <div class="col-md-offset-4 col-md-8"> <a href="{{ route('ship.delete') }}" onclick="return deleteItem($(this), 'selected');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
              <div class="col-md-offset-4 col-md-8"> <a href="{{ route('ship.delete') }}" onclick="return deleteItem($(this), 'all');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
            <th width="1%"></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="2"><div align="center">Total Order Amount</div></th>
            <th>Courier Charge</th>
            <th></th>
          </tr>
          <tr>
            <th width="1%"><input type="checkbox"/></th>
            <th>#</th>
            <th>Status</th>
            <th>Title</th>
            <th>From (RM)</th>
            <th>To (RM)</th>
            <th>(RM)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @if (!$ships->isEmpty())
          @foreach($ships as $ship)
          <tr>
            <td><input type="checkbox" name="ships[]" class="chk-item" value="{{$ship->id}}" /></td>
            <td>{{$ship->id}}</td>
            <td>
              @if ($ship->status == 1)
                <span class="label label-sm label-success">Active</span>
              @else
                <span class="label label-sm label-red" id="brand-status-26">In-active</span>
              @endif
            </td>
            <td>{{$ship->title}}</td>
            <td>{{number_format($ship->from_amount, 2)}}</td>
            <td>{{number_format($ship->to_amount, 2)}}</td>
            <td>{{number_format($ship->courier_charge, 2)}}</td>
            <td><a href="#" rel="#modal-edit-shipping-{{$ship->id}}" onclick="return selectedDropdown($(this));" data-hover="tooltip" data-placement="top" title="View/Edit" data-target="#modal-edit-shipping-{{$ship->id}}" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{$ship->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

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
                            <input type="hidden" name="type" value="{{config('ship.amount')}}">
                            <input type="hidden" name="id" value="{{$ship->id}}">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Status</label>
                              <div class="col-md-6">
                                <div data-on="success" data-off="primary" class="make-switch">
                                  <input type="checkbox" name="status" value="1" <?php if ($ship->status == '1') echo 'checked="checked"'; ?>/>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Title <span class='require'>*</span></label>
                              <div class="col-md-6">
                                <input type="text" name="title" value="{{$ship->title}}" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">From Total Order Amount (RM)</label>
                              <div class="col-md-6">
                                <input type="text" name="from_amount" value="{{$ship->from_amount}}" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">To Total Order Amount (RM)</label>
                              <div class="col-md-6">
                                  <input type="text" name="to_amount" value="{{$ship->to_amount}}" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Courier Charge (RM)</label>
                              <div class="col-md-6">
                                  <input type="text" name="courier_charge" value="{{$ship->courier_charge}}" class="form-control">
                                  <div class="xss-margin"></div>
                                  <div class="text-red text-12px">If you set courier charges to <strong>"RM 0.00"</strong>, it indicates that is <strong>"FREE Shipping"</strong>.</div>
                              </div>
                            </div>
                            <div class="form-actions">
                              <div class="col-md-offset-5 col-md-8"> <a href="#" rel="form-edit-shipping-{{$ship->id}}" class="save-shipping btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
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
                          <div class="col-md-offset-4 col-md-8"> <a href="{{ route('ship.delete') }}" rel="{{$ship->id}}" onclick="return deleteItem($(this), 'id');" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
            <td colspan="8"></td>
          </tr>
        </tfoot>
      </table>
      <div class="clearfix"></div>
    </div>
    <!-- end table responsive -->
  </div>
</div>

<script src="{{ asset('/public/admin/js/action.js') }}"></script>
<script type="text/javascript">

var clickable = true;

$(document).ready(function (){

  $('.save-shipping').click(function (){
    saveShipping($(this), $(this).attr('rel'));
    return false;
  });

}); //end document ready

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