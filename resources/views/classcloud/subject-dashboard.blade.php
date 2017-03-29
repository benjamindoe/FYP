@extends('layouts.main')
@section('content')
	<div class="mdl-grid" style="justify-content: center">
		@if(Auth::user()->staff)
			<div class="mdl-cell mdl-cell--8-col actions">
				<a href="{{ url(url()->current().'/add-resource') }}"class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
					<i class="material-icons">add</i> New Resource
				</a>
			</div>
		@endif
		@foreach($resources as $key => $resource)
			<div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp ccresource" data-opened="opened/unopened">
				<div class="mdl-card__title mdl-card--expand">
					<h2 class="mdl-card__title-text">{{ $resource->name }}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					{!! preserve_nl($resource->notes) !!}
					@if (auth()->user()->guardian || auth()->user()->student)
						@if ($resource->unopened->count())
							<i class="material-icons file-unopened">new_releases</i>
						@else
							<i class="material-icons file-unopened">done</i>
						@endif
					@endif
				</div>
				<div class="mdl-card__menu">
					@if($resource->path)
						<a href="{{ url()->current().'/'.$resource->id }}/file" target="_blank" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
							<i class="material-icons">file_download</i>
						</a>
					@endif
					@if(Auth::user()->staff)
						<button id="resource-right-menu-{{$key}}"
							class="mdl-button mdl-js-button mdl-button--icon mdl-button--top-right-menu">
							<i class="material-icons">more_vert</i>
						</button>
						<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
								for="resource-right-menu-{{$key}}">
							<li class="mdl-menu__item"><a href="{{ url()->current().'/'.$resource->id }}/edit">Edit</a></li>
							<li class="mdl-menu__item">
								<form method="POST" action="{{ url()->current().'/'.$resource->id }}">
									{{csrf_field()}}
									{{method_field('DELETE')}}
									<button>Delete</button>
								</form>
							</li>
						</ul>
					@endif
				</div>
			</div>
		@endforeach
	</div>
@endsection