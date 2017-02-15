@extends('layouts.auth')
@section('title', 'Login')
@section('form-action', url('/login'))
@section('form-fields')
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
		<input class="mdl-textfield__input" id="username" type="text" name="username" value="{{ old('username') }}">
		<label class="mdl-textfield__label" for="username">Username</label>
		@if ($errors->has('username'))
			<span class="mdl-textfield__error">
				{{ $errors->first('username') }}
			</span>
		@endif
	</div>

	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('password') ? 'is-invalid' : '' }}">
		<input class="mdl-textfield__input" id="password" type="password" name="password">
		<label class="mdl-textfield__label" for="password">Password</label>
		@if ($errors->has('password'))
			<span class="mdl-textfield__error">
				{{ $errors->first('password') }}
			</span>
		@endif
	</div>

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
