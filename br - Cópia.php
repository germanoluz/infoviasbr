<?php
require ("Consulta.class.php");
$consultaBr = new Consulta;
?>
<!DOCTYPE HTML>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script>
	$(function () {
		$('#grafbr').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'Principais causas de acidentes na BR <?php echo $_POST["br_escolhida"]; ?>'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
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
	<style>
		#wrapbr {border: #CCC 1px solid; border-radius: 5px; background-color: #fff;}
		#infobr {padding:10px;}
		#outrasinfobr {padding:10px;}
		#grafbr {height: auto;}
		h1,h3,h4,h5,h6	{font-weight: 200; color: #666;	line-height: 1.2em;	font-family: 'Patua One'; text-align: left;}
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{	color: inherit;	text-decoration: none;}
		h2	{font-size: 1.7em; letter-spacing: -1px;}
		h2.br	{color: #FF9933; font-size: 1.6em !important; line-height: 1.2em; width: auto; margin: 5px; border-bottom: #FF9933 4px solid; margin-bottom: 15px;}
		h2.br strong {color: #666;}
		h3 {font-size: 0.6em; padding: 0 0 0 1.0em !important;}
		#wrapbr p.results {text-align: left !important; width:100%; display: block; padding: 0 0 0 1.5em !important; 
		color: #0099FF; text-decoration: none; outline: 0;	border: 0; position: relative; font-size: 0.7em !important; font-family: FontAwesome; font-weight: normal; 
		font-style: normal; -webkit-text-rendering: optimizeLegibility;	-moz-text-rendering: optimizeLegibility; -ms-text-rendering: optimizeLegibility; 
		-o-text-rendering: optimizeLegibility;	text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; -moz-font-smoothing: 
		antialiased; -ms-font-smoothing: antialiased;	-o-font-smoothing: antialiased;	font-smoothing: antialiased;}
		#wrapbr p span	{
						position: relative;
						display: block;
						font-size: 0.8em;
					}
					#wrapbr p span:before{
						{
							position: absolute;
							left: 0;
							color: #41484c;
							text-align: center;
							width: 1.25em;
						}
		 							
				
	</style>
</head>
	<body>
		<div class="container">
			<header><h2>Estatísticas da BR</h2></header>
				<p>Aqui você verá as estatísticas da BR consultada acima:</p>
			<div id="wrapbr">
				<h2 class="br">BR: <?php echo $_POST["br_escolhida"]; ?></h2>
					<div class="row flush">
						<div id="infobr" class="3u">
							<h3>Dia da Semana mais perigoso:</h3>
								<p class="results"><span class="icon-map-marker"><?php $consultaBr->acidDiaDaSemana($_POST["br_escolhida"]); echo $consultaBr->getDiaSemana() . " - Qtd: " . $consultaBr->getQtdDiaSemana();?></span></p>
							<h3>Trecho mais perigoso:</h3>
								<p class="results"><span class="results icon-eye-open"><?php $consultaBr->trechoMaisPerigoso($_POST["br_escolhida"]); echo "Km: " . $consultaBr->getTrecho() . " - Qtd: " . $consultaBr->getQtdTrecho(); ?></span></p>
							<h3>Hora mais perigosa:</h3>
								<p class="results"><span class="results icon-exclamation-sign"> <?php $consultaBr->OcoPorHora($_POST["br_escolhida"]); echo "Hora: " . $consultaBr->getHora() . " - Qtd: " . $consultaBr->getQtdHora(); ?></span></p>
							<h3>Veículo envolvido mais comum:</h3>
								<p class="results"><span class="results icon-ambulance"> <?php $consultaBr->tipoVeicEnv($_POST["br_escolhida"]); echo $consultaBr->getTipoVeiculo() . " - Qtd: " . $consultaBr->getQtdVeiculo(); ?></span></p>
							<h3>Acidentes por alcoolismo:</h3>
								<p class="results"><span class="results icon-glass"><?php $consultaBr->pesAlcoolizada($_POST["br_escolhida"]); echo $consultaBr->getQtdAlcoolizada(); ?></span></p>
						</div>
						<div id="grafbr" class="6u"></div>
						<div id="outrasinfobr" class="3u"></div>
					</div>
			</div>
 		</div>
	</body>
</html>
	
	
	
