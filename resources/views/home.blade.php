@extends('layouts.app')
@section('title','Bienvenido a mi cocina')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/home/home.css')}}"/>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('public/js/scrollTo.min.js')}}"></script>
@endsection
@section('content')
<section id="phone">
	<div class="welcome_phone">
		<h2>Bienvenid@ a Cocinar es divertido!!!</h2>
		<p>¿Que que apetece hacer hoy?</p>
	</div>
	<div class="column">
		<div class="content_section">
			<figure>
				<a href="{{url('recipes/create')}}">
					<img src="{{asset('public/img/recipes.jpg')}}" alt="">
				</a>
			</figure>
			<div class="info">
				<h3>Recetas creadas por nuestra comunidad</h3>
				<p>¿Que vas a comer hoy? Busca en nuestra base de datos algo que te apetezca y manos a la obra.</p>
			</div>
		
		</div>
		<div class="content_section">
			<figure>
				<a href="{{url('recipes')}}">
				<img src="{{asset('public/img/edit.jpg')}}" alt="">
				</a>
			</figure>
			<div class="info">
				<h3>Edita tu receta y compartela con nosotr@s</h3>
				<p>La mejor manera de divertirse cocinando es hacerlo juntos,enseñanos tus creaciones.</p>
			</div>
			
		</div>
		
	</div>
	<div class="fab" onclick="$.scrollTo('header',500)"><i class="fa fa-arrow-up"></i></div>
</section>
<section id="web">
	<div class="intro_web">
		<h2>Bienvenid@ a cocinar es divertido!!!</h2>
		<p>¿Como deseas empezar?</p>
	</div>
	<div>
		<div class="content_section">
			<figure>
				<a href="{{url('recipes/create')}}">
					<img src="{{asset('public/img/recipes.jpg')}}" alt="">
				</a>
			</figure>
			<div class="info">
				<h3>Recetas creadas por nuestra comunidad</h3>
				<p>¿Que vas a comer hoy? Busca en nuestra base de datos algo que te apetezca y manos a la obra.</p>
			</div>
		
		</div>
		<div class="content_section">
			
			<div class="info">
				<h3>Edita tu receta y compartela con nosotr@s</h3>
				<p>La mejor manera de divertirse cocinando es hacerlo juntos,enseñanos tus creaciones.</p>
			</div>
			<figure>
				<a href="{{url('recipes')}}">
				<img src="{{asset('public/img/edit.jpg')}}" alt="">
				</a>
			</figure>
		</div>
	</div>
	
	<div class="slider" id="slider" data-stellar-background-ratio="0.5" data-stellar-horizontal-offset="50">
		<div class="">
		
			<div class='content_frases'>
			<i class="fa fa-chevron-up" onclick="$(window).scrollTo('header', 1000);"></i>
				<div class="scooffier">
			
						<h2>&#32;la buena cocina es el fundamento de la verdadera felicidad&#32;</h2>
						<p>- Augusto Escoffier -</p>
				</div>
				<div class="scooffier" >
			
						<h2>&#32;Un cocinero nunca muere, mientras alguien interprete sus recetas&#32;</h2>
						<p>- Francis Paniego -</p>
				</div>
				<div class="scooffier">
			
						<h2>&#32;La historia de la gastronomía es la historia del mundo&#32;</h2>
						<p>- Carme Ruscalleda -</p>
				</div>
			
			</div>
		</div>
		
	</div> 
	<div class="fab" onclick="$.scrollTo('header',500)"><i class="fa fa-reply-all"></i></div>
</section>

@endsection	
