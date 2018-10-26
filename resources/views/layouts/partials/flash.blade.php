@if ( session()->has('info') )
	<div class="alert alert-info">
		<strong>{{ session()->get('info') }}</strong>
	</div>
@elseif ( session()->has('success') )
	<div class="alert alert-success">
		<strong>{{ session()->get('success') }}</strong>
	</div>
@elseif ( session()->has('danger') )
	<div class="alert alert-danger">
		<strong>{{ session()->get('danger') }}</strong>
	</div>
@elseif ( session()->has('warning') )
	<div class="alert alert-warning">
		<strong>{{ session()->get('warning') }}</strong>
	</div>
@endif