@extends('layouts.app')
@section('title','Bienvenido a mi cocina')
@section('css')
<link rel="stylesheet" href="{{asset('public/css/home/home.css')}}"/>
@endsection
@section('content')
<section id="phone">
	<div class="welcome_phone">
		<h2>Bienvenid@ a Cocinar es divertido!!!</h2>
		<p>¿Que cocinamos hoy?</p>
	</div>
	<div class="column">
		<div class="phone_intros">
			<figure>
				<a href="{{url('recipes/create')}}">
					<img src="" alt="">
					<i class="fa fa-cutlery"></i>
				</a>
				
			</figure>
			<div class="info">
				<h3>Edita tu receta y compartela con nosotr@s</h3>
				<p>La mejor manera de divertirse cocinando es hacerlo juntos,enseñanos tus creaciones</p>
			</div>
		
		</div>
		<div class="phone_intros">
			<figure>
				<img src="" alt="">
			</figure>
			<div class="info">
				<h3>Edita tu receta y compartela con nosotr@s</h3>
				<p>La mejor manera de divertirse cocinando es hacerlo juntos,enseñanos tus creaciones</p>
			</div>
			
		</div>
		
	</div>
</section>
<section id="web">
	<div class="intro_web">
		<h2>Bienvenid@ a Cocinar es divertido!!!</h2>
		<p>¿Como deseas empezar?</p>
	</div>
	<section class="animated zoomIn">
		<a href="list_recipes">
			<div class="">
				<i class="recipes"></i>
			</div>
		</a>
		<p>Accede a las recetas online</p>
		<p class="comment">Recetas de la comuindad de ususarios , organizadas por categorias, ¿no sabes que cocinar hoy? Echale un vistazo!</p>
	</section>
	<section class="animated zoomIn">
		<a onclick="">
			<div class="">
				<i class="newrecipe"></i>
			</div>
		</a>
		<p>Edita tu propia receta y compartela con nosotr@s</p>
		<p class="comment">Edita tus recetas en nuestra plataforma y compartela con sus miembros , una buena manera de hacer nuevos amigos y aprender nuevas elaboraciones</p>
	</section>
	<section class="animated zoomIn">
		<a href="https://play.google.com/store/apps/details?id=rafaxplayer.micocina" target="_blank">
			<div class="">
				<i class="androidapp"></i>
			</div>
		</a>
		<p>Quieres usar la aplicacion desde tu smartphone?</p>
		<p class="comment">Nuestra aplicacion en android interactua con este sitio web casi al 100%</p>
	</section>

	

	<div class="slider" id="slider" data-stellar-background-ratio="0.5" data-stellar-horizontal-offset="50">
		<div class="modal_bg">
		
			<div class='content_frases'>
			<i class="fa fa-chevron-up" onclick="$(window).scrollTo('header', 1000);"></i>
				<div class="scooffier" style="">
			
						<h2>&#32;la buena cocina es el fundamento de la verdadera felicidad&#32;</h2>
						<p>- Augusto Escoffier -</p>
				</div>
				<div class="scooffier" style="">
			
						<h2>&#32;Un cocinero nunca muere, mientras alguien interprete sus recetas&#32;</h2>
						<p>- Francis Paniego -</p>
				</div>
				<div class="scooffier" style="">
			
						<h2>&#32;La historia de la gastronomía es la historia del mundo&#32;</h2>
						<p>- Carme Ruscalleda -</p>
				</div>
			
			</div>
		</div>
		
	</div> 
</section>

@endsection	
