@extends('layouts.base')
@section ('fixed-drawer-class', 'mdl-layout--fixed-drawer')
@section('drawer')
<div class="mdl-layout__drawer">
	<header class="drawer-header">
		<a href="{{url('profile/'.Auth::user()->username)}}">
	</header>
	<nav class="mdl-navigation">
		<a class="mdl-navigation__link" href="/">Dashboard</a>
	@if(Auth::user()->isSuperAdmin())
		<a class="mdl-navigation__link" href="{{ url('schools') }}">Schools</a>
	@elseif(Auth::user()->isStaff())
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
	@elseif(Auth::user()->isParent())
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
	@else
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
	@endif
	</nav>
</div>
@endsection