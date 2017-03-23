<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>FYP - {{ $title or 'MIS' }}</title>

	<!-- Fonts -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Styles -->
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css" />
	<link rel="stylesheet" href="{{asset('css/app.css')}}" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Scripts -->
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
	</script>
	@yield('head')
</head>
<body>
	<div id="app">
		<div class="mdl-layout mdl-js-layout @yield('header-classes') mdl-layout--fixed-header">
			<header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
					<span class="mdl-layout-title">{{ $title or 'FYP - MIS' }}</span>
					<div class="mdl-layout-spacer"></div>
					@yield('nav', '')
				</div>
				@yield('tabs')
			</header>
			@yield('drawer')
			<main class="mdl-layout__content">
				<div class="page-content">
					@yield('content')
				</div>
			</main>
		</div>
	</div>
	<!-- Scripts -->
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script src="{{ asset('js/manifest.js') }}"></script>
	<script src="{{ asset('js/vendor.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/tester.js') }}"></script>
	@yield('scripts')
</body>
</html>
