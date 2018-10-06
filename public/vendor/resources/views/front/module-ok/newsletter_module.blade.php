<div class="widget subscribe">
	<h3>Want Something?</h3>
	<p class="line"></p>
    <p>
        Sign up for the TBM newsletter today to get all the latest information on <span class="third-color">Promotions</span>, 
        <span class="third-color">Sales</span> and <span class="third-color">Offers</span>. 
    </p>
    <form id="subscribe-form">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="frmWhr" value="front" />
        <div class="form-group">
        	<input type="email" class="form-control" name="email" id="subscribe-email" placeholder="Enter your email address">
        </div>
        <input type="submit" value="SUBMIT" class="btn btn-custom" onclick="addSubscriber(); return false;">
    </form>
    <script>
		function addSubscriber(){
			var form_data = new window.FormData($('#subscribe-form')[0]);
															
			$.ajax({			
				url: 'newsletter/addSubscriber',
				type:'post',
				dataType:'json',
				data: form_data,
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				success: function(response) {			
				if(response['error']){
					$('#errorAddSubscriber').remove();
					$('#successAddSubscriber').remove();
					var error = '<div id="errorAddSubscriber" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					if(response['error']=='This Email Id is already in use.'){
						error += '<p>'+ response['error'] +'</p>';
					}else{
						for(var i=0; i < response['error'].length; i++)
						{
							error += '<p>'+ response['error'][i] +'</p>';
						}
					}
						error += '</div>';
						$('#subscribe-form').before(error);	
					}
																				
					if(response['success'])
					{
						$('#errorAddSubscriber').remove();
						$('#successAddSubscriber').remove();
						var success = '<div id="successAddSubscriber" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>You are subscribed.</p></div>';
						$('#subscribe-form').before(success);
																				
						$('.subscribe-form').live('load');
												
					}
				}
			});
		}
	</script>
</div>