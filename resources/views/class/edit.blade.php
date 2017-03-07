@extends('layouts.main')
@section('header-classes', 'mdl-layout--fixed-tabs mdl-layout--fixed-drawer')
@section('tabs')
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
		<a href="#fixed-tab-1" class="mdl-layout__tab is-active">Class Info</a>
		<a href="#fixed-tab-2" class="mdl-layout__tab">Teachers</a>
		<a href="#fixed-tab-3" class="mdl-layout__tab">Students</a>
	</div>
@endsection
@section('content')
	<form action="{{ url($url) }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
	@endif
		{{ csrf_field() }}
	<section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
		@component('components.textfield', ['inputName' => 'class_form'])
			@slot('value')
				{{ $class->class_form or '' }}
			@endslot
			Form Name
		@endcomponent
	</section>
	<section class="mdl-layout__tab-panel" id="fixed-tab-2">
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
	<section class="mdl-layout__tab-panel" id="fixed-tab-3">
		<table>
			<thead>
				<th>Name</th>
				<th>Year</th>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr><td>{{ $student->forename.' '.$student->surname }}</td></tr>
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