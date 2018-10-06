@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
                    
                    <?php // echo '<pre>'; print_r(Auth::user());
					// echo Auth::user()->email;  </pre>?>
                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
