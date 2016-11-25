{!!Form::open(['url'=>'admin/user','class'=>'form form-horizontal','method'=>'post','files'=>true])!!}
<div class="avatar_user col-md-5">
	<figure>
		<img src="{{$user->avatar}}" id="imageavatar" alt="avatar user" class="avatar" onerror="errorImage(this,2)"/>
	</figure>
	<div class="form-group">
		<label for="avatarUpload" class="btn btn-primary"><i class="fa fa-image"></i> Sube una Imagen</label>
		<input type="file" class="form-control hidden" name="avatarUpload" id="avatarUpload" value="Load Image" onchange="readURL(this,'#avatarUrl','#imageavatar')"/>
		<input type="text" class="hidden" name="userid" value="{{$user->id}}">
	</div>
		@if($errors->has('avatarUpload'))
	<div>
		<label class="redtext">{{$errors->first('avatarUpload')}}</label>	
	</div>
		@endif
	<div class="form-group">
		<div class="col-md-11">
			<label for="avatarUrl">O desde una url:</label>
			<input type="url" class="form-control" id="avatarUrl" id="avatarUrl" name="avatarUrl" placeholder="http://... Pegar enlace de la imagen" onchange="readUrlNoFile(this,'#imageavatar')"/>
		</div>	
	</div>
	
</div>
<div class="info_user col-md-7">
	<div class="form-group">
		<div class="col-md-6">
			<label class=" control-label" for="name">{{trans('textsapp.name')}}</label>
				<input type="text" class="form-control" name="name" value="{{ $user->name }}">
			@if($errors->has('name'))
			<div>
				<label class="redtext">{{$errors->first('name')}}</label>	
			</div>
			@endif
		</div>
	</div>

	<div class="form-group">
		
		<div class="col-md-6">
			<label for="email" class="control-label">{{trans('textsapp.emailaddress')}}</label>
			<input type="email" class="form-control" name="email" value="{{ $user->email}}">
			@if($errors->has('email'))
			<div>
				<label class="redtext">{{$errors->first('email')}}</label>	
			</div>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6">
			<label for="password" class="control-label">Cambiar contraseña</label>
			<input type="password" class="form-control" name="password">
		@if($errors->has('password'))
		<div>
			<label class="redtext">{{$errors->first('password')}}</label>	
		</div>
		@endif
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
		<label for="active" class="control-label">Activo</label>
		{!!Form::select('active',array('0'=>'0','1'=>'1'),$user->active,['class' => 'form-control'])!!}
			
		@if($errors->has('active'))
		<div>
			<label class="redtext">{{$errors->first('active')}}</label>	
		</div>
		@endif
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
		<label for="range" class="control-label">Rango</label>
		{!!Form::select('range',array('member'=>'member','admin'=>'admin'),$user->range,['class' => 'form-control'])!!}
			
		@if($errors->has('range'))
		<div>
			<label class="redtext">{{$errors->first('range')}}</label>	
		</div>
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 ">
			<button type="submit" class="btn btn-primary">
					{{trans('textsapp.save')}}
			</button>
		</div>
	</div>
</div>
{!!Form::close()!!}