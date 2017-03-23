$(function(){

	$( ".datepicker" ).each(function() {
		$(this).datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			yearRange: $(this).data('yearRange') || "-20:+10",
			onSelect: function() {
				$(this).parent().addClass('is-dirty');
			}
		});
	});
});