<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script>
	$(function () {
		$('#grafico').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'Dados estatísticos da BR <!--?php echo $_POST["br_escolhida"]; ?-->'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'Percentual do total: ',
				data: [
					['Embriaguez',   45.0],
					['Imperícia',       26.8],
					['Defeitos na via',    8.5],
					['Animais na via',     6.2],
					['Outros',   13,5]
				]
			}]
		});
	});
</script>
<div id="grafico" class="6u"></div>