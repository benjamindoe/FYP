@extends('layouts.main')
@section('header-classes', 'mdl-layout--fixed-tabs mdl-layout--fixed-drawer')
@section('tabs')
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
		@foreach($subjects as $subject)
			<a href="{{strtolower($subject->name)}}" class="mdl-layout__tab @if($subject->name == $curSubject->name) is-active @endif">{{$subject->name}}</a>
		@endforeach
	</div>
@endsection
@section('content')
	@if(isset($toastMessage))
		<div id="register-toaster" class="mdl-js-snackbar mdl-snackbar" data-message="{{ $toastMessage }}">
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
	<style>
		.mdl-data-table__cell--non-numeric.static-headcol {
			position: absolute;
			top: auto;
			left: 0;
			z-index: 999;
			background: white;
			width: 160px;
			border-right: 1px solid rgba(0,0,0,0.12);
			padding-top: 14px;
			text-overflow: ellipsis;
			overflow: hidden;
			
		}
		td.mdl-data-table__cell--non-numeric.static-headcol {
			height: 49px;
		}
		.scrolling-table {
			position: static;
			margin-left: 159px;
		}
		.scrolling-table__form {
			width: 100%;
		}
		.scrolling-table__wrapper {
			position: relative;
		}
		.scrolling-table__scroller {
			max-width: 100%;
			overflow-x: auto;
		}
	</style>
	<div class="mdl-grid">
		<div class="mdl-layout-spacer"></div>
		<form action="{{ url()->current() }}" class="scrolling-table__form" method="POST">
			{{csrf_field()}}
			<div class="scrolling-table__wrapper">
			<div class="scrolling-table__scroller">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp scrolling-table">
				<thead>
					<th class="mdl-data-table__cell--non-numeric static-headcol">Student</th>
					<th class="mdl-data-table__cell--non-numeric">Target</th>
					@foreach($periods as $period)
						<th class="mdl-data-table__cell--non-numeric" id="info[{{$period->id}}]">
							{{ $period->name }}
							<div class="mdl-tooltip" data-mdl-for="info[{{$period->id}}]">
								{{ $period->milestone }}
							</div>
						</th>
					@endforeach
				</thead>
				<tbody>
					@foreach($class->students as $student)
						<tr>
							<td class="mdl-data-table__cell--non-numeric static-headcol">
								<a href="{{ url('student/'.$student->id) }}"> {{ $student->full_name }} </a>
							</td>
							<td class="mdl-data-table__cell--non-numeric">
								<select name="student[{{ $student->id }}][target]" class="attainment-grade">
									<option value="">----------</option>
									@php
										$target = $student->attainmentTargets->first()->grade ?? null;
									@endphp
									@foreach($grades as $grade)
										<option value="{{$grade->id}}" @if($target == $grade->id) selected @endif >{{$grade->code}}</option>
									@endforeach
								</select>
							</td>
							@foreach($periods as $period)
								@php //setting the value
									$componentVal = $student->attainment->where('period', $period->id)->first();
									$studGrade = $componentVal->grade ?? null;
								@endphp
								<td class="mdl-data-table__cell--non-numeric attainment">
									<select name="student[{{ $student->id }}][{{ $period->id }}][grade]" class="attainment-grade" attainmentPeriod="{{$period->id}}">
										<option value="">----------</option>
										@foreach($grades as $grade)
											<option value="{{$grade->id}}" @if($studGrade == $grade->id) selected @endif >{{$grade->code}}</option>
										@endforeach
									</select>
								</td>
							@endforeach
							</td>
						</tr>
					@endforeach
				</tbody>
				</table>
			</div>
			</div>
			<button type="submit" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
				<i class="material-icons">done</i>
			</button>
		</form>
	</div>
@endsection