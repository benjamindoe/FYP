$(function() {
	$('.chartjs').each(function() {
		new Chart($(this), {
			type: 'line',
			data: {
				labels: $(this).data('chart-labels'),
				datasets: [
					{
						label: "My First dataset",
						fill: false,
						lineTension: 0,
						backgroundColor: "#FFF",
						borderColor: "#FF9800",
						borderCapStyle: 'butt',
						borderJoinStyle: 'round',
						pointBorderColor: "#FF9800",
						pointBackgroundColor: "#FF9800",
						pointBorderWidth: 1,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(75,192,192,1)",
						pointHoverBorderColor: "rgba(220,220,220,1)",
						pointHoverBorderWidth: 1,
						pointRadius: 3,
						pointHitRadius: 10,
						data: $(this).data('chart'),
						spanGaps: false,
					}
				]
			},
			options: {
				layout: {
					padding: 20
				}
			}
		});	
	});
});