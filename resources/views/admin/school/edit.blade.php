@extends('layouts.main')
@section('title', $title)
@section('content')
	<form action="{{ $url }}">
		{{ csrf_field() }}

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="text" name="school_urn" id="school_urn" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="school_urn">Unique Reference Number</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="text" name="la_name" id="la_name" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="la_name">Local Authority Name</label>

		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="number" name="la_number" id="la_number" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="la_number">Local Authority Number</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="number" name="establishment_number" id="establishment_number" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="establishment_number">Establishment Number</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="number" name="establishment_name" id="establishment_name" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="establishment_name">School Name</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="number" name="education_phase" id="education_phase" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="education_phase">Education Phase</label>
		</div>

		@component('components.button')
			Save
		@endcomponent

		<i class="fa fa-circle-o-notch fa-spin-1 fa-3x fa-fw"></i>
		<span class="sr-only">Loading...</span>
	</form>
@endsection