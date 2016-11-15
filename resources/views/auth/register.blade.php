@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel  panel-default">
				<div class="panel-heading">{{trans(textsapp.register)}}</div>
				<div class="panel-body">
					
					<form class="form-horizontal" role="form" method="POST" action="{{ url('auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">{{trans(textsapp.name)}}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
								@if($errors->has('name'))
								<div>
									<label class="redtext">{{$errors->first('name')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{trans(textsapp.emailaddress)}}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
								@if($errors->has('email'))
								<div>
									<label class="redtext">{{$errors->first('email')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{trans(textsapp.password)}}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
								@if($errors->has('password'))
								<div>
									<label class="redtext">{{$errors->first('password')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{trans(textsapp.conpassword)}}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
								@if($errors->has('password_confirmation'))
								<div>
									<label class="redtext">{{$errors->first('password_confirmation')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{trans(textsapp.register)}}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
