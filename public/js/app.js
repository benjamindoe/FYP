var ADDRESS_API = 'Ku4TrIm71k28VFeejy2fGQ7568';
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

	$('.address-lookup__btn').click(function() {
		$addressLookup = $('.address-lookup');
		$addressLookup.find('#address').remove();
		$addressLookup.find('.error').remove();
		var postcode = $addressLookup.find('.mdl-textfield__input').val();
		$addressLookup.append('<span class="spinner"><i class="fa fa-circle-o-notch fa-spin-1 fa-3x fa-fw"></i><span class="sr-only">Loading...</span></spin>');
		$.get(
			'https://api.getaddress.io/v2/uk/' + postcode,
			{
				'api-key': ADDRESS_API
			}, function(data) {
				$select = $('<select id="address" name="address"></select');
				for (var i = data.Addresses.length - 1; i >= 0; i--) {
					$option = $('<option></option');
					$option.text(data.Addresses[i]);
					$select.prepend($option);
				}
				$addressLookup.append($select);
		}, 'json')
		.fail(function() {
			$addressLookup.append('<span class="error">Invalid Postcode</span>');
		})
		.always(function() {
			$addressLookup.find('.spinner').remove();
		});
		return false;
	});
});
