<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$recipe->name}}</title>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	
	<style>
	
		html{
  			margin: 0;
		}
		body{

			font-family: "Varela Round", sans-serif;
			
		}

		.content_title{
			text-align: center;
			color:#333;
		}
		.details figure{
			width: 400px;
			height: 400px;
			margin: 10px auto;
			
		}
		.details figure img{
			width: 100%;
			height: 100%;
		}
		.details>div{
			margin:0 50px;
		}
		.details .info{
			margin:20px 50px;
		}
		.details .info label{
			
			font-size: 1.2em;
			font-weight: bold;
			display: block;

		}
		.details .info>div{
			margin-top: 5px;
		}
		.details .info p{
			margin-top:0px;
		}
		footer{

			text-align: center;
		}
		footer p{
			position: fixed;
			bottom: 50px;
			color:#333;
			font-size:.8em
		}
		
	</style>
</head>
<body>
<div class="container">
	<div class="content_title">
		<h2>{{$recipe->name}}</h2>
	</div>
	<div class="details">
		<figure>
			<img src="{{$recipe->img_url}}" alt="imagen de la receta" />
		</figure>

		<div class="info">
			<div>
			<label for="">Creada por: </label>
			{{$recipe->user->name}}
			</div>
			<div>
			<label for="">Tiempo: </label> 
			{{$recipe->elaboration_time}}
			</div>
			<div>
			<label for="">Ingredientes</label>
			<p>{!! nl2br($recipe->ingredients) !!}</p>
			</div>
			<label for="">Elaboración</label>
			<p>{!!nl2br($recipe->elaboration) !!}</p>
		</div>
	</div>
</div>
<footer>
<p>Created in www.cooking-is-fun.com</p>	
</footer>
	
</body>
</html>