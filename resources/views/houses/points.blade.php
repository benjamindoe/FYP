@extends('layouts.main')
@section('content')
	<style type="text/css">
		.mdl-textfield {
			display: block;
		}
	</style>
	<form action="{{ url()->current() }}" method="post">
		{{ csrf_field() }}
		@foreach ($errors->all() as $message) {
			{{$message}}
		@endforeach

		@component('components.textfield', ['inputName' => 'points', 'type' => 'number', 'required' => 'required'])
			@slot('value')
			0
			@endslot
			Points
		@endcomponent

		{{-- Loop through houses --}}
		@component('components.dropdown', ['inputName' => 'house'])
			@slot('label')
				House
			@endslot
			@foreach($houses as $house)
				<option value="{{ $house->id }}" {{ (old('house') === $house->id) ? 'selected' : '' }} >
					{{ $house->name }}
				</option>
			@endforeach
		@endcomponent
		{{-- Loop through students based on school --}}
		<div class="mdl-textfield mdl-js-textfield">
			<textarea class="mdl-textfield__input" type="text" rows= "4" id="reason" name="reason"></textarea>
			<label class="mdl-textfield__label" for="reason">Reason for point addition or deduction</label>
		</div>
		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection