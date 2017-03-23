@extends ('layouts.base')
@section('content')
	<div class="mdl-grid">
		<div class="mdl-layout-spacer"></div>
		<div class="mdl-card mdl-card--form mdl-shadow--2dp">
			<form class="form-horizontal" role="form" method="POST" action="@yield('form-action')">
				{{ csrf_field() }}

				@yield('form-fields')
			</form>
		</div>
		<div class="mdl-layout-spacer"></div>
	</div>
@endsection