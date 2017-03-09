@extends('layouts.main')
@section('content')
	<form action="{{ url($url) }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
	@endif
		{{ csrf_field() }}

		@foreach ($errors->all() as $message) {
			{{$message}}
		@endforeach

		@component('components.textfield', ['inputName' => 'legal_forename'])
			@slot('value')
				{{ $student->legal_forename or '' }}
			@endslot
			Legal Forename
		@endcomponent

		@component('components.textfield', ['inputName' => 'legal_surname'])
			@slot('value')
				{{ $student->legal_surname or '' }}
			@endslot
			Legal Surname
		@endcomponent

		@component('components.textfield', ['inputName' => 'middle_names'])
			@slot('value')
				{{ $student->middle_names or '' }}
			@endslot
			Middle Names
		@endcomponent

		@component('components.textfield', ['inputName' => 'preferred_forname'])
			@slot('value')
				{{ $student->preferred_forname or '' }}
			@endslot
			Preferred Forename
		@endcomponent

		@component('components.textfield', ['inputName' => 'preferred_surname'])
			@slot('value')
				{{ $student->preferred_surname or '' }}
			@endslot
			Preferred Surname
		@endcomponent

		@component('components.textfield', ['inputName' => 'dob', 'id' => 'dob_datepicker', 'inputClass' => 'datepicker'])
			@slot('value')
				{{ $student->dob or '' }}
			@endslot
			Date of Birth
		@endcomponent

		@component('components.gender-picker', ['inputName'=>'gender'])
		@endcomponent

		@component('components.textfield', ['inputName' => 'arrival_date', 'id' => 'arrival_date_datepicker', 'inputClass' => 'datepicker'])
			@slot('value')
				{{ $student->arrival_date or '' }}
			@endslot
			Date of Arrival
		@endcomponent

		@component('components.textfield', ['inputName' => 'year_group', 'type' => 'number'])
			@slot('value')
				{{ $student->year_group or '' }}
			@endslot
			Year Group
		@endcomponent

		@component('components.textfield', ['inputName' => 'class_form'])
			@slot('value')
				{{ $student->arrival_date or '' }}
			@endslot
			Class Form
		@endcomponent

		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection