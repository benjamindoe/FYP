@extends('layouts.main')
@section('content')
<div class="mdl-grid">
	<div class="mdl-layout-spacer"></div>
	<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
		<thead>
			@yield('thead')
		</thead>
		<tbody>
			@yield('tbody')
		</tbody>
	</table>
	<div class="mdl-layout-spacer"></div>
	<a href="{{ url($url.'/add') }}" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
		<i class="material-icons">add</i>
	</a>
</div>
@endsection