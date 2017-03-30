@extends('layouts.base')
@section('header-classes', 'mdl-layout--fixed-drawer')
@section('tabs', '')
@section('drawer')
<div class="mdl-layout__drawer">
	<header class="drawer-header">
		<a href="{{url('profile/'.Auth::user()->username)}}">
	</header>
	<nav class="mdl-navigation">
		<a class="mdl-navigation__link" href="/">
			<i class="material-icons">dashboard</i> Dashboard</a>
	@if(Auth::user()->isSuperAdmin())
		<a class="mdl-navigation__link" href="{{ url('schools') }}">Schools</a>
	@elseif(Auth::user()->staff !== null)
		@if(Auth::user()->staff->role == 'admin')
			<a class="mdl-navigation__link" href="{{ url('school') }}"><i class="material-icons">&#xE7F1;</i> School</a>
			<a class="mdl-navigation__link" href="{{ url('staff') }}"><i class="material-icons">&#xE7FB;</i> Staff</a>
			<a class="mdl-navigation__link" href="{{ url('class') }}"><i class="material-icons">&#xE86E;</i> Classes</a>
			<a class="mdl-navigation__link" href="{{ url('students') }}"><i class="material-icons">&#xE80C;</i> Students</a> 
		@elseif(Auth::user()->staff->role == 'teacher')
			@foreach(Auth::user()->staff->classes as $class)
				<a class="mdl-navigation__link" href="{{ url('class/'.$class->class_form.'/register') }}"><i class="material-icons">&#xE85D;</i> {{$class->class_form}} Register</a>
				<a class="mdl-navigation__link" href="{{ url('class/'.$class->class_form.'/attainment') }}"><i class="material-icons">&#xE85C;</i> {{$class->class_form}} Attainment</a>
			@endforeach
				<a class="mdl-navigation__link" href="{{ url('classcloud') }}"><i class="material-icons">cloud_upload</i> ClassCloud</a>
		@endif
	@elseif(Auth::user()->guardian)
		@foreach(Auth::user()->guardian->students as $student)
			<a class="mdl-navigation__link" href="{{ url('student/'.$student->id) }}"><i class="material-icons">&#xE85C;</i> {{ $student->full_name }}</a>
		@endforeach
		<a class="mdl-navigation__link" href="{{ url('classcloud') }}"><i class="material-icons">cloud_download</i> ClassCloud</a>
		<a class="mdl-navigation__link" href="/"><i class="material-icons">&#xE561;</i> Dinners</a>
	@else
		<a class="mdl-navigation__link" href="{{ url('classcloud') }}"><i class="material-icons">cloud_download</i> ClassCloud</a>
	@endif
	<a class="mdl-navigation__link" href="{{ route('logout')}}"><i class="material-icons">&#xE8AC;</i> Logout</a>
	</nav>
</div>
@endsection