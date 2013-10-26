<?php
require ("Consulta.class.php");
$consultaBr = new Consulta;
?>

<script>
	$(function () {
		$('#grafbr').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'Dados estatísticos da BR <?php echo $_POST["br"]; ?>'
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
		
	<style>
		#wrapbr {border: #CCC 1px solid; border-radius: 5px; background-color: #fff;}
		#infobr {padding:10px;}
		#grafbr {padding:10px;}
		h1,h3,h4,h5,h6	{font-weight: 200; color: #666;	line-height: 1.2em;	font-family: 'Patua One'; text-align: left;}
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{	color: inherit;	text-decoration: none;}
		h2	{font-size: 1.7em; letter-spacing: -1px;}
		h2.br	{color: #FF9933; font-size: 1.6em !important; line-height: 1.2em; width: auto; margin: 5px; border-bottom: #FF9933 4px solid; margin-bottom: 15px;}
		h2.br strong {color: #666;}
		h3 {font-size: 0.6em; padding: 0 0 0 1.0em !important;}
		span.results {text-align: left !important; width:100%; display: block; padding: 0 0 0 2.0em !important; color: #666; text-decoration: none; outline: 0;	border: 0; position: relative; font-size: 0.7em !important; font-family: FontAwesome; font-weight: normal; font-style: normal; -webkit-text-rendering: optimizeLegibility;	-moz-text-rendering: optimizeLegibility; -ms-text-rendering: optimizeLegibility; -o-text-rendering: optimizeLegibility;	text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; -moz-font-smoothing: antialiased; -ms-font-smoothing: antialiased;	-o-font-smoothing: antialiased;	font-smoothing: antialiased;}
	</style>
	<div id="wrapbr">
		<!-- Abaixo, a variável primeiro está armazenando a BR digitada via post -->
		<h2 class="br">BR: <?php echo $_POST["primeiro"]; ?></h2>
		<div class="row half">
			<div id="infobr" class="4u">
				<h3>Estados por onde passa:</h3><!-- Abaixo, os CAMPOS onde serão printados os dados das consultas -->
					<span class="results icon-map-marker"><!-- Resultado da consulta dos estados --></span>
				<h3>Trecho mais perigoso:</h3>
					<span class="results icon-eye-open"> <?php $consultaBr->trechoMaisPerigoso($_POST["br"]); echo "Km: " . $consultaBr->getTrecho() . ", Qtd de acidentes: " . $consultaBr->getQtdTrecho(); ?></span>
				<h3>Principal causa de acidente:</h3>
					<span class="results icon-exclamation-sign"> <?php $consultaBr->causasDeOco($_POST["br"]); echo $consultaBr->getCausa() . ": " . $consultaBr->getQtdCausa(); ?></span>
				<h3>Veículo envolvido mais comum:</h3>
					<span class="results icon-ambulance"><?php $consultaBr->tipoVeicEnv($_POST["br"]); echo $consultaBr->getTipoVeiculo() . ": " . $consultaBr->getQtdVeiculo(); ?></span>
				<h3>Acidentes por alcoolismo:</h3>
					<span class="results icon-glass"><?php $consultaBr->pesAlcoolizada($_POST["br"]); echo $consultaBr->getQtdAlcoolizada(); ?></span>
			</div>
			<div id="grafbr" class="8u"></div>
			<hr>
			
		</div>
	</div>