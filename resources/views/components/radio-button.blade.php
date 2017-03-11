<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect radio--upn {{$class or ''}}" for="{{ $id or $inputName.$value}}">
	<input type="radio" id="{{ $id or $inputName.$value}}" class="mdl-radio__button" name="{{ $inputName }}" value="{{ $value }}" {{$checked or ''}}>
	<span class="mdl-radio__label">{{$slot}}</span>
</label>