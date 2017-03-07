@extends('layouts.main')
@section('header-classes', 'mdl-layout--fixed-tabs mdl-layout--fixed-drawer')
@section('tabs')
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
		<a href="#fixed-tab-1" class="mdl-layout__tab is-active">Tab 1</a>
		<a href="#fixed-tab-2" class="mdl-layout__tab">Tab 2</a>
		<a href="#fixed-tab-3" class="mdl-layout__tab">Tab 3</a>
	</div>
@endsection