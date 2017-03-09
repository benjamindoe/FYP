		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $class or '' }} {{ $errors->has($inputName) ? 'is-invalid' : '' }} ">
			<select class="mdl-textfield__input" name="{{ $inputName }}" id="{{ $id or $inputName }}" {{ $disabled or '' }}>
				{{$slot}}
			</select>
			<label class="mdl-textfield__label">{{ $label or ''}}</label>
		</div>