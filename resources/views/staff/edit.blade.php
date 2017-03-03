@extends('layouts.main')
@section('content')
	<form action="{{ $url }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
	@endif
		{{ csrf_field() }}

		@component('components.textfield', ['inputName' => 'username'])
			@slot('value')
				{{ $staff->user->username or '' }}
			@endslot
			Username
		@endcomponent

		@if(!isset($edit) || !$edit)
			@component('components.textfield', ['inputName' => 'password', 'type' => 'password'])
				@slot('value')
				@endslot
				Password
			@endcomponent

			@component('components.textfield', ['inputName' => 'password_confirmation', 'type' => 'password'])
				@slot('value')
				@endslot
				Confirm Password
			@endcomponent
		@endif

		@component('components.textfield', ['inputName' => 'forename'])
			@slot('disabled')
				{{ isset($edit) && $edit ? 'disabled' : '' }}
			@endslot
			@slot('value')
				{{ $staff->forename or '' }}
			@endslot
			Forename
		@endcomponent

		@component('components.textfield', ['inputName' => 'surname'])
			@slot('value')
				{{ $staff->surname or '' }}
			@endslot
			Surname
		@endcomponent

		<select name="role" id="role">
			@foreach($roles as $role)
				<option value="{{ $role->role }}">{{ $role->role }}</option>
			@endforeach
		</select>

		@foreach ($errors->all() as $message) {
			{{$message}}
		@endforeach
		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection