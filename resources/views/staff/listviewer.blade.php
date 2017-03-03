@extends('layouts.main')
@section('content')
	<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
		<thead>
			<th class="mdl-data-table__cell--non-numeric">Username</th>
			<th class="mdl-data-table__cell--non-numeric">Forename</th>
			<th class="mdl-data-table__cell--non-numeric">Surname</th>
			<th class="mdl-data-table__cell--non-numeric">Role</th>
			<th class="mdl-data-table__cell--non-numeric" colspan="2">Actions</th>
		</thead>
		<tbody>
			@foreach($staff as $member)
				<tr>
					<td class="mdl-data-table__cell--non-numeric">
						{{ $member->user->username }}
					</td>
					<td class="mdl-data-table__cell--non-numeric">
						{{ $member->forename }}
					</td>
					<td class="mdl-data-table__cell--non-numeric">
						{{ $member->surname }}
					</td>
					<td class="mdl-data-table__cell--non-numeric">
						{{ $member->role }}
					</td>
					<td>
						<a href="{{ url($url.$member->id.'/edit') }}">Edit</a>
					</td>
					<td>
						<form method="POST" action="{{url($url.$member->id.'/delete')}}">
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