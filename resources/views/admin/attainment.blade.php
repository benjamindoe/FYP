@extends('layouts.main')
@section('header-classes', 'mdl-layout--fixed-tabs mdl-layout--fixed-drawer')
@section('tabs')
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect">
		<a href="#period-tab" class="mdl-layout__tab is-active">Periods</a>
		<a href="#grades-tab" class="mdl-layout__tab">Grades</a>
	</div>
@endsection
@section('content')
	<script>
		$( function() {
			$( '#period-table tbody' ).sortable({
				stop: function () {
					var inputs = $('input.currentposition');
					var nbElems = inputs.length;
					$('input.currentposition').each(function(index) {
						$(this).val(index);
					});
				}
			});
			//Add new row
			
		});
	</script>

	{{-- Period Tab --}}
	<section class="mdl-layout__tab-panel is-active" id="period-tab">
		<div class="mdl-grid">
			<div class="mdl-layout-spacer"></div>
			<form action="{{ url()->full() }}" method="POST">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="period-table">
					<thead>
						<th></th>
						<th>
							Period Name
						</th>
						<th id="milestone_thead">
							Milestone
						</th>
						<div class="mdl-tooltip" data-mdl-for="milestone_thead"> The date that this needs to be filled by. Stats won't include this data until after this date. </div>
						<th>
							Description
						</th>
					</thead>
					<tbody>
						@if(isset($periods))
							@foreach($periods as $period)
								<tr>
									<td style="cursor: move;">
										<i class="material-icons">&#xE5D2;</i>
										<input type="hidden" name="" class="currentposition" value="0">
									</td>
									<td>
										@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][name]'])
											@slot('value') 1 @endslot
										@endcomponent
									</td>
									<td>
										@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][milestone]', 'inputClass' => 'datepicker'])
											@slot('value') @endslot
										@endcomponent
									</td>
									<td>
										@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][description]'])
											@slot('value') @endslot
										@endcomponent
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				<button type="submit" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
					<i class="material-icons">&#xE8CE;</i>
				</button>
			</form>
		</div>
	</section>

	{{-- Grades Tab --}}
	<section class="mdl-layout__tab-panel" id="grades-tab">
		<div class="mdl-grid">
			<spacer></spacer>
			<form>
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="period-table">
					<thead>
						<th></th>
						<th>
							Grade
						</th>
						<th>
							Description
						</th>
					</thead>
					<tbody>
				@if(isset($grades))
					@foreach($grades as $grade)
						<tr>
							<td style="cursor: move;">
								<i class="material-icons">&#xE5D2;</i>
								<input type="hidden" name="period['.'1'.']['.'1'.'][precendence]" class="currentposition" value="{{ $grade->precendence }}">
							</td>
							<td>
								@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][name]'])
									@slot('value') 1 @endslot
								@endcomponent
							</td>
							<td>
								@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][milestone]', 'inputClass' => 'datepicker'])
									@slot('value') @endslot
								@endcomponent
							</td>
						</tr>
					@endforeach
				@endif
				<tr>
					<td style="cursor: move;">
						<i class="material-icons">&#xE5D2;</i>
						<input type="hidden" name="" class="currentposition" value="0">
					</td>
					<td>
						<textfield name="period['.'1'.']['.'1'.'][name]" value="1">This is a field</textfield>
					</td>
					<td>
						@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][milestone]', 'inputClass' => 'datepicker'])
							@slot('value') @endslot
						@endcomponent
					</td>
				</tr>
				<tr>
					<td style="cursor: move;">
						<i class="material-icons">&#xE5D2;</i>
						<input type="hidden" name="" class="currentposition" value="1">
					</td>
					<td>
						@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][name]'])
							@slot('value') @endslot
						@endcomponent
					</td>
					<td>
						@component('components.textfield', ['inputName' => 'period['.'1'.']['.'1'.'][milestone]', 'inputClass' => 'datepicker'])
							@slot('value') @endslot
						@endcomponent
					</td>
				</tr>
					</tbody>
				</table>
				<button type="submit" class="fab--add mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
					<i class="material-icons">&#xE862;</i>
				</button>
			</form>
		</div>
	</section>
@endsection