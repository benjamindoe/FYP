$(function() {
	$('.percentage-chart__container').each(function () {
		var bar = new ProgressBar.Circle(this, {
			// This has to be the same size as the maximum width to
			// prevent clipping
			strokeWidth: 6,
			trailWidth: 6,
			trailColor: '#EDE7F6',
			easing: 'easeInOut',
			duration: 1400,
			color: '#6200EA',
			// Set default step function for all animate calls
			step: function(state, circle) {
				// circle.path.setAttribute('stroke-width', state.width);

				var value = Math.round(circle.value() * 100);
				if (value === 0) {
					circle.setText('0%');
				} else {
					circle.setText(value+'%');
				}
				if(value < 80)
				{
					circle.path.setAttribute('stroke', '#F44336');
				} else if(value < 90)
				{
					circle.path.setAttribute('stroke', '#FF9800');
				} else
				{
					circle.path.setAttribute('stroke', '#8BC34A');
				}

			}
		});
		bar.text.style.fontSize = '4rem';
		bar.text.style.color = '#666';
		bar.animate($(this).data('percentage'));  // Number from 0.0 to 1.0
	});
});