@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/user/panel.css')}}"/>
@stop
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/user/panel.js')}}"></script>
@stop
@section('content')
<div class="container-fluid">
<div class="page-header">
	<h2>Panel de {{$user->name}}</h2>
</div>
<div class="row">
	<div class="menu col-md-3 col-sm-3">
		<div class="list-group">
  			<a href="{{ url('user/panel/perfil') }}" data-section="#perfil" class="list-group-item active">
    			Editar perfil
  			</a>
  			<a href="{{ url('user/panel/avatar') }}" class="list-group-item"><i class="fa fa-picture-o" aria-hidden="true"></i> Avatar</a>
  			<a href="{{ url('user/panel/password') }}" class="list-group-item"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Contraseña</a>
  			<a href="{{ url('user/panel/email') }}" class="list-group-item"><i class="fa fa-envelope" aria-hidden="true"></i> Email</a>
  			<a href="{{ url('user/panel/recipes') }}" class="list-group-item"><i class="fa fa-cutlery" aria-hidden="true"></i> Recetas</a>
		</div>
	</div>
	
	<div class="content col-md-9 col-sm-9">
	@if($view =='perfil')
		<section id="perfil">
			<div class="perfil_avatar col-md-3">
				<figure>
					<img src="{{$user->avatar}}" alt="avatar user" class="avatar" onerror="errorImage(this,2)">
				</figure>
			</div>
			<div class="info-perfil col-md-9">
				<h2>{{$user->name}}</h2>
				<p><i class="fa fa-envelope" aria-hidden="true"></i> {{$user->email}}</p>
				<p><i class="fa fa-calendar" aria-hidden="true"></i> Te registraste el : {{Auth::user()->created_at}}</p>
				<p><i class="fa fa-cutlery" aria-hidden="true"></i> Has editado un total de : {{count($user->recipes)}} recetas.</p>
			</div>
		</section>
	@endif
	@if($view=='avatar')
		<section id="avatar">
			{!!Form::open(['url'=> 'user/avatar','method'=>'post','class'=>'form','files'=> true])!!}
			<div class="perfil_avatar col-md-3">
				<figure>
					<img src="{{$user->avatar}}" id="imageavatar" alt="avatar user" class="avatar" onerror="errorImage(this,2)"/>
				</figure>
				<div class="form-group">
					<label for="avatarUpload" class="btn btn-primary"><i class="fa fa-image"></i> Sube una Imagen</label>
					<input type="file" class="form-control hidden" name="avatarUpload" id="avatarUpload" value="Load Image" onchange="readURL(this,'#avatarUrl','#imageavatar')"/>
				</div>
				@if($errors->has('avatarUpload'))
					<div>
						<label class="redtext">{{$errors->first('avatarUpload')}}</label>	
					</div>
				@endif
			</div>
			<div class="info-perfil col-md-9">
				
				<div class="form-group">
					<label for="avatarUrl">O desde una url</label>
					<input type="url" class="form-control" id="avatarUrl" id="avatarUrl" name="avatarUrl" placeholder="http://... Pegar enlace de la imagen" onchange="readUrlNoFile(this,'#imageavatar')"/>	
				</div>
				<div class="form-group">
					<Button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</Button>
				</div>
			</div>
			{!!Form::close()!!}
		</section>
	@endif
	@if($view=='password')
		<section id="password">
		{!!Form::open(['url'=>'user/password','method'=>'POST','class'=>'form-horizontal'])!!}
				<div class="form-group">
					<label class="col-md-4 control-label">Contraseña Actual</label>
					<div class="col-md-6">
						<input type="password" class="form-control" name="oldpassword">
					@if($errors->has('oldpassword'))
						<div>
							<label class="redtext">{{$errors->first('oldpassword')}}</label>	
						</div>
					@endif
					</div>
					
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Nueva Contraseña</label>
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
					<label class="col-md-4 control-label">Confirma Contraseña</label>
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
						<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Cambiar Contraseña
						</button>
					</div>
				</div>
				{!!Form::close()!!}
		</section>
	@endif
	@if($view=='email')
		<section id="email">
			{!!Form::open(['url'=>'user/email','method'=>'post', 'class'=>'form-horizontal'])!!}
			<div class="form-group">
				<div class="col-md-6">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" value="{{$user->email}}">
					@if($errors->has('email'))
					<div>
						<label class="redtext">{{$errors->first('email')}}</label>	
					</div>
					@endif
				</div>
						
			</div>
			<div class="form-group">
				<div class="col-md-6 ">
					<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Cambiar Email
						</button>
				</div>
			</div>
		</section>
	@endif
	@if($view=='recipes')
		<section id="recipes">
		<ul class="user-recipes">
		@foreach($recipes as $recipe)
		
			<li class="item-recipe">
			<a href="{{url('/recipes/'.$recipe->id)}}">
				<figure>
					<img src="{{$recipe->img_url}}" alt="">
				</figure>
				<div class="info">
					<h3>{{$recipe->name}}</h3>
					<p>{{$recipe->user->name}}</p>
					<p>{{$recipe->elaboration_time}}</p>
				</div>
			</a>
			</li>
		
		@endforeach
		</ul>
		{!!$recipes->render()!!}
		</section>
	@endif
	</div>
</div>

</div>
@stop