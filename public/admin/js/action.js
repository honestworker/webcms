function deleteItem(obj, type){
  if (!clickable) {
    return false;
  }

  if(type == 'selected'){
    values = $('.chk-item:checked, #_token');
    if ($('.chk-item:checked').length == 0) {
      var html = '<p>Please select at least one item before delete.</p>';
      obj.parent().parent().prepend(html);
      return false;
    }
  } else if (type == 'all'){
    values = $('.chk-item, #_token');
  } else {
    var id = obj.attr('rel');
    var token = $('#_token').val();
    values = 'id=' + id + '&_token=' + token;
  }

  clickable = false;
  $.ajax({
    url: obj.attr('href'),
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

  return false;
}