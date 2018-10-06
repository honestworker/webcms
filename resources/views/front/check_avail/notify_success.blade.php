@extends('front/templateFront')
@section('content')

<div class="container">
  <div style="margin:100px 0">
      @if ($success)
    <div class="alert alert-success alert-dismissable">
      <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
      <i class="fa fa-check-circle"></i> <strong>Success!</strong>
      <p>{{ $success }}</p>
    </div>    
@endif

@if ($warning)
    <div class="alert alert-danger alert-dismissable">
      <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
      <i class="fa fa-times-circle"></i> <strong>Error!</strong>
      <p>{{ $warning }}</p>
    </div>
@endif
  <div class="text-center">
  <a href="/" class="btn btn-success" >Back to Home</a>
  </div>
  </div>
</div>


@endsection

