@extends('layouts.main')
@section('content')
	<ul class="mdl-list">
		@foreach($subjects as $subject)
			<li class="mdl-list__item">
				<a href="{{ url()->current().'/'.$subject->name }}"> {{ $subject->name }} </a>
			</li>
		@endforeach
	</ul>
@endsection