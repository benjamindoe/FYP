@extends('layouts.listviewer')
@section('thead')
	<th class="mdl-data-table__cell--non-numeric">Username</th>
	<th class="mdl-data-table__cell--non-numeric">Forename</th>
	<th class="mdl-data-table__cell--non-numeric">Surname</th>
	<th class="mdl-data-table__cell--non-numeric">Role</th>
	<th class="mdl-data-table__cell--non-numeric" colspan="2">Actions</th>
@endsection
@section('tbody')
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
				{{ ucfirst($member->role) }}
			</td>
			@component('components.listviewer-actions', ['url' => $url.'/'.$member->user->username])
			@endcomponent
		</tr>
	@endforeach
@endsection