@extends('layouts.base')
@section('title', 'Register')
@section('content')
<div class="mdl-grid">
	<div class="mdl-layout-spacer"></div>
	<div class="mdl-card mdl-shadow--2dp">
		<form class="" method="POST" action="{{ url('/register') }}">
			{{ csrf_field() }}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('username') ? 'is-invalid' : '' }}">
				<input class="mdl-textfield__input" id="username" type="text" name="username" value="{{ old('username') }}">
				<label class="mdl-textfield__label" for="username">Username</label>
				@if ($errors->has('username'))
					<span class="mdl-textfield__error">
						{{ $errors->first('name') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('password') ? 'is-invalid' : '' }}">
				<label class="mdl-textfield__label"  for="password">Password</label>
				<input class="mdl-textfield__input" id="password" type="password" name="password">
				@if ($errors->has('password'))
					<span class="mdl-textfield__error">
						{{ $errors->first('password') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" id="password-confirm" type="password" name="password_confirmation">
				<label class="mdl-textfield__label" for="password-confirm">Confirm Password</label>
			</div>
			<input type="hidden" name="superAdmin" value=1 >
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
				Register
			</button>
		</form>
	</div>
	<div class="mdl-layout-spacer"></div>
</div>
@endsection
