@extends('layouts.app')
@section('title','Recetas mas recientes')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/recipes/recipes.css')}}"/>
@stop
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/recipe.js')}}"></script>
@stop
@section('content')
<div class="container-fluid">
<div class="content_title">
	<h3>Listado de recetas</h3>
</div>
<div id="search">
	<select name="category_search" class="form-control">
		@foreach(App\Models\Category::all() as $cat)
			<option value="{{$cat->id}}">{{$cat->name}}</option>
		@endforeach
	</select>
	<div class="input-group">
        <input type="text" class="form-control" id="exampleInputAmount" placeholder="Search...">
      	<div class="input-group-addon"><i class="fa fa-search"></i></div>
    </div>

</div>
	<div id="list_recipes" class="row">
		@foreach(App\Models\Recipe::all() as $recipe)
			<div class="item_recipe col-sm-3 col-xs-12">
				<figure>
					<img src="{{$recipe->img_url}}" alt="imagen de la receta">
				</figure>
				<div class="info">
					<h3>{{$recipe->name}}</h3>
					
					<p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$recipe->elaboration_time}}</p>
					<p><i class="fa fa-user-circle" aria-hidden="true"></i> {{$recipe->user->name}}</p>
					@if(count($recipe->categories)>0)
					<p><i class="fa fa-tag" aria-hidden="true"></i> {{$recipe->categoriesToString()}}</p>
					@endif
				</div>
			</div>
		@endforeach
	</div>
</div>
@stop