<button id="{{ isset($id) ? $id : '' }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent {{ isset($class) ? $class : '' }}">
	{{ $slot }}
</button>