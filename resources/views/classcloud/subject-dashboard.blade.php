@extends('layouts.main')
@section('content')
	<div class="mdl-grid" style="justify-content: center">
		<div class="mdl-cell mdl-cell--8-col actions">
			<a class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
				<i class="material-icons">add</i> New Resource
			</a>
		</div>
		@foreach($resources as $resource)
			<a href="{{ url('') }}" class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title mdl-card--expand">
					<h2 class="mdl-card__title-text">{{ $resource->name }}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					
				</div>
			</a>
		@endforeach
	</div>
@endsection