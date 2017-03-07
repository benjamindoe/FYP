@extends('layouts.listviewer')
@section('thead')
<th class="mdl-data-table__cell--non-numeric">Form Name</th>
<th class="mdl-data-table__cell--non-numeric">Form Teachers</th>
<th class="mdl-data-table__cell--non-numeric" colspan="2">Actions</th>
@endsection
@section('tbody')
	@foreach($classes as $class)
		<tr>
			<td class="mdl-data-table__cell--non-numeric">
				{{ $class->class_form }}
			</td>
			<td class="mdl-data-table__cell--non-numeric">
				<ul>
					@foreach($class->teachers as $teacher)
						<li>{{ $teacher->forename.$teacher->surname }}</li>
					@endforeach
				</ul>
			</td>
			@component('components.listviewer-actions', ['url' => $url.'/'.$class->class_form])
		</tr>
	@endforeach
@endsection