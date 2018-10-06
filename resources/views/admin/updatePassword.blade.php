@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal" action="<?php echo url('/admin/updatePassword/'. Auth::user()->id); ?>" method="post" >
                                        
<div class="form-group">
    <label for="password" class="control-label col-md-4">New Password</label>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-8">
            <div class="input-icon"><i class="fa fa-key"></i> <input id="password" type="password" name="password" placeholder="New Password" class="form-control"/><span class="text-10px">(Password length should be between 6-12 characters)</span>                                                </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="password" class="control-label col-md-4">Confirm New Password</label>

        <div class="col-md-8">
            <div class="input-icon"><i class="fa fa-key"></i> <input id="password" type="password" name="password_confirmation" placeholder="Confirm New Password" class="form-control"/><span class="text-10px">(Password length should be between 6-12 characters)</span>                                                </div>
        </div>
    </div>
        <div class="col-md-offset-4 col-md-8">
        <input type="submit" value="Save" />
    </div>
</form>