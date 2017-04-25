<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has($inputName) ? 'is-invalid' : '' }} {{ $class or '' }}">
	<input class="mdl-textfield__input {{ $inputClass or '' }}" type="{{ $type or 'text' }}" {{ isset($pattern) ? 'pattern="'.$pattern.'"' : '' }} name="{{ $inputName }}" id="{{ $id or $inputName }}" value="{{ old($inputName, $value) }}" {{ $disabled or '' }} {{ $required or '' }}>
	<label class="mdl-textfield__label" for="{{ $id or $inputName }}">{{ $slot }}</label>
	@if ($errors->has($inputName))
		<span class="mdl-textfield__error">
			{{ $errors->first($inputName) }}
		</span>
	@endif
</div>