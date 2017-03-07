<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect {{ $labelClass or '' }}" for="{{ $id or '' }}">
	<input type="checkbox" id="{{ $id or '' }}" name="{{ $name or '' }}" value="{{ $value or '' }}" class="mdl-checkbox__input" />
  	<span class="mdl-checkbox__label">{{$slot}}</span>
</label>