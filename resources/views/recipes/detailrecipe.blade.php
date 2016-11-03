@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/recipes/recipes.css')}}"/>
@stop
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/recipes/recipe.js')}}"></script>
@stop
@include('partials.modal_confirm')
@section('content')
<div class="container-fluid">
<div class="content_title">
	<h2>{{$recipe->name}}</h2>
</div>
<div class="details form_custom row">
	<div class="col-md-4">
		<figure >
			<img id="imagerecipe" src="{{$recipe->img_url}}" alt="imagen de la receta" />
		</figure>
		@if(Auth::check())
			@if(Auth::user()->id == $recipe->user_id)
			<div class="tools">
				<a href="{{url('recipes/'.$recipe->id.'/edit')}}"><i class="fa fa-pencil"></i></a>
				<a href="" data-toggle="modal" data-target="#modalconfirm" data-name="{{$recipe->name}}" data-id="{{$recipe->id}}"><i class="fa fa-trash"></i></a>
				<a href=""><i class="fa fa-print"></i></a>					
			</div>
			@else
			<div class="favorites">
				<a href="{{$favorite?url('recipes/favorite/remove/'.$recipe->id):url('recipes/favorite/'.$recipe->id)}}" class="btn-favorites"><i class="fa fa-star"></i>{{  $favorite ?' Eliminar de favoritos':' Añadir a favoritos'}}</a>	
			</div>
			@endif
		@endif
	</div>
	<div class="col-md-8 ">
		<ul class="categories">	
			@foreach($recipe->categories as $cat)
				<li class="item_categories"><i class="fa fa-tag"></i> {{$cat->name}}</li>
			@endforeach
		</ul>
		<p><i class="fa fa-user-circle"></i> {{App\Models\User::find($recipe->user_id)->name}}</p>
		<p><i class="fa fa-clock-o"></i> {{$recipe->elaboration_time}}</p>
		<p><i class="fa fa-star-o"></i> Favoritos : {{$favorite ? ' Si':'No'}}</p>
		<label for="">Ingredientes</label>
		<p>{{$recipe->ingredients}}</p>
		<label for="">Elaboración</label>
		<p>{{$recipe->elaboration}}</p>
		<div class="socialshare">
		<a href="https://www.facebook.com/sharer/sharer.php?u={{Request::fullUrl()}}" target="_blank" class="btn btn-primary"><i class="fa fa-facebook"></i> Compartir en facebook</a>
		<a href="https://twitter.com/?status=Me gusta esta receta {{Request::fullUrl()}}" target="_blank" class="btn btn-info"><i class="fa fa-twitter"></i> Compartir en twitter</a>
		<a href="https://plus.google.com/share?url={{Request::fullUrl()}}" target="_blank" class="btn btn-danger"><i class="fa fa-google-plus"></i> Compartir en Google+</a>
	</div>
	</div>
	
</div>
	
</div>
@stop