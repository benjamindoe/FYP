$(function() {
    $( '#sort-list' ).sortable({
        stop: function () {
            var inputs = $('input.currentposition');
            var nbElems = inputs.length;
            $('input.currentposition').each(function(idx) {
                $(this).val(idx);
                alert($(this).val());
            });
        }
    });
});
$(function() {
    $('.chartjs').each(function() {
        var yAxis = $(this).data('chart-yaxis');
        var grades = $(this).data('chart');
        var avgGrades = $(this).data('chart-average');
        var targetGrade = yAxis.slice(0);
        targetGrade.fill($(this).data('chart-target'));
        new Chart($(this), {
            type: 'line',
            data: {
                labels: $(this).data('chart-labels'),
                datasets: [{
                    label: "Target",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#fff",
                    borderColor: "#E91E63",
                    borderCapStyle: 'butt',
                    borderJoinStyle: 'round',
                    borderDash:[15,15],
                    pointBorderColor: "#E91E63",
                    pointBackgroundColor: "#E91E63",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 1,
                    pointRadius: 3,
                    pointHitRadius: 10,
                    data: targetGrade,
                    spanGaps: true
                },
                {
                    label: "Progress",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#fff",
                    borderColor: "#FF9800",
                    boxWidth: 10,
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
                    data:grades,
                },
                {
                    label: "Year Average",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#fff",
                    borderColor: "#00E676",
                    borderCapStyle: 'butt',
                    borderJoinStyle: 'round',
                    pointBorderColor: "#00E676",
                    pointBackgroundColor: "#00E676",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 1,
                    pointRadius: 3,
                    pointHitRadius: 10,
                    data: avgGrades,
                    spanGaps: true
                }]
            },
            options: {
                responsive: true,
                layout: {
                    padding: 20
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            var label = data.labels[tooltipItem.index];
                            var yIndex = yAxis.length - parseInt(tooltipItem.yLabel) - 1; // end of array index - current y index
                            return tooltipItem.xLabel + ': ' + yAxis[yIndex];
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, values) {
                                return yAxis[index];
                            },
                            stepSize: 1,
                            min: 0,
                            max: yAxis.length - 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Grade'
                        }
                    }]
                }
            }
        }); 
    });
});