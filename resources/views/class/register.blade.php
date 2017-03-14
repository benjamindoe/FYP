@extends('layouts.listviewer', ['noAddFab' => true, 'noSelectable' => true])
@section('thead')
	<th class="mdl-data-table__cell--non-numeric">Student</th>
	@foreach($periods as $period)
		<th class="mdl-data-table__cell--non-numeric">
			{{strtoupper($period->period)}} <i class="material-icons" id="info[{{$period->period}}]">info outline</i>
			<div class="mdl-tooltip" data-mdl-for="info[{{$period->period}}]">
				/ (AM), \ (PM), L or N. More info
				<ul>
				</ul>
			</div>

		</th>
	@endforeach
@endsection
@section('tbody')
	<form action="{{ url()->current() }}" method="POST">
		{{csrf_field()}}
		@foreach($class->students as $student)
			<tr>
				<td class="mdl-data-table__cell--non-numeric">
					{{ $student->full_name }}
				</td>
				@foreach($periods as $period)
					<td class="mdl-data-table__cell--non-numeric attendance">
						<input type="text" name="student[{{ $student->id }}][{{ $period->period }}][code]" class="attendance-code" classPeriod="{{$period->period}}" maxlength=1 
							pattern="[{{implode('|', $codes->pluck('code')->toArray())}}]{1}">
						@component('components.textfield', ['inputName' => 'student['.$student->id.']['.$period->period.'][notes]'])
						@slot('value') @endslot
							Attendance Notes
						@endcomponent
					</td>
				@endforeach
				</td>
			</tr>
		@endforeach
		<button type="submit" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">done</i>
		</button>
	</form>
@endsection