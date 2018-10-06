<!DOCTYPE html>
<html lang="en">
<head>

    <title>Dashboard</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/icons/favicon.ico" rel="shortcut icon">
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic%7CPT+Gudea:400,700,400italic%7CPT+Oswald:400,700,300" rel="stylesheet" id="googlefont">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
    <link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">

    <!--LOADING SCRIPTS FOR PAGE-->
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-datepicker/css/datepicker.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.css">

    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="vendors/jquery-pace/pace.css">

    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!--<link type="text/css" rel="stylesheet" href="css/style.css">-->
    <link type="text/css" rel="stylesheet" href="css/style-mango.css" id="theme-style">
    <link type="text/css" rel="stylesheet" href="css/vendors.css">
    <link type="text/css" rel="stylesheet" href="css/themes/grey.css" id="color-style">
    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">


</head>
<body>
<div>
    <!--BEGIN TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
    <div id="wrapper"><!--BEGIN TOPBAR-->
        @include('backend.topbar')
        @include('backend.menu')
        <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->

            <div class="page-header-breadcrumb">
                <div class="page-heading hidden-xs">
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Dashboard</a>&nbsp;</li>

                </ol>
            </div>
            <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->

            <div class="page-content">
                <div id="tab-shopping">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- last 5 job applicants listing start -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">Last 5 Job Applicants</div>
                                <div class="panel-body">
                                    <table class="table table-border-dashed table-hover mbn">
                                        <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Position Applied</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($applicants) && !empty($applicants))
                                            @foreach($applicants as $key => $item)
                                                <tr>
                                                    <td>
                                                        <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-details{{ $key }}" data-toggle="modal" title="View Details">
                                                            {{ isset($item['name']) ? $item['name'] : ''}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-details{{ $key }}" data-toggle="modal" title="View Details">
                                                            {{ $item['position'] }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-details{{ $key }}" data-toggle="modal" title="View Details">
                                                            {{ date('d M, Y', $item['date']) }}
                                                        </a>
                                                        <!--Modal view details start-->

                                                        <div id="modal-view-details{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">

                                                            <div class="modal-dialog modal-wide-width">

                                                                <div class="modal-content">

                                                                    <div class="modal-header">                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>                                        <h4 id="modal-login-label2" class="modal-title">View Applicant Details</h4>
                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <form action="#" class="form-horizontal">

                                                                            <div class="form-body pal"><h3 class="block-heading">Personal</h3>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputFirstName" class="col-md-4 control-label">Name:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ isset($item['name']) ? $item['name'] : ''}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputEmail" class="col-md-4 control-label">Email:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ $item['email'] }}</a></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="selGender" class="col-md-4 control-label">Contact Number:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['phone'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputBirthday" class="col-md-4 control-label">Date of Birth:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['birth'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                            <h3 class="block-heading">Address</h3>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputAddress1" class="col-md-4 control-label">Address:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['address'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputAddress2" class="col-md-4 control-label">City:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['city'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputStates" class="col-md-4 control-label">State:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['state'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputCity" class="col-md-4 control-label">Post Code:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['postcode'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputPostCode" class="col-md-4 control-label">Country:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['country'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- education background start -->                                                            <h3 class="block-heading">Education Background</h3>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputPostCode" class="col-md-4 control-label">Education Level:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static">{{ $item['level'] }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end education background-->
                                                                                <!-- CV start -->                                                            <h3 class="block-heading">Attached CV</h3>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group">
                                                                                            <label for="inputPostCode" class="col-md-4 control-label">Applicant CV:
                                                                                            </label>

                                                                                            <div class="col-md-8">

                                                                                                <p class="form-control-static"><a href="/images/{{ $item['cv'] }}" target="_blank">use the uploaded cv file name</a></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end CV-->
                                                                            </div>

                                                                            <div class="form-actions">

                                                                                <div class="col-md-offset-5 col-md-8"><a href="#" data-dismiss="modal" class="btn btn-green">Close &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>

                                                                                    <a href="javascript:void(0)" onClick="myprint({{ $key }});" class="btn btn-green">Print</a>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END MODAL view details-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End last 5 job applicants listing -->

                            <!-- last 5 feedback listing start -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">Last 5 Feedback</div>
                                <div class="panel-body">
                                    <table class="table table-border-dashed table-hover mbn">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Feedback</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($feedback) && !empty($feedback))
                                            @foreach($feedback as $key => $item)
                                                <tr>
                                                    <td>
                                                        <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-fb-details{{ $key }}" data-toggle="modal" title="View Details">
                                                            {{ date('d M, Y', $item['time']) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-fb-details{{ $key }}" data-toggle="modal" title="View Details">
                                                            {{ isset($item['name']) ? $item['name'] : ''}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-view-fb-details{{ $key }}" data-toggle="modal" title="View Details">
                                                            {{ isset($item['message']) ? $item['message'] :'' }}</a>

                                                        <!--Modal view details start-->
                                                        <div id="modal-view-fb-details{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                            <div class="modal-dialog modal-wide-width">
                                                                <div class="modal-content" id="printingDiv">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                        <h4 id="modal-login-label3" class="modal-title">View Details</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="#" class="form-horizontal">
                                                                            <div class="form-body pal">
                                                                                <h3 class="block-heading">General</h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputFirstName" class="col-md-4 control-label">Name:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['name']) ? $item['name'] : ''}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputPhone" class="col-md-4 control-label">Telephone:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['phone'])?$item['phone']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <!-- end row -->

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputLastName" class="col-md-4 control-label">Company Name:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['company'])?$item['company']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputLastName" class="col-md-4 control-label">Occupation:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['occupation'])?$item['occupation']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>



                                                                                </div>
                                                                                <!-- end row -->

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputEmail" class="col-md-4 control-label">Email:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ isset($item['email'])?$item['email']:'' }}</a></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputPhone" class="col-md-4 control-label">Fax:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">@if(isset($item['fax'])) {{ $item['fax'] }} @endif</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <!-- end row -->


                                                                                <h3 class="block-heading">Address</h3>
                                                                                <div class="row">

                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputAddress1" class="col-md-4 control-label">Address:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['address'])?$item['address']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputAddress2" class="col-md-4 control-label">City:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['city'])?$item['city']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputStates" class="col-md-4 control-label">State:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['state'])?$item['state']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputCity" class="col-md-4 control-label">Post Code:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['post-code'])?$item['post-code']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="inputPostCode" class="col-md-4 control-label">Country:</label>
                                                                                            <div class="col-md-8">
                                                                                                <p class="form-control-static">{{ isset($item['country'])?$item['country']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End company info -->
                                                                                <h3 class="block-heading">Feedback / Comments / Enquiries</h3>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="inputPostCode" class="col-md-2 control-label">Subject:</label>
                                                                                            <div class="col-md-10">
                                                                                                <p class="form-control-static">{{ isset($item['subject'])?$item['subject']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="inputPostCode" class="col-md-2 control-label">Your Comment / Enquiry :</label>
                                                                                            <div class="col-md-10">
                                                                                                <p class="form-control-static">{{ isset($item['message'])?$item['message']:'' }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-actions">
                                                                                <div class="col-md-offset-5 col-md-8"> <a href="#" data-dismiss="modal" class="btn btn-green">Close &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> <a href="javascript:void(0)" onClick="myprint({{ $key }});" class="btn btn-green">Print</a> </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--END MODAL view details-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End last 5 feedback listing -->

                        </div>

                        <div class="col-lg-4">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="lifetime-sales">
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <i class="fa fa-suitcase icon-4x"></i>
                                            </div>
                                            <div class="col-md-8 mts">
                                                <div class="ls-total">@if(isset($count) && !empty($count)) {{ $count['jobs'] }} @else 0 @endif</span></div>
                                                <div class="ls-title">Active Jobs Posted</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end # of job posted -->

                        <div class="col-lg-4">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="average-orders">
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                <i class="fa fa-users icon-4x"></i>
                                            </div>
                                            <div class="col-md-8 mts">
                                                <div class="ao-total">@if(isset($count) && !empty($count)) {{ $count['applicants'] }} @else 0 @endif</div>
                                                <div class="ao-title">Job Applicants</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end # of job applicants -->
                    </div>
                </div>
            </div>
            <!--END CONTENT-->

            <!--BEGIN FOOTER-->
            <div class="page-footer">
                <div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
                    <div class="pull-right"><img src="images/logo_webqom.png" alt="Webqom Technologies"></div>
                </div>
            </div>
            <!--END FOOTER--></div>
        <!--END PAGE WRAPPER--></div>
</div>

<div id="printingDivFullContent">
    @if(isset($applicants) && !empty($applicants))
    @foreach($applicants as $key => $item)

    <!--Modal view details start-->


        <div class="form-body pal printingDiv" id="printingDiv{{ $key }}">                                                            <h3 class="block-heading">Personal</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputFirstName" class="col-md-4 control-label">Name:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ isset($item['name']) ? $item['name'] : ''}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputEmail" class="col-md-4 control-label">Email:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static"><a href="mailto:hock@webqom.com">{{ $item['email'] }}</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="selGender" class="col-md-4 control-label">Contact Number:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['phone'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputBirthday" class="col-md-4 control-label">Date of Birth:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['birth'] }}</p>
                        </div>
                    </div>
                </div>
            </div>                                                            <h3 class="block-heading">Address</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputAddress1" class="col-md-4 control-label">Address:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['address'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputAddress2" class="col-md-4 control-label">City:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['city'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputStates" class="col-md-4 control-label">State:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['state'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputCity" class="col-md-4 control-label">Post Code:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['postcode'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputPostCode" class="col-md-4 control-label">Country:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['country'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- education background start -->                                                            <h3 class="block-heading">Education Background</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputPostCode" class="col-md-4 control-label">Education Level:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static">{{ $item['level'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end education background-->
            <!-- CV start -->                                                            <h3 class="block-heading">Attached CV</h3>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputPostCode" class="col-md-4 control-label">Applicant CV:
                        </label>

                        <div class="col-md-8">

                            <p class="form-control-static"><a href="{{ $item['cv'] }}" target="_blank">use the uploaded cv file name</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end CV-->
        </div>

        <!--END MODAL view details-->
    @endforeach						  @endif
</div>



<script>
    function myprint(e1){
        document.getElementById('printingDiv'+e1).style.display='block';
        window.print();
        document.getElementById('printingDiv'+e1).style.display='none';
    }
</script>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<script src="vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="vendors/jquery-cookie/jquery.cookie.js"></script>
<script src="js/jquery.menu.js"></script>
<script src="vendors/jquery-pace/pace.min.js"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="vendors/jquery-knob/jquery.knob.js"></script>
<script src="vendors/jquery-animateNumber/jquery.animateNumber.min.js"></script>
<script src="vendors/flot-chart/jquery.flot.js"></script>
<script src="vendors/flot-chart/jquery.flot.categories.js"></script>
<script src="vendors/flot-chart/jquery.flot.pie.js"></script>
<script src="vendors/flot-chart/jquery.flot.tooltip.js"></script>
<script src="vendors/flot-chart/jquery.flot.resize.js"></script>
<script src="vendors/flot-chart/jquery.flot.fillbetween.js"></script>
<script src="vendors/flot-chart/jquery.flot.stack.js"></script>
<script src="vendors/flot-chart/jquery.flot.spline.js"></script>


<!--CORE JAVASCRIPT-->
<script src="js/app.js"></script>
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
<script src="js/myscripts.js"></script>
</body>
<style type="text/css">
    #printingDivFullContent { display:none; }
    #printingDivFullContent .printingDiv { display:none; }

    @media print
    {
        body #wrapper { display:none;}
        #printingDivFullContent { display:block !important; }
    }
</style>
</html>