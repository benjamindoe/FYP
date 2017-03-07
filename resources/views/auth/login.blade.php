@extends('layouts.auth')
@section('title', 'Login')
@section('form-action', url('/login'))
@section('form-fields')
	@component('components.textfield', ['inputName' => 'username'])
		@slot('value')
		@endslot
		Username
	@endcomponent

	@component('components.textfield', ['inputName' => 'password', 'type'=>'password'])
		@slot('value')
		@endslot
		Password
	@endcomponent

	<label for="remember" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
		<input class="mdl-checkbox__input" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
		<span class="mdl-checkbox__label">Remember Me</span>
	</label>
	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
		Login
	</button>

	<a class="btn btn-link" href="{{ url('/password/reset') }}">
		Forgot Your Password?
	</a>
@endsection
