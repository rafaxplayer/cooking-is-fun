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
    <title>@yield('title',trans('textsapp.title'))</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/favicon.ico')}}"/>
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
    <div id="title">
	<a href="{{url('home')}}">
        <h1>{{Lang::get('textsapp.title')}}</h1>
    </a>
    </div>
    <nav id="ioMenu" class="menu_close">
    <div class="closebut"><i class="fa fa-close"></i></div>
        <ul>
            <li id="user">
                @if(Auth::check())
                    <a id="login_user" href="#" data-toggle="modal" data-target="#modaluser">
                    <figure>
                        <img class="avatar" src="{{Auth::user()->avatar}}" alt="imagen usuario" onerror="errorImage(this,2)">
                    </figure>
                	{{Auth::user()->name}}</a>
                @else
                	<a href="{{url('auth/login')}}">{{trans('textsapp.login')}}</a>|<a href="{{url('auth/register')}}">{{trans('textsapp.register')}}</a>
                @endif
            </li>
            <li>
                <a href="{{url('recipes')}}">
                    <i class='fa fa-cutlery'></i>&nbsp;{{trans('textsapp.recipes')}}
                </a>
            </li>
            @if(Auth::check())
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
            @endif
            
        </ul>
    </nav>
<div class="header_back" >
    <figure><img src="{{asset('public/img/header.jpg')}}" alt=""></figure>
    <div class="header-info">  
        <p>{{trans('textsapp.headerinfo')}}</p>
    </div>
</div>
</header>
@include('partials/modal_user')
@include('partials/messages')
@yield('content')
<script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/modernizer.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/scrollTo.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/app.js')}}"></script>
@yield('javascript')
<div class="fab" onclick="$.scrollTo('header',500)">
    <i class="fa fa-reply-all"></i>
</div>
<footer>
    <aside> 
        <section class="footer-recipes">
            @foreach(App\Models\Recipe::all()->slice(0,8) as $recipe)
            <a href="{{url('recipes/'.$recipe->id)}}" class="recipe-link">{{$recipe->name}}</a>
            @endforeach
        </section>
    </aside>
    <div class="langs">
        <a href="{{url('setlang/es')}}">
            <img src="{{asset('public/img/es.png')}}" alt="bandera spain">
        </a>
        <a href="{{url('setlang/en')}}">
            <img src="{{asset('public/img/en.png')}}" alt=" bandera england">
        </a>
        
    </div>
    <div class="sing"> 
        <p>powered by raf@xplayer© - <a href="{{url('user/contact')}}">contacto</a></p>
    </div>
    
</footer>   
</body>
</html>
