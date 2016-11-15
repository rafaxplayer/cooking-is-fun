@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel  panel-default">
				<div class="panel-heading">Contacta con el administrador</div>
				<div class="panel-body">
					
					<form class="form-horizontal" role="form" method="POST" action="{{ url('user/contact/send')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						

						<div class="form-group">
							<label class="col-md-4 control-label">Tu E-Mail</label>
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
							<label class="col-md-4 control-label">Asunto</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
								@if($errors->has('subject'))
								<div>
									<label class="redtext">{{$errors->first('subject')}}</label>	
								</div>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Mensage</label>
							<div class="col-md-6">
								<textarea class="form-control" name="message" rows="8">{{ old('message') }}</textarea>
								@if($errors->has('message'))
								<div>
									<label class="redtext">{{$errors->first('message')}}</label>	
								</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Enviar
								</button>
								<a type="submit" class="btn btn-default">
									Cancelar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
