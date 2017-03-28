$(function() {
	$('.address-lookup__btn').click(function() {
		$addressLookup = $('.address-lookup');
		$addressLookup.find('#address').remove();
		$addressLookup.find('.error').remove();
		var postcode = $addressLookup.find('.mdl-textfield__input').val();
		$addressLookup.find('.spinner').addClass('is-active');
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
			$addressLookup.find('.spinner').removeClass('is-active');
		});
		return false;
	});
});