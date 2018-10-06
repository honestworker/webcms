$(function () {

    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')

    /***********************************/
    /********* TAB SHOPPING ************/

    //BEGIN JQUERY FLOT CHART
    var d1 = [
        ["Jan", 200],
        ["Feb", 120],
        ["Mar", 199],
        ["Apr", 157],
        ["May", 163],
        ["Jun", 192],
        ["Jul", 130],
        ["Aug", 126],
        ["Sep", 206],
		["Oct", 506],
		["Nov", 606],
		["Dec", 706]
    ];
    $.plot("#sp-chart-orders", [
        {
            data: d1,
            color: "#5cb85c"
        }
    ], {
        series: {
            lines: {
                show: !0,
                fill: true,
                fillColor: {
                    colors: [
                        {
                            opacity: 0.0
                        },
                        {
                            opacity: 0.6
                        }
                    ]
                }
            },
            points: {
                show: !0,
                radius: 4
            }
        },
        grid: {
            borderColor: "#fafafa",
            borderWidth: 1,
            hoverable: !0
        },
        tooltip: !0,
        tooltipOpts: {
            content: "%x : %y",
            defaultTheme: false
        },
        xaxis: {
            tickColor: "#fafafa",
            mode: "categories"
        },
        yaxis: {
            tickColor: "#fafafa"
        },
        shadowSize: 0
    });
    //END JQUERY FLOT CHART

    //BEGIN JQUERY KNOB
    $(".dial").knob({
        'draw': function () {
            $(this.i).val(this.cv + '%')
        },
        'fgColor': '#B8BEC8'
    });
    $({value: 0}).animate({value: $('.ls-chart input').attr("rel")}, {
        duration: 5000,
        easing: 'swing',
        step: function () {
            $('.ls-chart input').val(Math.ceil(this.value)).trigger('change');
        }
    })
    $({value: 0}).animate({value: $('.ao-chart input').attr("rel")}, {
        duration: 5000,
        easing: 'swing',
        step: function () {
            $('.ao-chart input').val(Math.ceil(this.value)).trigger('change');
        }
    })
    //END JQUERY KNOB

    //BEGIN JQUERY ANIMATE NUMBER
    $('#revenue-number').animateNumber({
        number: 3579.95,
        numberStep: comma_separator_number_step
    }, 5000);
    $('#tax-number').animateNumber({
        number: 295.35,
        numberStep: comma_separator_number_step
    }, 5000);
    $('#shipping-number').animateNumber({
        number: 30.00,
        numberStep: comma_separator_number_step
    }, 5000);
    $('#quantity-number').animateNumber({
        number: 14,
        numberStep: comma_separator_number_step
    }, 5000);
    $('#ls-number').animateNumber({
        number: 252983,
        numberStep: comma_separator_number_step
    }, 5000);
    $('#ao-number').animateNumber({
        number: 6320,
        numberStep: comma_separator_number_step
    }, 5000);
    //END JQUERY ANIMATE NUMBER

    /********* TAB SHOPPING ***********/
    /*********************************/
	
	
	
	
	//BEGIN AREA CHART SPLINE
    var d6_1 = [
        ["Jan", 367],
        ["Feb", 791],
        ["Mar", 436],
        ["Apr", 550],
        ["May", 328],
        ["Jun", 523],
        ["Jul", 449],
		["Aug", 718],
		["Sep", 228],
		["Oct", 538],
		["Nov", 380],
		["Dec", 222]
    ];
    var d6_2 = [
        ["Jan", 159],
        ["Feb", 449],
        ["Mar", 345],
        ["Apr", 194],
        ["May", 556],
        ["Jun", 222],
        ["Jul", 321],
		["Aug", 320],
		["Sep", 543],
		["Oct", 374],
		["Nov", 489],
		["Dec", 531]
    ];
    $.plot("#area-chart-spline", [
        {
            data: d6_1,
            label: "New Visitor",
            color: "#a01518"
        },
        {
            data: d6_2,
            label: "Returning Visitor",
            color: "#01b6ad"
        }
    ], {
        series: {
            lines: {
                show: !1
            },
            splines: {
                show: !0,
                tension: .4,
                lineWidth: 2,
                fill: .8
            },
            points: {
                show: !0,
                radius: 4
            }
        },
        grid: {
            borderColor: "#fafafa",
            borderWidth: 1,
            hoverable: !0
        },
        tooltip: !0,
        tooltipOpts: {
            content: "%x : %y",
            defaultTheme: false
        },
        xaxis: {
            tickColor: "#fafafa",
            mode: "categories"
        },
        yaxis: {
            tickColor: "#fafafa"
        },
        shadowSize: 0
    });
    //END AREA CHART SPLINE

});

