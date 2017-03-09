@extends('layouts.listviewer')
@section('thead')
	<th class="mdl-data-table__cell--non-numeric">Academic Year</th>
	<th class="mdl-data-table__cell--non-numeric">Year Start</th>
	<th class="mdl-data-table__cell--non-numeric">Year End</th>
	<th class="mdl-data-table__cell--non-numeric" colspan="2">Actions</th>
@endsection
@section('tbody')
	@foreach($academicYears as $year)
		<tr>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $year->academic_year }}
			</td>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $year->year_start->format('d-m-Y') }}
			</td>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $year->year_end->format('d-m-Y') }}
			</td>
			@component('components.listviewer-actions', ['url' => $url.'/'.$year->id])
			@endcomponent
		</tr>
	@endforeach
@endsection