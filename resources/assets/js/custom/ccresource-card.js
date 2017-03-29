$('.mdl-card.ccresource').click(function(){
	if($(this).hasClass('expanded'))
	{
		$(this).removeClass('expanded');
	} else {
		$(this).siblings('.mdl-card').removeClass('expanded');
		$(this).addClass('expanded');
		$.ajax({
			url: 'http://fyp.local/classcloud/5HM/Maths/10/read',
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	}
});