<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>FYP - {{ $title or 'MIS' }}</title>

		<!-- Fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

		<!-- Styles -->
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css" />
		<link rel="stylesheet" href="{{asset('css/app.css')}}" />

		<!-- Scripts -->
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		@yield('head')
	</head>
	<body>
		<div class="mdl-layout mdl-js-layout @yield('fixed-drawer-class') mdl-layout--fixed-header">
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
			@yield('drawer')
	  		<main class="mdl-layout__content">
	  			<div class="page-content">
					@yield('content')
				</div>
			</main>
		</div>
	</body>
</html>
