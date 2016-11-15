@if(Session::has('message'))
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{Session::get('message')}}
		<i class="fa fa-check" aria-hidden="true"></i>
	</div>
@endif
@if(Session::has('message_warning'))
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{Session::get('message_warning')}}
		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
	</div>
@endif
