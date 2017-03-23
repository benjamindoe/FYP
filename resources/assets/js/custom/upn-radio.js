$(function() {
	$('input[type=radio][name=upn]').change(function() {
		if(this.value == 3) {
			$('.upn-generator').append(
				'<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label manual-upn-textfield">' +
					'<input class="mdl-textfield__input" type="text" pattern="[A-HJ-NP-RT-Z][0-9]{12}" name="manual-upn-textfield" id="manual-upn-textfield" value="">' +
					'<label class="mdl-textfield__label" for="manual-upn-textfield">Unique Pupil Number</label>' +
				'</div>');
		} else {
			$('.manual-upn-textfield').remove();
		}
		componentHandler.upgradeDom();
	});
});