<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>FYP - @yield('title', 'MIS')</title>

		<!-- Fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

		<!-- Styles -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css" />
		<link rel="stylesheet" href="{{asset('css/app.css')}}" />

		<!-- Scripts -->
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		@yield('head')
	</head>
	<body>
		<div class="mdl-layout mdl-js-layout @section('fixed-drawer-class') mdl-layout--fixed-drawer @show mdl-layout--fixed-header">
			<header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
					<span class="mdl-layout-title">@yield('title')</span>
					<div class="mdl-layout-spacer"></div>
					<nav>
			            @if (Auth::check())
							<a class="mdl-navigation__link" href="{{ route('logout')}}">Logout</a>
			            @else
			                <a class="mdl-navigation__link" href="{{ url('/login') }}">Login</a>
	    		        @endif
					</nav>
				</div>
			</header>
			@section('drawer')
				<div class="mdl-layout__drawer">
					<nav class="mdl-navigation">
						<a class="mdl-navigation__link" href="">Link</a>
						<a class="mdl-navigation__link" href="">Link</a>
						<a class="mdl-navigation__link" href="">Link</a>
						<a class="mdl-navigation__link" href="">Link</a>
					</nav>
				</div>
			@show
	  		<main class="mdl-layout__content">
	  			<div class="page-content">
					@yield('content')
				</div>
			</main>
		</div>
	</body>
</html>
