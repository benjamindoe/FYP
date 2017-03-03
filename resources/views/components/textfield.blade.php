<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has($inputName) ? 'is-invalid' : '' }} {{ $class or '' }}">
	<input class="mdl-textfield__input" type="{{ $type or 'text' }}" name="{{ $inputName }}" id="{{ $inputName }}" value="{{ old($inputName, $value) }}" {{ $disabled or '' }}>
	<label class="mdl-textfield__label" for="{{ $inputName }}">{{ $slot }}</label>
	@if ($errors->has($inputName))
		<span class="mdl-textfield__error">
			{{ $errors->first($inputName) }}
		</span>
	@endif
</div>