@extends('front/templateFront')

@section('content')

<section id="content">
<div class="md-margin2x"></div>
<div class="container">
<?php
if(count($errors) > 0)
{	
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
        @foreach ($errors as $error)
          <p>{{ $error }}</p>
        @endforeach
    </div>
<?php
}
else
{
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <i class="fa fa-times-circle"></i> <strong>Error!</strong>        
          <p>Sorry for the inconvenience, page you're looking for is not found!</p>       
    </div>
<?php
}
?>
</div>
</section>

@endsection