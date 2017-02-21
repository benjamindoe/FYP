@extends('layouts.base')
@section('title', $title)
@section('content')
	<form action="{{ 'school/'.$url }}">
		{{ csrf_field() }}
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
			<input class="mdl-textfield__input" type="text" name="school_urn" id="school_urn" value="{{ old('school_urn', isset($school->unique_reference_number) ? 
				$school->unique_reference_number : null) }}">
			<label class="mdl-textfield__label" for="school_urn">Unique Reference Number</label>
		</div>
	</form>
@endsection