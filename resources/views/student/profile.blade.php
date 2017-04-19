@extends('layouts.main', ['title' => $student->full_name])
@section('content')
<div class="mdl-grid demo-content">
	<div class="student-attendance mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="mdl-card__title mdl-color--teal-300">
			<h2 class="mdl-card__title-text">Attendance</h2>
		</div>
		<div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
			<div class="mdl-layout-spacer"></div>
			<div class="percentage-chart student-attendance__week mdl-cell mdl-cell--4-col">
				<div class="percentage-chart__container" data-percentage="{{$attendancePercent['week']}}"></div>
				<span class="percentage-chart__label">
					Attendance this Week
				</span>
			</div>
			<div class="mdl-layout-spacer"></div>
			<div class="percentage-chart student-attendance__year mdl-cell mdl-cell--4-col">
				<div class="percentage-chart__container" data-percentage="{{$attendancePercent['year']}}"></div>
				<span class="percentage-chart__label">
					Attendance this Year
				</span>
			</div>
			<div class="mdl-layout-spacer"></div>
			<div class="percentage-chart student-attendace__month mdl-cell mdl-cell--4-col-desktop mdl-cell--12-col-tablet">
				<div class="percentage-chart__container" data-percentage="{{$attendancePercent['month']}}"></div>
				<span class="percentage-chart__label">
					Attendance this Month
				</span>
			</div>
		</div>
	</div>
	<div class="student-attainment mdl-shadow--2dp mdl-card mdl-cell mdl-cell--8-col mdl-tabs mdl-js-tabs">
		<div class="mdl-card__title mdl-color--teal-300">
			<h2 class="mdl-card__title-text">Grades</h2>
		</div>
		<div class="mdl-tabs__tab-bar mdl-card__supporting-text mdl-card--expand">
			@foreach($attainment['student']->pluck('subject.name')->unique() as $key => $subject)
				<a href="#{{$subject}}-panel" class="mdl-tabs__tab @unless($key != 0) is-active @endunless ">{{$subject}}</a>
			@endforeach
		</div>
		@foreach($attainment['student']->pluck('subject.name')->unique() as $key => $subject)
			<div class="mdl-tabs__panel @unless($key != 0) is-active @endunless " id="{{$subject}}-panel">
				<canvas
					style="width:300px; height: 200px"
					class="chartjs" id="attainment-chart-{{$subject}}"
					data-chart-yaxis='{{ $attainment['grades'] }}'
					data-chart-labels='{{ $attainment['periods'] }}'
					data-chart="{{ $attainment['student']->where('subject.name', $subject)->pluck('attainmentGrade.precedence')->toJson() }}"
					data-chart-average="{{ $attainment['averages']->where('subject.name', $subject)->pluck('attainmentGrade.precedence')->toJson() }}"
					data-chart-target="{{$attainment['target']->where('subject.name', $subject)->pluck('attainmentGrade.precedence')->first()}}"
				></canvas>
			</div>
		@endforeach
	</div>
	<div class="mdl-cell mdl-cell--4-col-deskptop mdl-cell--12-col-tablet mdl-card">
		<div class="mdl-card__title mdl-color--teal-300">
			<h2 class="mdl-card__title-text">Student Info</h2>
		</div>
		<div class="mdl-card__supporting-text mdl-card--expand mdl-color-text--grey-600">
		<p>Date of Birth: {{ $student->dob }}</p>
		<p>Class: {{ $student->class->class_form }}</p>
		<p>Year Group: {{ $student->yearGroup->group }}</p>
		<p>Key Stage: {{ $student->yearGroup->keystage }}</p>
		</div>
	</div>
</div>
@endsection