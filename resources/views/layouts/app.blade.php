<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content="Recetas en linea en español">
    <meta name="keywords" content="Recetas en linea ,Recetas en español">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title','Cooking Is Fun')</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    
    
    <link rel="stylesheet" href="{{asset('public/css/animate.css')}}"/>
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Annie+Use+Your+Telescope" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}"/>
    @yield('css')
    
</head>
<body>
<header>
	<div id="but_menu"><i class="fa fa-bars"></i></div>
	<a id="title" href="{{url('home')}}"><h1>Cooking is Fun!</h1></a>
    
    
    <nav id="ioMenu" class="menu_close">
    <div class="closebut"><i class="fa fa-close"></i></div>
        <ul>
            <li id="user">
                @if(Auth::check())
                    <figure>
                        <img class="avatar" src="{{Auth::user()->avatar}}" alt="imagen usuario">
                    </figure>
                    
                	<a href="" data-toggle="modal" data-target="#modaluser">{{Auth::user()->name}}</a>
                    </div>
                @else
                	<a href="{{url('auth/login')}}"><p>Loguearse</p></a>&nbsp;|&nbsp;<a href="{{url('auth/register')}}">Registrarse</a>
                @endif
            </li>
            <li>
                <a href="{{url('recipes')}}">
                    <i class='fa fa-cutlery'></i>&nbsp;Recetas
                </a>
            </li>
            @if(Auth::check())
            <li>
                <a href="{{url('recipes/create')}}" >
                    <i class='fa fa-pencil'></i>&nbsp;Editar Receta
                </a>
            </li>
            <li>
                <!-- <span class="badge">{{Auth::user()->favorites->count()}}</span> -->
                <a href="{{url('recipes/favorites')}}">
                    <i class='fa fa-star'></i>&nbsp;Favoritos
                </a>
            </li>
            @endif
            
        </ul>
    </nav>
<div class="header_back" >
    <figure><img src="{{asset('public/img/header.jpg')}}" alt=""></figure>
    <div class="header-info">  
    <p>Comparte tus creaciones culinarias o accede a las de otros muchos usuarios...</p>

    </div>
</div>
</header>
@include('partials/modal_user')
@include('partials/messages')
@yield('content')

<script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/modernizer.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/app.js')}}"></script>
@yield('javascript')
<footer>
    
</footer>   
</body>
</html>
