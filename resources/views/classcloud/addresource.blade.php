@extends('layouts.main')
@section('content')
	<div class="mdl-grid">
		<div class="mdl-layout-spacer"></div>
		<form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="mdl-card mdl-shadow--2dp">
				<div class="mdl-card__supporting-text">
					@component('components.textfield', ['inputName' => 'name'])
						@slot('value')
							{{ $resource->name or '' }}
						@endslot
						Resource Name
					@endcomponent
					@component('components.dropdown', ['inputName' => 'status'])
						@slot('label')
							Resource Status
						@endslot
						@foreach(['published', 'draft'] as $status)
							<option value="{{ $status }}"
								{{ old('status') === $status || $resource->status === $status
									? 'selected'
									: '' }} >
								{{ ucfirst($status) }}
							</option>
						@endforeach
					@endcomponent
					<div class="mdl-textfield mdl-js-textfield">
				    	<textarea class="mdl-textfield__input" type="text" rows="5" id="notes" name="notes">{{ old('notes') ?? ($resource->notes ?? '') }}</textarea>
				    	<label class="mdl-textfield__label" for="notes">Notes</label>
					</div>
					<div class="mdl-js-filefield mdl-filefield">
						<input type="file" class="mdl-filefield__file" name="resource_file" data-value="New uploads will rewrite old ones">
					</div>
					@component('components.button')
						Save
					@endcomponent
				</div>
			</div>
		</form>
		<div class="mdl-layout-spacer"></div>
	</div>
@endsection
