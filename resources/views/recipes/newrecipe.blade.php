@extends('layouts.app')
@section('title','Nueva Receta')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/recipes/recipes.css')}}"/>
@stop
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/recipes/recipe.js')}}"></script>
@stop

@section('content')
<div class="container-fluid">
<div class="content_title">
	<h2>Ingresa los datos de tu receta</h2>
</div>
	{!!Form::open(['route'=>'recipes.store','method'=>'post','class'=>'form-horizontal form_custom','files'=>true])!!}
		<div class="col-md-4">
			<figure >
				<img id="imagerecipe" src="{{asset('public/img/recipe_placeholder.png')}}" name="img" />
			</figure>
			<div class="form-group">
				<label for="imageUpload" class="btn btn btn-primary"><i class="fa fa-image"></i> Sube una Imagen</label>
				<input type='file' class="form-control hidden" name="imageUpload" id="imageUpload" value="Load Image" onchange="readURL(this,'#inputimgurl','#imagerecipe');" />
				@if($errors->has('imageUpload'))
				<div>
					<label class="redtext">{{$errors->first('imageUpload')}}</label>	
				</div>
				@endif
			</div>
			<div class="form-group">
				<label for="img_url">O pega un enlace a una imagen</label>
				<input type="url" class="form-control" id="inputimgurl" name="img_url" onblur="readUrlNoFile(this)" style="" placeholder="http://... Pegar enlace de la imagen" name="imgurl"/>
				@if($errors->has('img_url'))
				<div>
					<label class="redtext">{{$errors->first('img_url')}}</label>	
				</div>
				@endif
			</div>
		</div>
		<div class="col-md-8">
			<div class="form-group">
				<label for="name">Nombre de la receta:</label>
				<input type="text" class="form-control" placeholder="Nombre de la receta" name="name" value="{{old('name')}}" />
				@if($errors->has('name'))
				<div>
					<label class="redtext">{{$errors->first('name')}}</label>	
				</div>
				@endif
			</div>
			<div class="form-group">
				<a class="btn btn-primary" data-toggle="modal" data-target="#modalcategories"><i class="fa fa-tag"></i> Selecciona categorias</a>
				@include('partials.modal_categories')
	  		</div>
	  		<div class="form-group">
				<label for="time">Tiempo de preparación (Horas:Minutos):</label>
				<input type="time" class="form-control" name="elaboration_time" value="00:00"/>
				
			</div>
			<div class="form-group">
				<label for="ingredientes">Ingredientes:</label>
				<textarea name="ingredients" class="form-control" placeholder="Ingresa los ingredientes de tu receta" cols="30" rows="5">{{old('ingredients')}}</textarea>
				@if($errors->has('ingredients'))
				<div>
					<label class="redtext">{{$errors->first('ingredients')}}</label>	
				</div>
				@endif

			</div>
			<div class="form-group">
				<label for="elaboracion">Elaboración:</label>
				<textarea name="elaboration" class="form-control" placeholder="describe la elaboración de tu receta"cols="30" rows="5">{{old('elaboration')}}</textarea>
				@if($errors->has('elaboration'))
				<div>
					<label class="redtext">{{$errors->first('elaboration')}}</label>	
				</div>
				@endif
			</div>
			<div class="form-group">
				<Button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</Button>
				<Button type="reset" id="resetform" class="btn btn-danger"  onclick="restoreImage('#imagerecipe');"><i class="fa fa-undo"></i> Limpiar</Button>
			</div>
		</div>
	{!!Form::close()!!}
</div>
@stop