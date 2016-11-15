@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading modal-header-danger">Login</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'auth/login', 'class' => 'form-horizontal']) !!}
						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								{!! Form::email('email', '', ['class'=> 'form-control']) !!}
								@if($errors->has('email'))
								<div>
									<label class="redtext">{{$errors->first('email')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								{!! Form::password('password', ['class'=> 'form-control']) !!}
								@if($errors->has('password'))
								<div>
									<label class="redtext">{{$errors->first('password')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> {{trans('textsapp.remember')}}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Logearse',['class' => 'btn btn-primary']) !!}
								<a href="{{url('auth/register')}}" class="btn btn-default">{{trans('textsapp.register')}}</a>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
