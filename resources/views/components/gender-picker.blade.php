@component('components.dropdown', ['class' => $class ?? '', 'inputName' => $inputName, 'id' => $id ?? $inputName])
	@slot('label')
		Gender
	@endslot
	<option value="M">Male</option>
	<option value="F">Female</option>
	<option value="O">Male</option>
@endcomponent