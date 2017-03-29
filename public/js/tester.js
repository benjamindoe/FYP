$(function () {
	$('.mdl-js-filefield').find('.mdl-filefield__file').wrap('<div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file"></div>')
		.before('<i class="material-icons">attach_file</i>');
	$('.mdl-js-filefield').prepend('<input class="mdl-textfield__input mdl-filefield__text" placeholder="Reuploads will overwrite" type="text" id="uploadFile" readonly/>');
	$('.mdl-filefield__file').change(function () {
		$(this).parent().siblings('.mdl-filefield__text').val(this.files[0].name);
	});
});