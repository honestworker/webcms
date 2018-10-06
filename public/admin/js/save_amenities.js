var gliss = gliss || {};

gliss.rooms = (function($){

    this.saveAmenities = function(elm, event, id){

        event = event || window.event;

        event.preventDefault();
        event.stopPropagation();

        var data = $(elm).serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/web88cms/products/editProduct/amenities/' + id,
            type: 'post',
            dataType: 'json',
            data: data
        })
            .done(function(response){
                    $('html, body').animate({scrollTop:0}, 'slow');
                    $('.alert-success.amenities').fadeIn(500);
                    setTimeout(function(){
                        $('.alert-success.amenities').fadeOut(500);
                    }, 5000);
            });
        
    }

    return this;

}).call(gliss.rooms || {}, jQuery);