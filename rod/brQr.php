<?php
// Consultas estatísticas da BR
require_once ("../Consulta.php");
$consultaBr = new Consulta;
$consultaBr->ocoPorUf($_GET["br_escolhida"]);
// Consultas dados do Dnit
require_once("../ConsultaDnit.php");
$class = new ConsultaDnit();
$consulta = $class->selecionaDados($_GET["br_escolhida"]);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<title>InfoviasBR</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="robots" content="all" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<noscript>
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/estilo.css" />
			<link href="css/fontello.css" type="text/css" rel="stylesheet">
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<!--[if lte IE 8]><script src="../js/html5shiv.js"></script><![endif]-->
		<script src="../js/skel.min.js"></script>
		
		<script src="../js/init.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script>
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: 'grafbr',
            type: 'column'
        },
        title: {
            text: 'Acidentes por UF onde passa a BR: <?php echo $_GET["br_escolhida"]; ?>'
        },
		 xAxis: {
                
			 tooltip: {
                pointFormat: 'BR: <b>{point.x:.1f} </b>',
            },
				categories: [<?php echo $consultaBr->getUf(); ?>],
                labels: {
                    rotation: 0,
                    align: 'right',
                    style: {
                        fontSize: '12px',
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
                name: 'Número de acidentes por estado',
                data: [<?php echo $consultaBr->getQtdUf(); ?>],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Trebuchet MS',
                        }
                }
            }]
        });
    });
	</script>
	<style>
		#wrapbr {border-radius: 5px; background-color: #fff; -moz-box-shadow: 4px 4px 4px #888; -webkit-box-shadow: 4px 4px 4px #888; box-shadow: 4px 4px 4px #888;}
		#infobr {padding:10px;}
		#outrasinfobr {padding-right:20px;}
		#grafbr {height: auto;}
		h1,h4,h5,h6	{font-weight: 200; color: #666;	line-height: 1.2em;	font-family: 'Patua One'; text-align: left;}
		h2.gbr	{font-size: 1.5em; letter-spacing: -1px;}
		h2.br	{color: #FF9933; font-size: 1.2em !important; line-height: 1.2em; width: auto; margin: 5px; border-bottom: #FF9933 4px solid; margin-bottom: 15px;}
		h2.br strong {color: #666;}
		h3.chamada {
				font-family: 'FontAwesome'; 
				font-weight: normal;
				font-size: 0.7em; 
				color: #666;
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
		div.capacete{background:url(../images/capacete.jpg) top right no-repeat;}
		div.morte{background:url(../images/morte.jpg) top right no-repeat;}
		div.embriaguez{background:url(../images/embriaguez.jpg) top right no-repeat;}
		div.cinto{background:url(../images/cinto.jpg) top right no-repeat;}
		body {background-color:#ccc; padding:20px;}
		div.graf {backgound-color: #fff; border-radius: 5px; margin:20px auto; width: 95%; -moz-box-shadow: 4px 4px 4px #888;
		-webkit-box-shadow: 4px 4px 4px #888; box-shadow: 4px 4px 4px #888;}
		h2 {color:#CC6600; font-size:2.0em; margin:10px 0; width:95%;}
		p {color: #FFF;}
		p.dnittexto {color: #666; margin:0 auto; text-align:center;}
		p strong{font-size:0.6em; color:#999;}
		img{position:relative; top:15px; float:right; margin-right:20px;}
	</style>
    </head>
    <body>
		<section id="contentbr" class="two">
		<div class="container">
			<img src="../images/logoGr.png" />
            <header><h2 class="gbr">Informa&ccedil;&otilde;es sobre a BR-<?php echo $_GET["br_escolhida"]; ?></h2></header>
            <p>Voc&ecirc; chegou aqui ao consultar um QRCode numa placa da BR-<?php echo $_GET["br_escolhida"]; ?>. Veja os resultados:</p>
			<div id="wrapbr">
				<h2 class="br">Estat&iacute;sticas da rodovia</h2>
					<div class="row flush">
						<div id="infobr" class="3u">
							<h3 class="chamada icon-map-marker">Dia da Semana mais perigoso:</h3>
								<p class="results"><?php $consultaBr->acidDiaSemana($_GET["br_escolhida"]); echo $consultaBr->getAcdDia() . ": " . $consultaBr->getQtdAcdDia(); ?></p>
							<h3 class="chamada icon-eye-open">Trecho mais perigoso:</h3>
								<p class="results"><?php $consultaBr->trechoMaisPerigoso($_GET["br_escolhida"]); echo "Km: " . $consultaBr->getTrecho() . " - Qtd: " . $consultaBr->getQtdTrecho(); ?></p>
							<h3 class="chamada icon-exclamation-sign">Hora mais perigosa:</h3>
								<p class="results"><?php $consultaBr->OcoPorHora($_GET["br_escolhida"]); ?></p>
							<h3 class="chamada icon-ambulance">Acidentes com n&atilde;o-habilitados: </h3>
								<p class="results"><?php $consultaBr->condNaoHabil($_GET["br_escolhida"]); ?></p>
						</div>
						<div id="grafbr" class="6u"></div>
                        <div id="outrasinfobr" class="3u">
                        	<p class="recado">Todas as informa&ccedil;&otilde;es obtidas nas bases de dados abertos da PRF/MJ. 
                            Somat&oacute;rio do Per&iacute;odo 2007-2013 (do ano de 2013 consta apenas o 1&ordm; semestre)</p>
                            <div class="capacete">
                            	<h3 class="chamada">Condutor sem capacete</h3>
                                <p class="results"><?php $consultaBr->pesSemCapacete($_GET["br_escolhida"]); ?></p>
                            </div>
                            <div  class="morte">
                              	<h3 class="chamada">Acidentes com morte</h3>
                                <p class="results"> <?php $consultaBr->acidComMorte($_GET["br_escolhida"]); ?></p>
                            </div>
                            <div class="embriaguez">
                              	<h3 class="chamada">Acidentes por embriaguez</h3>
                            	<p class="results"> <?php $consultaBr->pesAlcoolizada($_GET["br_escolhida"]); ?></p>
                            </div>
                            <div class="cinto">
                              	<h3 class="chamada">Envolvidos sem o cinto</h3>
                            	<p class="results"> <?php $consultaBr->semCinto($_GET["br_escolhida"]); ?></p>
                            </div>                     
                        </div>
					</div>
				<h2 class="br">Condi&ccedil;&otilde;es da via</h2>
					<div class="row flush">
						<div id="dnit">
							<!-- AQUI VAI ENTRAR AS INFORMAÇÕES DO DNIT SOBRE A BR EM QUESTÃO -->
							<p class="dnittexto">Dados oficiais coletados no site do DNIT (http://www.dnit.gov.br)</p>
								<div class="default">
								<table class="default">
									<tr>
										<td>UF</td>
										<td >Trecho</td>
										<td>KM</td>
										<td>Tr&aacute;fego</td>
										<td>Condi&ccedil;&atilde;o</td>
									</tr>
									<?php
										$i=0;
										$o=1;
										for($i=0;$i<=$o;$i++){
											if(empty($consulta['uf'.$i])){
												$o = $i;	
												}else{
											$o++;	
									?>
									<tr>
										<td><?php echo $consulta['uf'.$i]; ?></td>
										<td><?php echo $consulta['trecho'.$i]; ?></td>
										<td><?php echo $consulta['km'.$i]; ?></td>
										<td><?php echo $consulta['trafego'.$i]; ?></td>
										<td><?php echo $consulta['condicao'.$i]; ?></td>
									</tr>
									<?php } } ?>
								</table>
								</div>
                       </div>
					</div>
			</div>
 		</div>
		</section>
      </body>
   </html>