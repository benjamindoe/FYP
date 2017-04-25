@extends('layouts.main')
@section('content')
<style type="text/css">
	.circle {
		border-radius: 50%;
		min-width: 200px;
		height: 200px; 
		text-align: center;
		line-height: 200px;
		font-size: 40px;
		margin: 0 auto;
		/* width and height can be anything, as long as they're equal */
	}
</style>
<div class="mdl-grid" style="justify-content: center">
	@foreach($houses as $house)
		<div class="student-attendance mdl-card mdl-shadow--2dp mdl-cell">
			<div class="mdl-card__title mdl-color--teal-300">
				<h2 class="mdl-card__title-text">{{ $house->name }}</h2>
			</div>
			<div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
				<div class="circle" style="background-color: {{ $house->primary_colour }}; border: 10px solid {{ $house->secondary_colour }}"> {{ $house->points }} </div>
			</div>
		</div>
	@endforeach
</div>
@endsection