@extends('layouts.base')
@section('title', $title)
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
			<a class="mdl-navigation__link" href="{{ url('students') }}">Students</a> 
		@elseif(Auth::user()->staff->role == 'teacher')
			@foreach(Auth::user()->staff->classes as $class)
				<a class="mdl-navigation__link" href="{{ url('class/'.$class->class_form) }}">{{$class->class_form}}</a>
			@endforeach
				<a class="mdl-navigation__link" href="{{ url('vle') }}">VLE</a>
		@endif
	@elseif(Auth::user()->guardian)
		@foreach(Auth::user()->guardian->students as $student)
			<a class="mdl-navigation__link" href="{{ url('student/'.$student->id) }}">{{ !empty($student->preferred_forename) ? $student->preferred_forename : $student->legal_forename }}</a>
		@endforeach
		<a class="mdl-navigation__link" href="{{ url('') }}">Homework</a>
		<a class="mdl-navigation__link" href="#">Link</a>
	@else
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
		<a class="mdl-navigation__link" href="#">Link</a>
	@endif
	<a class="mdl-navigation__link" href="{{ route('logout')}}">Logout</a>
	</nav>
</div>
@endsection