<div class="portlet">
    <div class="portlet-header">
      <div class="caption">CSV Import Listing</div>
      <br/>
      <p class="margin-top-10px"></p>
      <a href="#" class="btn btn-success" data-target="#modal-add-shipping" data-toggle="modal">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
      <div class="btn-group">
        <button type="button" class="btn btn-primary">Delete</button>
        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
        <ul role="menu" class="dropdown-menu">
          <li><a href="#" onclick="deleteSelected()">Delete selected item(s)</a></li>
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
                <form class="form-horizontal" id="add-new-shipping" method="post" enctype="multipart/form-data" action="{{route('ship.setup')}}">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="type" value="{{config('ship.csv')}}">
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
                    <label class="col-md-3 control-label">Import CSV</label>
                    <div class="col-md-9">
                      <div class="text-15px margin-top-10px">
                        <div class="text-blue text-12px">You can import shipping details as CSV format.</div>
                        <div class="xss-margin"></div>
                        <input id="file-csv" type="file" name="csv" />
                         <span class="help-block">(CSV only) </span> </div>
                    </div>
                  </div>
                  <div class="form-actions">
                    <div class="col-md-offset-5 col-md-8"> <a href="#"  id="save-shipping" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
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
                <div class="col-md-offset-4 col-md-8"> <a href="{{ route('ship.delete') }}" onclick="return deleteItem($(this), 'selected')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                <div class="col-md-offset-4 col-md-8"> <a href="{{ route('ship.delete') }}" onclick="return deleteItem($(this), 'all')" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
				<select name="select_per_page" class="form-control">
					<option <?= ($limit == 1 ? 'selected="selected"' : ''); ?> value="1">1</option>
					<option <?= ($limit == 10 ? 'selected="selected"' : ''); ?> value="10">10</option>
                    <option <?= ($limit == 20 ? 'selected="selected"' : ''); ?> value="20">20</option>
                    <option <?= ($limit == 30 ? 'selected="selected"' : ''); ?> value="30">30</option>
                    <option <?= ($limit == 50 ? 'selected="selected"' : ''); ?> value="50">50</option>
                    <option <?= ($limit == 100 ? 'selected="selected"' : ''); ?> value="100">100</option>
                </select>
                &nbsp;
                <label class="control-label">Records per page</label>
            </div>
          </div>
          <div class="clearfix"></div>
      <div class="table-responsive mtl">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th width="1%"><input type="checkbox" /></th>
              <th>#</th>
              <th>Status</th>
              <th>Title</th>
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
              <td><a href="{{route('ship.edit.csv', $ship->id)}}" data-hover="tooltip" data-placement="top" title="View/Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{$ship->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
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
                            <div class="col-md-offset-4 col-md-8"> <a href="{{ route('ship.delete') }}" onclick="return deleteItem($(this), 'id')" rel="{{$ship->id}}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
              <td colspan="5"></td>
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
$(document).ready(function(){

  var files;
  $('#file-csv').on('change', function(event) {
    files = event.target.files;
  });

	$('#save-shipping').click(function() {
		saveCsv(files, $(this));
		return false;
	});

});//end document ready

function saveCsv(files, obj) {
  if (!clickable) {
    return false;
  }

	var url = '{{route('ship.setup')}}';

	// Create a formdata object and add the files
  var data = new FormData(document.getElementById('add-new-shipping'));
  if (files !== undefined) {
    $.each(files, function(key, value) {
        data.append(key, value);
    });
  }

  clickable = false;
	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		dataType: 'json',
    processData: false, // Don't process the files
    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
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
				$('form.form-horizontal').before(html);
			}

			if(response['success'])
			{
				window.location.reload();
			}
		}
	});
}
function deleteSelected(){
	values = $('.chk-item:checked');
	if (values.length==0){
		alert('Please select at least one CSV before delete.');	
		return false;
	}
	$('#modal-delete-selected').modal('show');
}
</script>