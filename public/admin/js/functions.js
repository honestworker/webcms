base_url = '/';

/* update admin password */
function updatePassword(user_id)
{
	$.ajax({
			url: base_url+'web88cms/updatePassword/'+user_id,
			type:'post',
			dataType:'json',
			data: $('#updatePassword input'),
			success: function(response) {
				if(response['error'])
				{
					$('#errorPassword').remove();
					$('#successPassword').remove();
					var error = '<div id="errorPassword" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					for(var i=0; i < response['error'].length; i++)
					{
						error += '<p>'+ response['error'][i] +'</p>';
					}
					error += '</div>';
					$('#updatePassword').before(error);
				}

				if(response['success'])
				{
					$('#errorPassword').remove();
					$('#successPassword').remove();
					var success = '<div id="successPassword" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
					$('#updatePassword').before(success);
				}
			}
		});
}
/* update admin avtar image*/
function updateAvtar(user_id)
{
	var form_data = new window.FormData($('#updateAvtar')[0]);

	$.ajax({
			url: base_url+'web88cms/updateAvtar/'+user_id,
			type:'post',
			dataType:'json',
			data: form_data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			success: function(response) {
				if(response['error'])
				{
					$('#errorUpdateAvtar').remove();
					$('#successUpdateAvtar').remove();
					var error = '<div id="errorUpdateAvtar" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					for(var i=0; i < response['error'].length; i++)
					{
						error += '<p>'+ response['error'][i] +'</p>';
					}
					error += '</div>';
					$('#updateAvtar').before(error);
				}

				if(response['success'])
				{
					$('#errorUpdateAvtar').remove();
					$('#successUpdateAvtar').remove();
					var success = '<div id="successUpdateAvtar" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
					$('#updateAvtar').before(success);

					$('.uploadedAvtar').attr('src',base_url+'public/admin/avtar/'+response['success']);
					$('.uploadedAvtar').live('load');
				}
			}
		});
}

// save brand details
function addBrand()
{
	//alert(base_url+'admin/brands/update');
	var form_data = new window.FormData($('#addBrand')[0]);
	//alert($('#brand_id').val());

	$.ajax({
			url: base_url+'web88cms/brands/addBrand',
			type:'post',
			dataType:'json',
			data: form_data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			success: function(response) {
				if(response['error'])
				{
					$('#errorAddBrand').remove();
					//$('#successAddBrand').remove();
					var error = '<div id="errorAddBrand" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					for(var i=0; i < response['error'].length; i++)
					{
						error += '<p>'+ response['error'][i] +'</p>';
					}
					error += '</div>';
					$('#addBrand').before(error);
				}

				if(response['success'])
				{
					$('#errorAddBrand').remove();
					//$('#successAddBrand').remove();
					//var success = '<div id="successAddBrand" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
					//$('#addBrand').before(success);

					window.location.href = base_url+"web88cms/brands/list";

				}
			}
		});
}

// save brand details
function saveBrand()
{
	//alert(base_url+'admin/brands/update');
	var form_data = new window.FormData($('#editBrand')[0]);
	//alert($('#brand_id').val());

	$.ajax({
			url: base_url+'web88cms/brands/updateBrand',
			type:'post',
			dataType:'json',
			data: form_data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			success: function(response) {
				if(response['error'])
				{
					$('#errorEditBrand').remove();
					$('#successEditBrand').remove();
					var error = '<div id="errorEditBrand" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
					for(var i=0; i < response['error'].length; i++)
					{
						error += '<p>'+ response['error'][i] +'</p>';
					}
					error += '</div>';
					$('#editBrand').before(error);
				}

				if(response['success'])
				{
					$('#errorEditBrand').remove();
					$('#successEditBrand').remove();
					var success = '<div id="successEditBrand" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
					$('#editBrand').before(success);

					// update table column
					brand_id = $('#brand_id').val();

					$('#updated_title_'+brand_id).text($('#brand_title').val());

					if($('#brand_status').is(':checked'))
					{
						$('#brand-status-'+brand_id).addClass('label-success');
						$('#brand-status-'+brand_id).removeClass('label-red');
						$('#brand-status-'+brand_id).text('Active');
						new_status = 1;
					}
					else
					{
						$('#brand-status-'+brand_id).removeClass('label-success');
						$('#brand-status-'+brand_id).addClass('label-red');
						$('#brand-status-'+brand_id).text('In-active');

						new_status = 0;
					}

					$('#edit_link_'+brand_id).attr('onClick','set_brand_details('+brand_id+',"'+$("#updated_title_"+brand_id).text()+'",'+new_status+')');

				}
			}
		});
}


// set brand id(in hidden text box) to delete
function delete_item(item_id)
{
	//alert(brand_id);
	$('#delete_item_ids').val(item_id);
}

function cancel_delete()
{
	$('#delete_item_ids').val(0);
}



function delete_selected(item_type)
{
	$('#delete_item_ids').val('');

	if($('.select_items:checked').length == 0)
	{
			$('#modal-selected-least-one').modal('show');
		return false;
	}

	$('input.select_items').each(function(){

			if($(this).is(':checked'))
			{
				id = $(this).attr('data-id');

				if($('#delete_item_ids').val() == '')
					$('#delete_item_ids').val(id);
				else
				{
					$('#delete_item_ids').val($('#delete_item_ids').val()+','+id);
				}

			}
	});

	// ajax call to delete items
	if(item_type == 'brands')
		continue_delete_process_brands();

	if(item_type == 'colors')
		continue_delete_process_colors();

	if(item_type == 'products')
		continue_delete_process_products();

	if(item_type == 'global_discounts')
		continue_delete_process_global_discounts();

	if(item_type == 'quantity_discounts')
		continue_delete_process_quantity_discount();

	if(item_type == 'banners')
		continue_delete_process_banners();


}

function delete_all(item_type)
{
	$('#delete_item_ids').val('');

	$('input.select_items').each(function(){

		id = $(this).attr('data-id');

		if($('#delete_item_ids').val() == '')
			$('#delete_item_ids').val(id);
		else
		{
			$('#delete_item_ids').val($('#delete_item_ids').val()+','+id);
		}
	});

	// ajax call to delete items
	if(item_type == 'brands')
		continue_delete_process_brands();

	if(item_type == 'colors')
		continue_delete_process_colors();

	if(item_type == 'products')
		continue_delete_process_products();

	if(item_type == 'global_discounts')
		continue_delete_process_global_discounts();

	if(item_type == 'quantity_discounts')
		continue_delete_process_quantity_discount();


}

// ajax call to delete items
function continue_delete_process_brands()
{
	item_id = $('#delete_item_ids').val();

	// ajax call to delete messages
	$.ajax({
		   type : 'POST',
		   url : base_url+'web88cms/brands/deleteBrands',
		   data : 'item_id='+item_id+'&_token='+$('#csrf_token').val(),
		   success : function(response){
					window.location.href = base_url+"web88cms/brands/list";
		   }
	});	// end ajax
}

function continue_delete_process_colors()
{
	item_id = $('#delete_item_ids').val();

	// ajax call to delete messages
	$.ajax({
		   type : 'POST',
		   url : base_url+'web88cms/colors/deleteColors',
		   data : 'item_id='+item_id+'&_token='+$('#csrf_token').val(),
		   success : function(response){
					window.location.href = base_url+"web88cms/colors/list";
		   }
	});	// end ajax
}

function continue_delete_process_products()
{
	item_id = $('#delete_item_ids').val();

	query_string = $('#query_string').val();


	// ajax call to delete messages
	$.ajax({
		   type : 'POST',
		   url : base_url+'web88cms/products/deleteProducts',
		   data : 'item_id='+item_id+'&_token='+$('#csrf_token').val(),
		   success : function(response){
		   		if(query_string == '')
					window.location.href = base_url+"web88cms/products/list";
				else
					window.location.href = base_url+"web88cms/products/list?"+query_string;
		   }
	});	// end ajax
}

function continue_delete_process_global_discounts()
{
	item_id = $('#delete_item_ids').val();

	query_string = $('#query_string').val();

	// ajax call to delete messages
	$.ajax({
		   type : 'POST',
		   url : base_url+'web88cms/promotions/deleteGlobalDiscounts',
		   data : 'item_id='+item_id+'&_token='+$('#csrf_token').val(),
		   success : function(response){
		   		if(query_string == '')
					window.location.href = base_url+"web88cms/promotions/globalDiscounts";
				else
					window.location.href = base_url+"web88cms/promotions/globalDiscounts?"+query_string;
		   }
	});	// end ajax
}

function continue_delete_process_quantity_discount()
{
	item_id = $('#delete_item_ids').val();
	query_string = $('#query_string').val();

	product_id = $('#product_id').val();


	// ajax call to delete messages
	$.ajax({
		   type : 'POST',
		   url : base_url+'web88cms/products/deleteQuantityDiscount',
		   data : 'item_id='+item_id+'&_token='+$('#csrf_token').val(),
		   success : function(response){
		   		if(query_string == '')
					window.location.href = base_url+"web88cms/products/editProduct/"+product_id;
				else
					window.location.href = base_url+"web88cms/products/editProduct/"+product_id+"?"+query_string;
		   }
	});	// end ajax
}

function continue_delete_process_banners()
{
	item_id = $('#delete_item_ids').val();

	query_string = $('#query_string').val();
	base_url = window.location.origin+'';
	// ajax call to delete messages
	$.ajax({
		   type : 'POST',
		   url : base_url+'web88cms/index_banner_top_list/delete_selected_banners',
		   data : 'item_id='+item_id+'&_token='+$('#csrf_token').val(),
		   success : function(response){
		   		if(query_string == ''){
					window.location.href = base_url+"web88cms/index_banner_top_list";
		   		}
				else{

					window.location.href = base_url+"web88cms/index_banner_top_list?"+query_string;
				}
		   }
	});	// end ajax
}

function set_per_page(per_page,session_key,redirect_to,query_string)
{
	redirect_to = redirect_to.replace(/(\/)/g,'~');
	qs = (query_string != '') ? '/'+query_string : '/no_qs';
	window.location.href = base_url+'web88cms/products/setPerPage/'+per_page+'/'+session_key+'/'+redirect_to+qs;
}
