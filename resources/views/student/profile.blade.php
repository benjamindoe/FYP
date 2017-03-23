@extends('layouts.main', ['title' => $student->full_name])
@section('content')
<div class="mdl-grid demo-content">
	<div class="student-attendance mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
		<div class="mdl-layout-spacer"></div>
		<div class="percentage-chart" style="text-align: center;">
			<div class="percentage-chart__container" data-percentage="{{$attendanceWeek}}" style="width: 200px; height: 200px; position:relative;"></div>
			<span class="percentage-chart__label">
				Attendance this Week
			</span>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="percentage-chart" style="text-align: center;">
			<div class="percentage-chart__container" data-percentage="{{$attendanceYear}}" style="width: 200px; height: 200px; position:relative;"></div>
			<span class="percentage-chart__label">
				Attendance this Year
			</span>
		</div>
		<div class="mdl-layout-spacer"></div>
		<div class="percentage-chart" style="text-align: center;">
			<div class="percentage-chart__container" data-percentage="{{$attendanceMonth}}" style="width: 200px; height: 200px; position:relative;"></div>
			<span class="percentage-chart__label">
				Attendance this Month
			</span>
		</div>
		<div class="mdl-layout-spacer"></div>
	</div>
	<div class="student-attainment mdl-shadow--2dp mdl-card mdl-cell mdl-cell--8-col">
		<canvas style="width:400px; height: 300px;" class="chartjs" id="attainment-chart" data-chart-label="['Aug', 'Sept', 'Oct', 'Nov', 'Dec', 'Jan']" data-chart="[1,2,3,4,5,6]"></canvas>
	</div>
	<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
		<div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
			<div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
				<h2 class="mdl-card__title-text">Updates</h2>
			</div>
			<div class="mdl-card__supporting-text mdl-color-text--grey-600">
				Non dolore elit adipisicing ea reprehenderit consectetur culpa.
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Read More</a>
			</div>
		</div>
		<div class="demo-separator mdl-cell--1-col"></div>
		<div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
			<div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
				<h3>View options</h3>
				<ul>
					<li>
						<label for="chkbox1" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
							<input type="checkbox" id="chkbox1" class="mdl-checkbox__input">
							<span class="mdl-checkbox__label">Click per object</span>
						</label>
					</li>
					<li>
						<label for="chkbox2" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
							<input type="checkbox" id="chkbox2" class="mdl-checkbox__input">
							<span class="mdl-checkbox__label">Views per object</span>
						</label>
					</li>
					<li>
						<label for="chkbox3" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
							<input type="checkbox" id="chkbox3" class="mdl-checkbox__input">
							<span class="mdl-checkbox__label">Objects selected</span>
						</label>
					</li>
					<li>
						<label for="chkbox4" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
							<input type="checkbox" id="chkbox4" class="mdl-checkbox__input">
							<span class="mdl-checkbox__label">Objects viewed</span>
						</label>
					</li>
				</ul>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-grey-50">Change location</a>
				<div class="mdl-layout-spacer"></div>
				<i class="material-icons">location_on</i>
			</div>
		</div>
	</div>
</div>
@endsection