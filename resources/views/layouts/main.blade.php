@extends('layouts.base')
@section('header-classes', 'mdl-layout--fixed-drawer')
@section('tabs', '')
@section('drawer')
<div class="mdl-layout__drawer">
	<header class="drawer-header">
		<a href="{{url('profile/'.Auth::user()->username)}}">
	</header>
	<nav class="mdl-navigation">
		<a class="mdl-navigation__link" href="/">Dashboard</a>
	@if(Auth::user()->isSuperAdmin())
		<a class="mdl-navigation__link" href="{{ url('schools') }}">Schools</a>
	@elseif(Auth::user()->staff !== null)
		@if(Auth::user()->staff->role == 'admin')
			<a class="mdl-navigation__link" href="{{ url('school') }}">School</a>
			<a class="mdl-navigation__link" href="{{ url('staff') }}">Staff</a>
			<a class="mdl-navigation__link" href="{{ url('class') }}">Classes</a>
		@elseif(Auth::user()->staff->role == 'teacher')
			<a class="mdl-navigation__link" href="{{ url('class/'.$Auth::user()->staff()->class()) }}">Class</a>
			<a class="mdl-navigation__link" href="{{ url('vle') }}">VLE</a>
		@endif
	@elseif(Auth::user()->isParent())
		<a class="mdl-navigation__link" href="{{ url('student') }}">Student</a>
		<a class="mdl-navigation__link" href="{{ url('') }}">Homework</a>
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