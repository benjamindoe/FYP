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
});