<style>
    .pignose-calendar-body .pignose-calendar-wrapper .pignose-calendar {
        padding: 15px 0 0 0;
    }

    .pignose-calendar-body .pignose-calendar.pignose-calendar-light:after {
        content: "Please choose your check-in date";
        display: block;
        position: absolute;
        top: 12px;
        margin: auto;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 18px;
    }

    .pignose-calendar-body .pignose-calendar-wrapper + .pignose-calendar-wrapper .pignose-calendar.pignose-calendar-light:after {
        content: "Please choose your check-out date";
        display: block;
        position: absolute;
        top: 12px;
        margin: auto;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 18px;
    }

    .available-booking {
        width: auto !important;
    }

    @keyframes cssAnimation {
        to {
            width: 0;
            height: 0;
            overflow: hidden;
            opacity: 0;
        }
    }

    @-webkit-keyframes cssAnimation {
        to {
            width: 0;
            height: 0;
            visibility: hidden;
        }

    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('body').addClass('pignose-calendar-body');
    });
</script>


<section class="online-book-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title-area section-title-one text-center">
                    <div class="title-box">
                        <div class="title-box-inner tb">
                            <div class="tb-cell">
                                <h3 class="section-name">Search<span>Room</span></h3><i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div><!--/.site-header-->
                    <h2 class="section-title"><span>For rates &amp;</span><span>Availability</span></h2>
                    <!--/.section-title-->
                    <p class="section-title-dec">Simply fill in the required fields and then click on check availability
                        button then you'll redirect to available rooms and suites to book online.</p>
                </div><!--/.section-title-area-->
            </div><!--/.col-md-12-->
        </div><!--/.row-->
        <div class="row">
            <div class="col-sm-4" style="position: fixed;
    bottom: 0;
    z-index: 2;
    width: 370px;
    left: 0;">
                <?php $animate = 1; ?>
                @foreach($booking as $index=>$book)
                    @if(isset($book->status) && $book->status)

                        <div class="alert alert-warning alert-dismissible hidden col-sm-4 available-booking" style="
                                -moz-animation: cssAnimation {{($animate-1)*2}}s ease-in {{$animate*2}}s forwards;
                                -webkit-animation: cssAnimation {{($animate-1)*2}}s ease-in {{$animate*2}}s forwards;
                                -o-animation: cssAnimation {{($animate-1)*2}}s ease-in {{$animate*2}}s forwards;
                                animation: cssAnimation {{($animate-1)*2}}s ease-in {{$animate*2}}s forwards;
                                -webkit-animation-fill-mode: forwards;
                                animation-fill-mode: forwards;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><span class="fa fa-calendar-check-o"></span></strong> {{$book->description}}
                        </div>
                        <?php $animate += 1; ?>
                    @endif
                @endforeach
            </div>
            <div class="col-md-12">
                <form action="{{ url('check-availability')}}" method="get" class="online-book-form">
                    <div class="row">
                        <div class="col-md-3 padding-left">
                            <label class="text-uppercase">Check-in Date</label>
                            <div class="input box-radius"><i class="fa fa-calendar"></i>
                                <input type="text" name="arrival" id="date-arrival" placeholder="Check-in Date"
                                       class=" form-controller">
                            </div><!--/.input-->
                        </div><!--/.col-md-3-->
                        <div class="col-md-3 padding-left">
                            <label class="text-uppercase">Check-out Date</label>
                            <div class="input box-radius"><i class="fa fa-calendar"></i>
                                <input type="text" name="departure" id="date-departure" placeholder="Check-out Date"
                                       class=" form-controller">
                            </div><!--/.input-->
                        </div><!--/.col-md-3-->
                        <div class="col-md-2 padding-left">
                            <label class="text-uppercase">room</label>
                            <div class="input box-radius"><i class="fa fa-caret-down"></i>
                                <select name="room">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div><!--/.input-->
                        </div><!--/.col-md-2-->
                        <div class="col-md-2 padding-left">
                            <label class="text-uppercase">Adult</label>
                            <div class="input box-radius"><i class="fa fa-caret-down"></i>
                                <select name="adult">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div><!--/.input-->
                        </div><!--/.col-md-2-->
                        <div class="col-md-2 padding-left">
                            <label class="text-uppercase">children</label>
                            <div class="input box-radius"><i class="fa fa-caret-down"></i>
                                <select name="childrens">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div><!--/.input-->
                        </div><!--/.col-md-2-->
                    </div><!--/.row-->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-default btn-check">Check Availability</a><!--/.btn-->
                        </div><!--/.col-md-12-->
                    </div><!--/.row-->
                </form><!--/.online-book-form-->
            </div><!--/.col-md-12-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/.online-book-section-->

<div class="modal fade" id="modal-validation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onClick="$('.form-horizontal').trigger('reset');" class="close"
                        data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Validation</h4>
            </div><!-- End .modal-header -->
            <div class="modal-body clearfix">
                <p>Please insert the Check-in Date and Check-out Date.</p>
                <div class="xs-margin"></div>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                            onClick="$('.form-horizontal').trigger('reset');">CLOSE
                    </button>
                </div>
            </div>


        </div><!-- End .modal-body -->
    </div><!-- End .modal-content -->
</div><!-- End .modal-dialog -->
</div><!-- End .modal forgot password -->
<script type="text/javascript">
    window.onload = function () {
        jQuery('#date-arrival').pignoseCalendar({
            buttons: true,
            minDate: new Date(),
            select: function (date, context) {
            },
            apply: function (date, context) {
                console.log(date);
                var dd = moment(date);
                dd.set('date', dd.get('date') + 1);
                console.log("date ==", dd.format('YYYY-MM-DD'));
                if (jQuery('#date-departure').val() != '' && new Date(jQuery('#date-arrival').val()) >= new Date(jQuery('#date-departure').val())) {
                    jQuery('#date-departure').val(dd.format('YYYY-MM-DD'));
                }
                jQuery('#date-departure').pignoseCalendar('set', dd.format('YYYY-MM-DD'));
                jQuery('#date-departure').trigger("click");
            }
        });
        jQuery('#date-departure').pignoseCalendar({
            buttons: true,
            minDate: new Date(),
            select: function (dates, context) {
            },
            apply: function (date, context) {
                if (new Date(jQuery('#date-arrival').val()) >= new Date(date)) {
                    jQuery('#date-departure').val('');
                    alert('Please select departure date bigger than arrival date.');
                }
            }
        });

        function check() {
            return false;
        }

        jQuery('.btn-check').click(function () {
            if (jQuery('#date-arrival').val() == '' || jQuery('#date-departure').val() == '') {
                jQuery('#modal-validation').modal('show')
            } else {
                // return true;
                jQuery('.online-book-form').submit();
            }
        })
    }
</script>