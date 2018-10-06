@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<strong>User details</strong>
                    <?php
					print_r($userDetails);
					?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
