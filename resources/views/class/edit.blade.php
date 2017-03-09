@extends('layouts.main')
@section('header-classes', 'mdl-layout--fixed-tabs mdl-layout--fixed-drawer')
@section('tabs')
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
		<a href="#class-info-tab" class="mdl-layout__tab is-active">Class Info</a>
		<a href="#teachers-tab" class="mdl-layout__tab">Teachers</a>
		<a href="#students-tab" class="mdl-layout__tab">Students</a>
	</div>
@endsection
@section('content')
	<form action="{{ url($url) }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
	@endif
		{{ csrf_field() }}
	<section class="mdl-layout__tab-panel is-active" id="class-info-tab">
		@component('components.textfield', ['inputName' => 'class_form'])
			@slot('value')
				{{ $class->class_form or '' }}
			@endslot
			Form Name
		@endcomponent
		@component('components.dropdown', ['inputName' => 'academic_year'])
			@slot('label')
				Academic Year
			@endslot

			@foreach($_ENV['school']->academicYears as $year)
				<option value="{{ $year->id }}" {{ (old('academic_year') == $year->id ? 'selected':'') }}> {{ $year->academic_year }} </option>
			@endforeach

		@endcomponent
	</section>
	<section class="mdl-layout__tab-panel" id="teachers-tab">
		<table class="mdl-data-table mdl-shadow--2dp">
			<thead>
				<th>
					@component('components.checkbox', ['labelClass' => 'mdl-data-table__select', 'id' => 'table-header']) @endcomponent
				</th>
				<th class="mdl-data-table__cell--non-numeric">Name</th>
				<th class="mdl-data-table__cell--non-numeric">Role</th>
			</thead>
			<tbody>
				@foreach($teachers as $i => $teacher)
					<tr>
						<td>
							@component('components.checkbox', ['labelClass' => 'mdl-data-table__select', 'id' => 'teachers['.$i.']', 'name'=>'teachers[]' ,'value' => $teacher->id]) @endcomponent
						</td>
						<td class="mdl-data-table__cell--non-numeric">{{ $teacher->forename.' '.$teacher->surname }}</td>
						<td class="mdl-data-table__cell--non-numeric">{{ ucfirst($teacher->role) }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</section>
	<section class="mdl-layout__tab-panel" id="students-tab">
		<table>
			<thead>
				<th>
					@component('components.checkbox', ['labelClass' => 'mdl-data-table__select', 'id' => 'table-header']) @endcomponent
				</th>
				<th class="mdl-data-table__cell--non-numeric">Name</th>
				<th class="mdl-data-table__cell--non-numeric">Year</th>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr>
						<td>
							@component('components.checkbox', ['labelClass' => 'mdl-data-table__select', 'id' => 'students['.$i.']', 'name'=>'students[]' ,'value' => $teacher->id]) @endcomponent
						</td>
						<td class="mdl-data-table__cell--non-numeric">{{ $student->forename.' '.$student->surname }}</td>
						<td class="mdl-data-table__cell--non-numeric">{{ $student->year_group }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</section>
		@foreach ($errors->all() as $message) {
			{{$message}}
		@endforeach
		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection