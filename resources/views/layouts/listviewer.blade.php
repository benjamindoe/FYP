@extends('layouts.main')
@section('content')
<div class="mdl-grid">
	<div class="mdl-layout-spacer"></div>
	<table class="mdl-data-table mdl-js-data-table @unless(isset($noSelectable) && $noSelectable) mdl-data-table--selectable @endunless mdl-shadow--2dp">
		<thead>
			@yield('thead')
		</thead>
		<tbody>
			@yield('tbody')
		</tbody>
	</table>
	<div class="mdl-layout-spacer"></div>
	@unless(isset($noAddFab) && $noAddFab)
		<a href="{{ url($url.'/add') }}" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">add</i>
		</a>
	@endunless
</div>
@endsection