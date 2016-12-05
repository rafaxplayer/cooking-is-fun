<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Recetas en linea en español">
    <meta name="author" content="Juan rafael simarro">
    <meta name="keywords" content="Recetas en linea ,Recetas en español">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title',trans('textsapp.modal.options.paneladmin'))</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/animate.css')}}"/>
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Annie+Use+Your+Telescope" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/admin/admin.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/admin/bootstrap-toggle.min.css')}}"/>
</head>
<body>
<header>
	<div id="but_menu"><i class="fa fa-bars"></i></div>
    <div id="title">
	<a href="{{url('home')}}">
        <h1>{{Lang::get('textsapp.title')}}</h1>
    </a>
    </div>
    <nav id="ioMenu" class="menu_close">
    <div class="closebut"><i class="fa fa-close"></i></div>
        <ul>
            <li id="user">
                    <a href="#" data-toggle="modal" data-target="#modaluser">
                    <figure>
                        <img class="avatar" src="{{Auth::user()->avatar}}" alt="imagen usuario" onerror="errorImage(this,2)">
                    </figure>
                	{{Auth::user()->name}}</a>
            </li>
            <li>
                <a href="{{url('recipes')}}">
                    <i class='fa fa-cutlery'></i>&nbsp;{{trans('textsapp.recipes')}}
                </a>
            </li>
            
            <li>
                <a href="{{url('recipes/create')}}" >
                    <i class='fa fa-pencil'></i>&nbsp;{{trans('textsapp.editrecipe')}}
                </a>
            </li>
            <li>
                
                <a href="{{url('recipes/favorites')}}">
                    <i class='fa fa-star'></i>&nbsp;{{trans('textsapp.favorites')}}
                </a>
            </li>
            
            
        </ul>
    </nav>

</header>
@include('partials/modal_admin_confirm')
@include('partials/modal_user')
@include('partials/messages')

<div class="row">	
<div class="menu col-md-3 col-sm-3">
	<div class="list-group">
  		<a data-section="#perfil" class="list-group-item active">
    			Panel Administrador
  			</a>
  		<a href="{{url('admin/users')}}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i> Usuarios</a>
  		<a href="{{url('admin/recipes')}}" class="list-group-item"><i class="fa fa-cutlery" aria-hidden="true"></i> Recetas</a>
  		<a href="{{url('admin/settings')}}" class="list-group-item"><i class="fa fa-cutlery" aria-hidden="true"></i> Ajustes</a>
  		
	</div>
</div>
<div class="contentdata col-md-9 col-sm-9">	
@if($view == 'users')
<section class="users">
	{!!Form::open(['url'=>'admin/search/user','method'=>'get','id'=>'searchuser'])!!}
	<div class="search">
		<div class="input-group col-md-5">
			<input name="pattern" type="text" class="form-control" id="search-user" placeholder="Buscar usuario..."  />
			<div onclick="$('#searchuser').submit()" class="input-group-addon">
				<i class="fa fa-search"></i>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
	<ul>
		@foreach($users as $user)
		<li class="item-user">
			<figure>
				<img class="avatar" src="{{$user->avatar}}" alt="">
			</figure>
			<div class="info">
				<h3>{{$user->name}}</h3>
				<p>Email: {{$user->email}}</p>
				<p>Registrado: {{$user->created_at}}</p>
			</div>
			<div class="tools">
				{!!Form::open(['url'=>'admin/delete/user/'.$user->id,'method'=>'get'])!!}
				{!!Form::close()!!}
				<a href="#" data-toggle="modal" data-target="#modal_admin_confirm" data-user="{{$user->name}}">
				<i  class="fa fa-trash"></i></a>
				<i id="{{$user->id}}" class="edit_user fa fa-pencil"></i>
			</div>
			
		</li>
		@endforeach
		</ul>
		{!!$users->render()!!}	
</section>
@endif
@if($view == 'recipes')
<section class="recipes">
	<div class="search">
	{!!Form::open(['url'=>'admin/search/recipes/withpattern','method'=>'get','id'=>'searchrecipe'])!!}
		<div class="input-group col-md-3 pull-right">
			<input name="pattern" type="text" class="form-control" id="search-user" placeholder="Buscar receta..."  />
			<div onclick="$('#searchrecipe').submit()" class="input-group-addon">
				<i class="fa fa-search"></i>
			</div>
		</div>
	{!!Form::close()!!}
	{!!Form::open(['url'=>'admin/search/recipes/withusername','method'=>'get','id'=>'searchrecipeuser'])!!}
		<div class="input-group col-md-3 pull-right">
			<input name="username" type="text" class="form-control" id="search-user" placeholder="Buscar por ususario..."  />
			<div onclick="$('#searchrecipeuser').submit()" class="input-group-addon">
				<i class="fa fa-search"></i>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
	<ul>
		@foreach($recipes as $recipe)
		<li class="item-recipe col-sm-4 col-md-3 col-xs-12">
		
		<a href="{{url('recipes/'.$recipe->id)}}">
			<figure>
				<img class="" src="{{$recipe->img_url}}" alt="">
			</figure>
			<div class="info">
				<h3>{{$recipe->name}}</h3>
				<p>Usuario: {{$recipe->user->name}}</p>
				<p>Creada: {{$recipe->created_at}}</p>
			</div>
		</a>
		
		</li>
		@endforeach
		</ul>
		{!!$recipes->render()!!}	
	
</section>
@endif
@if($view == 'settings')
<section class="settings">
	<ul>
		<li>Modo Mantenimiento <input id="manten" name="manten" type="checkbox" onchange="$('#mantenform').submit()" data-size="small" data-toggle="toggle" {{App\Models\Settings::find(1)->value ? 'checked':''}}/>
		</li>
	
		<li></li>
		<li></li>
	</ul>
</section>
@endif
</div>			
</div>
<script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/modernizer.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/scrollTo.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/admin/admin.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/admin/bootstrap-toggle.min.js')}}"></script>
<footer>
</footer>   
</body>
</html>