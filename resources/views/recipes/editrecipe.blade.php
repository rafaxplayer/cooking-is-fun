@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/recipes/recipes.css')}}"/>
@stop
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/recipes/recipe.js')}}"></script>
@stop

@section('content')
<div class="container-fluid">
<div class="content_title">
	<h2>{{trans('textsapp.edit',['recipe'=>$recipe->name])}}</h2>
</div>
	{!!Form::open(['route'=>array('recipes.update',$recipe->id),'method'=>'PUT','class'=>'form-horizontal form_custom','files'=>true])!!}
		@include('partials.form_recipes')
	{!!Form::close()!!}
</div>
@stop