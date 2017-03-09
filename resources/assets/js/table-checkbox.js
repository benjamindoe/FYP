$(function() {
	$boxes = $('table tbody .mdl-data-table__select');
	$('thead .mdl-data-table__select input').change(function() {
		if(this.checked) {
			$boxes.each(function() {
				this.MaterialCheckbox.check();
			});
		} else {
			$boxes.each(function() {
				this.MaterialCheckbox.uncheck();
			});
		}
	});
	$( ".datepicker" ).each(function() {
		$(this).datepicker({
			dateFormat: 'dd M yy',
			changeMonth: true,
			changeYear: true,
			onSelect: function() {
				$(this).parent().addClass('is-dirty');
			}
		});
	});
});