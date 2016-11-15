@extends('layouts.app')
@section('title',trans('textsapp.welcome'))
@section('css')
<link rel="stylesheet" href="{{asset('public/css/home/home.css')}}"/>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/home/home.js')}}"></script>
@endsection
@section('content')
<section id="phone">
	<div class="welcome_phone">
		<h2>{{trans('textsapp.welcome')}}</h2>
		<p>{{trans('textsapp.welcome.subtitle')}}</p>
	</div>
	<div class="column">
		<div class="content_section">
			<figure>
				<a href="{{url('recipes')}}">
					<img src="{{asset('public/img/recipes.jpg')}}" alt="">
				</a>
			</figure>
			<div class="info">
				<h3>{{trans('textsapp.home.first.info.title')}}</h3>
				<p>{{trans('textsapp.home.first.info.text')}}</p>
			</div>
		
		</div>
		<div class="content_section">
			<figure>
				<a href="{{url('recipes/create')}}">
				<img src="{{asset('public/img/edit.jpg')}}" alt="">
				</a>
			</figure>
			<div class="info">
				<h3>{{trans('textsapp.home.second.info.title')}}</h3>
				<p>{{trans('textsapp.home.second.info.text')}}</p>
			</div>
			
		</div>
		
	</div>
</section>
<section id="web">
	<div class="intro_web">
		<h2>{{trans('textsapp.welcome')}}</h2>
		<p>{{trans('textsapp.welcome.subtitle.web')}}</p>
	</div>
	<div>
		<div class="content_section">
			<figure>
				<a href="{{url('/recipes')}}">
					<img src="{{asset('public/img/recipes.jpg')}}" alt="">
				</a>
			</figure>
			<div class="info">
				<h3>{{trans('textsapp.home.first.info.title')}}</h3>
				<p>{{trans('textsapp.home.first.info.text')}}</p>
			</div>
		
		</div>
		<div class="content_section">
			
			<div class="info">
				<h3>{{trans('textsapp.home.second.info.title')}}</h3>
				<p>{{trans('textsapp.home.second.info.text')}}</p>
			</div>
			<figure>
				<a href="{{url('recipes/create')}}">
				<img src="{{asset('public/img/edit.jpg')}}" alt="">
				</a>
			</figure>
		</div>
	</div>
	
	<div class="slideshow" id="slideshow">
			
		<div>
			
			<h3>&#32;La buena cocina es el fundamento de la verdadera felicidad&#32;</h3>
			<p>- Augusto Escoffier -</p>
		</div>
		<div>
			
			<h3>&#32;Un cocinero nunca muere, mientras alguien interprete sus recetas&#32;</h3>
			<p>- Francis Paniego -</p>
		</div>
		<div>
			
			<h3>&#32;La historia de la gastronomía es la historia del mundo&#32;</h3>
			<p>- Carme Ruscalleda -</p>
		</div>
					
	</div> 
	
	
</section>

@endsection	
