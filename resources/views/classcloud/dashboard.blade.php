@php
	$user = Auth::user()->student ?? (Auth::user()->guardian ?? Auth::user()->staff);
@endphp
@extends('layouts.main')
@section('content')
	<div class="mdl-grid">
		@foreach($subjects as $subject)
			<a href="{{ url(url()->current().'/'.strtolower($subject->name)) }}" class="mdl-cell mdl-cell--2-col mdl-card  mdl-shadow--2dp">
				<div class="mdl-card__title mdl-card--expand mdl-color--pink-300">
					<h2 class="mdl-card__title-text">{{ $subject->name }}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					@if(Auth::user()->student || Auth::user()->guardian)
						@php
							$unopenedCount = auth()->user()->unopenedResources()->whereHas('file', function ($query) use ($subject) {
								$query->where('subject_id', $subject->id);
							})->count();
						@endphp
						@if ($unopenedCount == 0)
							No new resources
						@else 
							{{ $unopenedCount }} Unopened {{$unopenedCount == 1 ? 'Resource' : 'Resources'}}
						@endif
					@else
						@if($subject->resources()->count() == 0)
							Nothing to show here.
						@else
							{{ $subject->resources()->count() }} {{$subject->resources()->count() == 1 ? 'Resource' : 'Resources'}}
						@endif
					@endif
				</div>
			</a>
		@endforeach
	</div>
@endsection