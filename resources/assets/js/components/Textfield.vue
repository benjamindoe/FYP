<template>
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		<input class="mdl-textfield__input" v-bind:name="name" v-bind:value="value" v-bind:type="type">
		<label class="mdl-textfield__label">
			<slot></slot>
		</label>
		<span class="mdl-textfield__error" v-if="error !== null">
			{{ error }}
		</span>
	</div>
</template>
<script>
    export default {
        props: ['name', 'value', 'inputClass', 'type'],
        data: function () {
            return {
            };
        }
    }
</script>