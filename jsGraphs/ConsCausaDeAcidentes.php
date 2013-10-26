<?php

<script type="text / javascript">
$(function () { 
	$('#myChart').highcharts({
		chart: {
			type: 'bar'
			},
		title: {
			text: ' teste'
			},
		xAxis: {
			categories: ['Apples', 'Bananas', 'Oranges', 'laranja', 'lichia']
			},
		yAxis: {
			title: {
				text: 'Fruit eaten teste'
					}
				},
		series: [{
			name: 'Jane',
			data: [echo  "10, 20, 30, 40, 60"]
			}, {
			name: 'John',
			data: [5, 7, 3, 4, 1]
			}]
		});
	});
	</script>
    
 ?>