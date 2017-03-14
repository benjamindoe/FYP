@extends('layouts.listviewer')
@section('thead')
	<th class="mdl-data-table__cell--non-numeric">Full Name</th>
	<th class="mdl-data-table__cell--non-numeric">Year Group</th>
	<th class="mdl-data-table__cell--non-numeric">Class</th>
	<th class="mdl-data-table__cell--non-numeric" colspan="2">Actions</th>
@endsection
@section('tbody')
	@foreach($students as $student)
		<tr>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $student->full_name }}
			</td>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $student->year_group }}
			</td>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $student->class->class_form }}
			</td>
			@component('components.listviewer-actions', ['url' => $url.'/'.$student->id])
			@endcomponent
		</tr>
	@endforeach
@endsection