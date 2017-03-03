@extends('layouts.main')
@section('content')
	<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
		<thead>
			<th>Unique Ref No.</th>
			<th class="mdl-data-table__cell--non-numeric">School Name</th>
			<th class="mdl-data-table__cell--non-numeric" colspan="2">Actions</th>
		</thead>
		<tbody>
			@foreach($schools as $school)
				<tr>
					<td>
						{{ $school->unique_reference_number }}
					</td>
					<td class="mdl-data-table__cell--non-numeric">
						{{ $school->establishment_name }}
					</td>
					<td>
						<a href="{{ url('/schools/'.$school->unique_reference_number.'/edit') }}">Edit</a>
					</td>
					<td>
						<form method="POST" action="{{url('/schools/'.$school->unique_reference_number.'/delete')}}">
							{{csrf_field()}}
							{{method_field('DELETE')}}
							<button>Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection