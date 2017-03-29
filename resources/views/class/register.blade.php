@extends('layouts.main')
@section('content')
<div class="mdl-grid" style="justify-content: center;">
	<div class="mdl-cell mdl-cell--8-col mdl-grid">
		<div class="">
			<form action="{{ url()->current() }}" method="get" class="mdl-cell mdl-cell--8-col"> 
				@component('components.textfield', ['inputName' => 'date', 'id' => 'date_datepicker', 'inputClass' => 'datepicker'])
					@slot('value')
						{{ $_GET['date'] or ''}}
					@endslot
						Register Date
				@endcomponent
				<button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised">
					Search
				</button>
			</form>
		</div>
		<div class="mdl-cell mdl-cell--4-col">
			<button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised show-modal">Show Modal</button>
  		</div>
		<dialog class="mdl-dialog">
			<div class="mdl-dialog__content">
			  <ul>
			  	@foreach($codes as $code)
			  		<li>
			  			<b>{{$code->code}}</b> -- {{$code->description}}
			  		</li>
			  	@endforeach
			  </ul>
			</div>
			<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			  <button type="button" class="mdl-button close">Close</button>
			</div>
		</dialog> 
		<script>
		    var dialog = document.querySelector('dialog');
		    var showModalButton = document.querySelector('.show-modal');
		    if (! dialog.showModal) {
		      dialogPolyfill.registerDialog(dialog);
		    }
		    showModalButton.addEventListener('click', function() {
		      dialog.showModal();
		    });
		    dialog.querySelector('.close').addEventListener('click', function() {
		      dialog.close();
		    });
		</script>
  
	</div>
	<div class="">
	<form action="{{ url()->full() }}" method="POST" autocomplete="off">
		{{csrf_field()}}
		<table class="mdl-data-table mdl-js-data-table mdl-cell mdl-cell--12-col mdl-shadow--2dp">
			<thead>
				<th class="mdl-data-table__cell--non-numeric">Student</th>
				@foreach($periods as $period)
					<th class="mdl-data-table__cell--non-numeric">
						{{strtoupper($period->period)}} <i class="material-icons" id="info[{{$period->period}}]">info outline</i>
						<div class="mdl-tooltip" data-mdl-for="info[{{$period->period}}]">
							/ (AM), \ (PM), L or N. More info
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
	</div>
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