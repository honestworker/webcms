$('#modal-add-new').one('shown.bs.modal', function () {
   console.log('access');
    $('.se-pre-con').removeAttr('style');
    $('#calendar').fullCalendar({
        // events: {
        //   dataType: 'json',
        //   url: '/web88cms/products/editProduct/' + $('#productId').data("product-id"),
        // },
        // loading: function(isLoading, view) {
        //   if(!isLoading) {
        //     $('#calendar').fullCalendar('render');
        //   }
        // },
        header: {
            left: 'prev, btnPrev',
            center: 'title',
            right: 'next',
        },
        dayClick: function(date, jsEvent, view) {
            var events = $('#calendar').fullCalendar('clientEvents', moment(date).format('YYYYMMDD'));

            var dateRange = $('.input-daterange').first();
            var start = $(dateRange).find('input:first-child');
            var end = $(dateRange).find('input:last-child');

            $('#radioBulkDateRange').prop('checked', false);

            if(events.length > 0) {
                var event = events[0];

                if(event.status) {
                    $('#roomStatusAvailable').parent().addClass('active');
                    $('#roomStatusUnavailable').parent().removeClass('active');
                    $('#salePrice').val(event.salePrice);
                    $('#listPrice').val(event.listPrice);
                    $('#quantity_in_stock').val(event.qtyStock);
                    $('#low_level_in_stock').val(event.lowLevel);
                    $('#roomRestrictionText').val('');
                } else {
                    $('#roomStatusAvailable').parent().removeClass('active');
                    $('#roomStatusUnavailable').parent().addClass('active');
                    $('#salePrice').val(0.00);
                    $('#listPrice').val(0.00);
                    $('#quantity_in_stock').val(0);
                    $('#low_level_in_stock').val(0);
                    $('#roomRestrictionText').val(event.restrictionText);
                }

                $('#radioBulkDateRange').prop('checked', true);

                var d = moment(date).format('DD-MM-YYYY');
                $(start).val(d);
                $(end).val(d);
            } else {
                $('#salePrice').val(0.00);
                $('#listPrice').val(0.00);
                $('#quantity_in_stock').val(0);
                $('#low_level_in_stock').val(0);
                $('#roomRestrictionText').val('');

                $(start).val('');
                $(end).val('');
            }

            $('#modal-add-schedule').modal('toggle');
        },
        eventBackgroundColor: '#FFF',
        eventRender: function(event, element, view) {
            element.css({
                'font': '15px/1.5 "Poppins", sans-serif',
                'margin-top': '18px',
                'text-align': 'center'
            });
        },
        viewRender: function(view, element) {
            element.find('thead').css({
                'height': '54px'
            }).find('tr').css({
                'background-color': '#5C81B8'
            }).find('th').css({
                'color': '#F1F1F1',
                'font-size': '22px',
                'font-weight': '300',
                'text-transform': 'uppercase',
                'vertical-align': 'middle'
            });
        },
        dayRender: function(date, cell) {
            cell.find('.fc-day-number').prop('title', 'Add Price / Qty / Restriction');

            var events = $('#calendar').fullCalendar('clientEvents', moment(date).format('YYYYMMDD'));

            for(var i=0; i < events.length; i++) {
                var event = events[i];

                var color = '';
                var hoverColor = '';

                if(event.status) {
                    color = '#5cb85c';
                    hoverColor = '#a94442';
                } else {
                    color = '#a94442';
                    hoverColor = '#5cb85c';
                }

                cell.find('.fc-day-number').css({
                    'border-color': color,
                    'color': color,
                }).hover(function() {
                    $(this).css("color", hoverColor);
                }, function() {
                    $(this).css("color", color);
                });
            }
        }
    });
    setTimeout(function() {
        $.ajax({
            dataType: 'json',
            url: '/web88cms/products/editProduct/' + $('#productId').data("product-id"),
            success: function (data) {
                $('.se-pre-con').css('display','none');
                for(var i=0; i<data.length; i++) {
                    $('#calendar').fullCalendar('renderEvent', data[i], true);
                }
            }
        })
    }, 1000);
});

var prices = [];

function savePrices() {
    var data = [];

    $('#calendar').fullCalendar('clientEvents', function(event) {
        data.push({
            status: event.status,
            sale_price: event.salePrice,
            list_price: event.listPrice,
            qty_stock: event.qtyStock,
            low_level: event.lowLevel,
            restriction_text: event.restrictionText,
            date: moment(event.start).format('YYYY-MM-DD')
        });
    });

    if(data.length > 0) {
        roomPrices = JSON.stringify(data);
        $('#roomPrices').val(roomPrices);

        toastr.success('Please submit the form to save prices permanently.', 'Success!', {closeButton: true});
    }

    $('#modal-add-new').modal('toggle');
}

function getDates(day, year, month = false) {
    var result = [];

    if(month) {
        var month = parseInt(month);
        var date = moment([year,  month-1]);

        var firstDay = moment(date).startOf('month');
        var lastDay = moment(date).endOf('month');
    } else {
        var date = moment([year]);

        var firstDay = moment(date).startOf('year');
        var lastDay = moment(date).endOf('year');
    }

    while(firstDay.isBefore(lastDay)) {
        if(day == firstDay.format('ddd').toUpperCase()) {
            result.push(firstDay.format('YYYY-MM-DD'));
        }
        firstDay = firstDay.add(1, 'days');
    }

    return result;
}

function addMorePrices() {
    var status = $('#roomStatusAvailable').parent().hasClass('active');

    var salePrice = $('#salePrice').val();
    var listPrice = $('#listPrice').val();
    var qtyStock = $('#quantity_in_stock').val();
    var lowLevel = $('#low_level_in_stock').val();

    var restrictionText = $('#roomRestrictionText').val();

    var byDateRange = $('#radioBulkDateRange').is(':checked');
    var byDayOfMonth = $('#radioByDayOfMonth').is(':checked');
    var byDaysOfYear = $('#radioByDaysOfYear').is(':checked');

    var cDates = [];

    if(byDateRange) {
        $('.input-daterange').each(function() {
            var start = $(this).children('input:first-child').val();
            var end = $(this).children('input:last-child').val();

            var startDate = moment(start, "DD-MM-YYYY");
            var endDate = moment(end, "DD-MM-YYYY");

            if(startDate.isValid()) {
                if(endDate.isValid()) {
                    while(startDate.isSame(endDate) || startDate.isBefore(endDate)) {
                        cDates.push(startDate.format('YYYY-MM-DD'));
                        startDate = startDate.add(1, 'days');
                    }
                } else {
                    cDates.push(startDate.format('YYYY-MM-DD'));
                }
            }
        });

    } else if(byDayOfMonth) {
        var cYear = moment().format('YYYY');
        var isForAllMonths = false;
        var days = [];
        var months = [];

        $('#day option:selected').each(function() {
            days.push($(this).val());
        });

        $('#month option:selected').each(function() {
            if($(this).val() == 'ALL') {
                isForAllMonths = true;
            } else {
                months.push($(this).val());
            }
        });

        for(var i = 0; i < days.length; i++) {
            if(isForAllMonths) {
                var result = getDates(days[i], cYear);
                $.merge(cDates, result);
            } else {
                for(var j = 0; j < months.length; j++) {
                    var result = getDates(days[i], cYear, months[j]);
                    $.merge(cDates, result);
                }
            }
        }
    } else if(byDaysOfYear) {
        var days = [];
        var years = [];

        $('#days option:selected').each(function() {
            days.push($(this).val());
        });

        $('#year option:selected').each(function() {
            years.push($(this).val());
        });

        for(var i = 0; i < days.length; i++) {
            for(var j = 0; j < years.length; j++) {
                var result = getDates(days[i], years[j]);
                $.merge(cDates, result);
            }
        }
    }

    if(salePrice && cDates.length > 0) {
        var price = {
            status: status,
            salePrice: salePrice,
            listPrice: listPrice,
            restrictionText: restrictionText,
            qtyStock: qtyStock,
            lowLevel: lowLevel,
            dates: cDates
        };

        prices.push(price);

        $('#modal-add-schedule').each(function() {
            $(this).find('select, input[type=text], textarea').each(function() {
                $(this).val('');
            });
        });

        $('input[name="radioBulkOptions"]').attr('checked', false);

        if(status) {
            toastr.success('Price is added successfully.', 'Success!', {closeButton: true});
        } else {
            toastr.success('Room will be unavailble for specified period.', 'Success!', {closeButton: true});
        }
    } else {
        toastr.error('Please fill all the required fields.', 'Error!', {closeButton: true});
    }
}

function renderPricesToCalendar() {
    // alert('aaa');
    var count = 0;

    for(var i=0; i < prices.length; i++) {
        for(var j=0; j < prices[i].dates.length; j++) {
            color = prices[i].status ? '#3c763d' : '#a94442';

            var event = {
                id: moment(prices[i].dates[j]).format("YYYYMMDD"),
                title: 'RM: '+ parseFloat(prices[i].salePrice).toFixed(2) + "\r\n" +
                  'Qty: '+ parseFloat(prices[i].qtyStock).toFixed(2),
                status: prices[i].status,
                salePrice: prices[i].salePrice,
                listPrice: prices[i].listPrice,
                qtyStock: prices[i].qtyStock,
                lowLevel: prices[i].lowLevel,
                restrictionText: prices[i].restrictionText,
                allDay: true,
                start: prices[i].dates[j],
                textColor: color,
                borderColor: 'transparent',
                backgroundColor: 'transparent',
            };

            $("#calendar").fullCalendar('removeEvents', event.id);
            $('#calendar').fullCalendar('renderEvent', event, true);
        }

        count += 1;
    }

    if(count == prices.length && count > 0) {
        toastr.success('Prices are successfully saved to the calendar.', 'Success!', {closeButton: true});
    } else {
        toastr.warning('Please first add price to save to the calendar.', 'Warning!', {closeButton: true});
    }

    $('#calendar').fullCalendar('render');
    $('#modal-add-schedule').modal('toggle');
}

function addMoreDate(e) {
    var dateRange = '<div class="xss-margin"></div>' +
        '<div class="input-group input-daterange">' +
        '<input id="start" type="text" class="form-control" placeholder="eg. 01 March, 2017"/>' +
        '<span class="input-group-addon">to</span>' +
        '<input id="end" type="text" class="form-control" placeholder="eg. 01 April, 2017"/>' +
        '</div>'
    ;
    $('#btnAddMoreDate').before($(dateRange));
    $('.input-daterange').datepicker({
        format: "dd-mm-yyyy"
    });
}
