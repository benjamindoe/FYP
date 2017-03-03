@extends('layouts.main')
@section('content')
	<form action="{{ $url }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
	@endif
		{{ csrf_field() }}
		@component('components.textfield', ['inputName' => 'unique_reference_number'])
			@slot('disabled')
				{{ isset($edit) && $edit ? 'disabled' : '' }}
			@endslot
			@slot('value')
				{{ $school->unique_reference_number or '' }}
			@endslot
			Unique Reference Number
		@endcomponent

		@component('components.textfield', ['inputName' => 'la_name'])
			@slot('value')
				{{ $school->la_name or '' }}
			@endslot
			Local Authority
		@endcomponent

		@component('components.textfield', ['inputName' => 'la_number'])
			@slot('value')
				{{ $school->la_number or '' }}
			@endslot
			Local Authority Number
		@endcomponent

		@component('components.textfield', ['inputName' => 'establishment_number'])
			@slot('value')
				{{ $school->establishment_number or '' }}
			@endslot
			Establishment Number
		@endcomponent

		@component('components.textfield', ['inputName' => 'establishment_name'])
			@slot('value')
				{{ $school->establishment_name or '' }}
			@endslot
			School Name
		@endcomponent

		@component('components.textfield', ['inputName' => 'education_phase'])
			@slot('value')
				{{ $school->education_phase or '' }}
			@endslot
			Education Phase
		@endcomponent

		@component('components.textfield', ['inputName' => 'establishment_status'])
			@slot('value')
				{{ $school->establishment_status or '' }}
			@endslot
			Status
		@endcomponent
		<div class="address-lookup">
			@component('components.textfield', ['inputName' => 'postcode'])
				@slot('value')
					{{$school->address->postcode or ''}}
				@endslot
				Postcode
			@endcomponent
			@component('components.button', ['class' => 'address-lookup__btn'])
				Find Address
			@endcomponent
				@if ($errors->has('address'))
					<span class="error">
						{{ $errors->first('address') }}
					</span>
				@endif
		</div>
		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection