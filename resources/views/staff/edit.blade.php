@extends('layouts.main')
@section('content')
	<form action="{{ url()->current() }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
	@endif
		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $staff->id }}">
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

		@component('components.dropdown', ['inputName' => 'role'])
			@foreach($roles as $key => $role)
				<option value="{{ $role }}" {{ (old('role') === $role ||
						(isset($staff) && $staff->role === $role)
						? 'selected'
						: '') }}>{{ ucfirst($role) }}</option>
			@endforeach
		@endcomponent

		@foreach ($errors->all() as $message)
			{{$message}}
		@endforeach
		@component('components.button')
			Save
		@endcomponent
	</form>
@endsection