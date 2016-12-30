@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/easy-autocomplete.min.css')}}"/>
<link rel="stylesheet" href="{{asset('public/css/recipes/recipes.css')}}"/>
@stop
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/jquery.easy-autocomplete.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/recipes/list_recipes.js')}}"></script>
@stop
@section('content')
<div class="container-fluid">
	<div class="content_title">
		<h2>{{trans('textsapp.listrecipes')}}</h2>
	</div>
	<div id="search">
		<div class="input-group">	
			{!!Form::select('category', App\Models\Category::lists('name','id'),null,['class'=>'form-control','id'=>'category','onchange'=>'onChangeCat(this.value)'])!!}
		</div>
		
		<div class="input-group">
			{!!Form::text('search',null,['class'=>'form-control','id'=>'InputSearch','placeholder'=>'Search...','onkeyup'=>'search(this.value)'])!!}
	       	<div class="input-group-addon"><i class="fa fa-search"></i></div>
	    </div>
	</div>
	<div id="list_recipes">
		<div class="row">
		@if($recipes->count() > 0)
			@foreach($recipes as $recipe)
				<div class="col-md-3 col-sm-4 col-xs-12">
				<a href="{{url('/recipes/'.$recipe->id)}}">
					<div class="item_recipe">
						@if(Auth::check() && Auth::user()->favorites->contains($recipe))
							<div class="star-favorite"><i class="fa fa-star"></i></div>
						@endif
						<figure>
							<img src="{{$recipe->img_url}}"  alt="imagen de la receta">
						</figure>
						<div class="info">
							
							<h3>{{$recipe->name}}</h3>
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$recipe->elaboration_time}}</p>
							<p><i class="fa fa-user-circle" aria-hidden="true"></i> {{$recipe->user->name}}</p>
							@if(count($recipe->categories) > 0)
							<p><i class="fa fa-tag" aria-hidden="true"></i> {{$recipe->categoriesToString()}}</p>
							@endif
						</div>
					</div>
					</a>
				</div>
			@endforeach
		@else
			<div class="empty">
				<figure>
					<img src="{{asset('public/img/no-recipes.png')}}" alt="">
				</figure>
				<h4>{{trans('textsapp.norecipes')}}</h4>
			</div>
		@endif
		</div>
	{!!$recipes->render()!!}
	</div>
</div>

@stop