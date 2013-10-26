<?php
require ("Consulta.php");
$consultaBr = new Consulta;
$consultaBr->ocoPorUf($_POST["br_escolhida"]);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<!--
<script>		
	$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#grafbr').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
               text: 'Principais causas de acidentes na BR <!--?php echo $_POST["br_escolhida"]; ?>'
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
					<!--?php echo $consultaBr->causasDeOco($_POST["br_escolhida"]); ?>				
				]
			}]
        });
    });
    
});
</script>
-->
<script>
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: 'grafbr',
            type: 'column'
        },
        title: {
            text: 'Quantidade de acidentes por ano'
        },
		 xAxis: {
                
			 tooltip: {
                pointFormat: 'BR: <b>{point.x:.1f} </b>',
            },
				categories: [<?php echo $consultaBr->getUf(); ?>],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Trebuchet MS'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Quantidade de acidentes'
                }
            },
            legend: {
                enabled: true
            },
            tooltip: {
                pointFormat: 'Número de acidentes: <b>{point.y:.1f} </b>',
            },
            series: [{
                name: 'Quantidade de acidentes',
                data: [<?php echo $consultaBr->getQtdUf(); ?>],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Trebuchet MS',
                        }
                }
            }]
        });
    });
	</script>
	<style>
		#wrapbr {border: #CCC 1px solid; border-radius: 5px; background-color: #fff;}
		#infobr {padding:10px;}
		#outrasinfobr {padding-right:20px;}
		#grafbr {height: auto;}
		h1,h4,h5,h6	{font-weight: 200; color: #666;	line-height: 1.2em;	font-family: 'Patua One'; text-align: left;}
		h2	{font-size: 1.7em; letter-spacing: -1px;}
		h2.br	{color: #FF9933; font-size: 1.6em !important; line-height: 1.2em; width: auto; margin: 5px; border-bottom: #FF9933 4px solid; margin-bottom: 15px;}
		h2.br strong {color: #666;}
		
		h3.chamada {
				font-family: 'FontAwesome'; 
				font-weight: normal;
				font-size: 0.7em; 
				color: #ccc;
				line-height: 2.5em;
				padding: 0 0 0 1.0em !important; 
				text-align: left !important; 
				width:100%; 
				display: block; 
				}
		p.results {
				font-family: 'Patua One';
				font-weight: normal; 
				font-size: 0.6em;
				color: #0099FF;
				line-height: 0.9em;
				padding: 0 0 0 1.5em !important; 
				text-align: left; 
				width:100%; 
				display: block; 
				text-decoration: none; outline: 0;	border: 0;}
		p.recado {width: 70%; text-align:right; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-size:10px; color:#999; line-height:90%;  margin-left:25%;}
		div.capacete{background:url(images/capacete.jpg) top right no-repeat;}
		div.morte{background:url(images/morte.jpg) top right no-repeat;}
		div.embriaguez{background:url(images/embriaguez.jpg) top right no-repeat;}
		div.cinto{background:url(images/cinto.jpg) top right no-repeat;}
		
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
							<h3 class="chamada icon-map-marker">Dia da Semana mais perigoso:</h3>
								<p class="results"><?php $consultaBr->acidDiaSemana($_POST["br_escolhida"]); echo $consultaBr->getAcdDia() . ": " . $consultaBr->getQtdAcdDia(); ?></p>
							<h3 class="chamada icon-eye-open">Trecho mais perigoso:</h3>
								<p class="results"><?php $consultaBr->trechoMaisPerigoso($_POST["br_escolhida"]); echo "Km: " . $consultaBr->getTrecho() . " - Qtd: " . $consultaBr->getQtdTrecho(); ?></p>
							<h3 class="chamada icon-exclamation-sign">Hora mais perigosa:</h3>
								<p class="results"><?php $consultaBr->OcoPorHora($_POST["br_escolhida"]); ?></p>
							<h3 class="chamada icon-ambulance">Acidentes com não-habilitados: </h3>
								<p class="results"><?php $consultaBr->condNaoHabil($_POST["br_escolhida"]); ?></p>
						</div>
                        
						<div id="grafbr" class="6u"></div>
						
                        <div id="outrasinfobr" class="3u">
                        	<p class="recado">Todas as informações obtidas nas bases de dados abertos da PRF/MJ. 
                            Somatório do Período 2007-2013 (do ano de 2013 consta apenas o 1º semestre)</p>
                            
                            <div class="capacete">
                            	<h3 class="chamada">Condutor sem capacete</h3>
                                <p class="results"><?php $consultaBr->pesSemCapacete($_POST["br_escolhida"]); ?></p>
                            </div>
                            <div  class="morte">
                              	<h3 class="chamada">Acidentes com morte</h3>
                                <p class="results"> <?php $consultaBr->acidComMorte($_POST["br_escolhida"]); ?></p>
                            </div>
                            <div class="embriaguez">
                              	<h3 class="chamada">Acidentes por embriaguez</h3>
                            	<p class="results"> <?php $consultaBr->pesAlcoolizada($_POST["br_escolhida"]); ?></p>
                            </div>
                            <div class="cinto">
                              	<h3 class="chamada">Envolvidos sem o cinto</h3>
                            	<p class="results"> <?php $consultaBr->semCinto($_POST["br_escolhida"]); ?></p>
                            </div>                     
                        </div>
                        <!--div id="porEstado" class="12u">
                        
                        </div-->
					</div>
			</div>
 		</div>
	</body>
</html>
	
	
