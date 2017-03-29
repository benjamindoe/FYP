@extends('layouts.main')
@section('content')
	<form action="{{ url()->current() }}" method="post">
	@if(isset($edit) && $edit)
		{{ method_field('PUT') }}
		<input type="hidden" name="id" value="{{ $staff->id }}">
	@endif
		{{ csrf_field() }}

		@component('components.textfield', ['inputName' => 'username'])
			@slot('value')
				{{ $staff->user->username or '' }}
			@endslot
			Username
		@endcomponent

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