@extends('layouts.main')
@section('content')
<div class="mdl-grid">
	<div class="mdl-layout-spacer"></div>
	<form action="{{ url()->full() }}" method="POST" autocomplete="off">
		{{csrf_field()}}
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
			<thead>
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
			</thead>
			<tbody>
				@foreach($class->students as $student)
					<tr>
						<td class="mdl-data-table__cell--non-numeric">
							<a href="{{ url('student/'.$student->id) }}">{{ $student->full_name }}</a>
						</td>
						@foreach($periods as $period)
							@php //setting the value
								$componentVal = $student->attendance->where('period', $period->period)->first();
								$code = $componentVal->code ?? null;
								$notes = $componentVal->notes ?? null;
							@endphp
							<td class="mdl-data-table__cell--non-numeric attendance">
								<input
									id="student-{{$student->id}}"
									type="text"
									name="student[{{ $student->id }}][{{ $period->period }}][code]"
									class="attendance-code"
									classPeriod="{{$period->period}}"
									maxlength=1 
									pattern="[{{implode('|', $codes->pluck('code')->toArray())}}]{1}" 
									value="{{$code}}" >
								@component('components.textfield', ['inputName' => 'student['.$student->id.']['.$period->period.'][notes]'])
								@slot('value')
									{{ $notes }}
								@endslot
									Attendance Notes
								@endcomponent
							</td>
						@endforeach
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<button type="submit" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">done</i>
		</button>
	</form>
	<div class="mdl-layout-spacer"></div>
</div>
@if(isset($toastMessage))
	<div id="register-toaster" class="mdl-js-snackbar mdl-snackbar" data-message="{{$toastMessage}}">
		<div class="mdl-snackbar__text"></div>
		<button class="mdl-snackbar__action" type="button"></button>
	</div>
	<script>
		$(function() {
			var snackbar = document.querySelector('#register-toaster');
			var data = {
				message: snackbar.dataset.message,
			};
			snackbar.MaterialSnackbar.showSnackbar(data);
		});
	</script>
@endif
<script>
	$(document).ready(function () {
		startScanning();
	});
</script>
@endsection