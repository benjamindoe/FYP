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

		@component('components.textfield', ['inputName' => 'academic_year'])
			@slot('value')
				{{ $academicYear->academic_year or '' }}
			@endslot
			Academic Year
		@endcomponent

		@component('components.textfield', ['inputName' => 'year_start', 'id' => 'year_start_datepicker', 'inputClass' => 'datepicker'])
			@slot('value')
				{{ $academicYear->year_start or '' }}
			@endslot
			Academic Year Start
		@endcomponent

		@component('components.textfield', ['inputName' => 'year_end', 'id' => 'year_end_datepicker', 'inputClass' => 'datepicker'])
			@slot('value')
				{{ $academicYear->year_end or '' }}
			@endslot
			Academic Year End
		@endcomponent

		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection