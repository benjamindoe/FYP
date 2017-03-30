$('.mdl-card.ccresource').click(function(){
	if($(this).hasClass('expanded'))
	{
		$(this).removeClass('expanded');
	} else
	{
		$(this).siblings('.mdl-card').removeClass('expanded');
		$(this).addClass('expanded');
		if($(this).data('opened') == 'unopened')
		{
			$.ajax({
				url: 'http://fyp.local/classcloud/5HM/Maths/'+ $(this).data('ccr-id') +'/read',
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				context: this,
			}).done(function (json) {
				if(json.success)
					$(this).find('.file-unopened').text('done');
					$(this).data('opened', 'opened');
			});
		}
	}
});