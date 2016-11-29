<div class="col-md-4">
	<figure >
		<img id="imagerecipe" src="{{$recipe->img_url or asset('public/img/recipe_placeholder.png')}}" name="img" />
	</figure>
	<div class="form-group">
		<label for="imageUpload" class="btn btn-primary"><i class="fa fa-image"></i> {{trans('textsapp.uploadimage')}}</label>
		<input type="file" class="form-control hidden" name="imageUpload" id="imageUpload" value="Load Image" onchange="readURL(this,'#inputimgurl','#imagerecipe');" />
		@if($errors->has('imageUpload'))
		<div>
			<label class="redtext">{{$errors->first('imageUpload')}}</label>	
		</div>
		@endif
	</div>
	<div class="form-group">
		<label for="img_url">{{trans('textsapp.pasteimage')}}</label>
		<input type="url" class="form-control" id="inputimgurl" name="img_url" onblur="readUrlNoFile(this,'#imagerecipe')" style="" placeholder="http://... Pegar enlace de la imagen" name="imgurl" value="{{$recipe->img_url or ''}}"/>
		@if($errors->has('img_url'))
		<div>
			<label class="redtext">{{$errors->first('img_url')}}</label>	
		</div>
		@endif
	</div>
</div>
<div class="col-md-8">
	<div class="form-group">
		<label for="namerecipe">{{trans('textsapp.recipename')}}</label>
		<input type="text" class="form-control" placeholder="Nombre de la receta" name="namerecipe" value="{{$recipe->name or old('name')}}" />
		@if($errors->has('name'))
		<div>
			<label class="redtext">{{$errors->first('name')}}</label>	
		</div>
		@endif
	</div>
	<div class="form-group">
		<a class="btn btn-primary" data-toggle="modal" data-target="#modalcategories"><i class="fa fa-tag"></i> {{trans('textsapp.selectcat')}}</a>
		@include('partials.modal_categories')
	</div>
	<div class="form-group">
		<label for="time">{{trans('textsapp.preparationtime')}} (Horas:Minutos):</label>
		<input type="time" class="form-control" name="elaboration_time" value="{{$recipe->elaboration_time or '00:00'}}"/>
				
	</div>
	<div class="form-group">
		<label for="ingredientes">{{trans('textsapp.ingredients')}}:</label>
		<textarea name="ingredients" class="form-control" placeholder="Ingresa los ingredientes de tu receta" cols="30" rows="5">{{$recipe->ingredients or old('ingredients')}}</textarea>
		@if($errors->has('ingredients'))
		<div>
			<label class="redtext">{{$errors->first('ingredients')}}</label>	
		</div>
		@endif

	</div>
	<div class="form-group">
		<label for="elaboracion">{{trans('textsapp.elaboration')}}:</label>
		<textarea name="elaboration" class="form-control" placeholder="describe la elaboración de tu receta"cols="30" rows="5">{{$recipe->elaboration or old('elaboration')}}</textarea>
		@if($errors->has('elaboration'))
		<div>
			<label class="redtext">{{$errors->first('elaboration')}}</label>	
		</div>
		@endif
	</div>
	<div class="form-group">
		<Button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{trans('textsapp.save')}}</Button>
		@if(isset($recipe))
			<a href="{{ URL::previous() }}" id="cancelform" class="btn btn-danger"  ><i class="fa fa-times"></i> Cancelar</a>
		@else
			<Button type="reset" id="resetform" class="btn btn-danger"  onclick="restoreImage('#imagerecipe',1);"><i class="fa fa-undo"></i> {{trans('textsapp.clean')}}</Button>
		@endif
	</div>
</div>