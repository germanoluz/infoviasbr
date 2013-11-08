<?php header("Content-Type: text/html;  charset=ISO-8859-1",true); ?>
<?php
require_once ("Consulta.php");
require_once("ValidacaoBr.php");
require_once("ConsultaDnit.php");
$br = new ValidacaoBr;
	if($br->validaBr($_GET["br_escolhida"]) == true){
		$brEscolhida = $_GET["br_escolhida"];
	}else{
		echo "BR não existe: " . $br->getBr();
		die();
	}
// Consultas estatísticas da BR
$consultaBr = new Consulta;
$consultaBr->ocoPorUf($brEscolhida);
// Consultas dados do Dnit
$class = new ConsultaDnit();
$consulta = $class->selecionaDados($brEscolhida);
?>

<script>
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: 'grafbr',
            type: 'column'
        },
        title: {
            text: 'Acidentes por UF onde passa a BR: <?php echo $brEscolhida; ?>'
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
	<script type="text/javascript"> 
		jQuery.fn.toggleText2 = function(a2,b2) {
		return   this.html(this.html().replace(new RegExp("("+a2+"|"+b2+")"),function(x2){return(x2==a2)?b2:a2;}));
		}
		$(document).ready(function(){
			$('.tgl2').before('<a class="btrevelar">Revelar condições dos trechos da BR</a>');
			$('.tgl2').css('display', 'none')
			$('a', '#box-toggle2').click(function() {
				$(this).next().slideToggle('slow')
				.siblings('.tgl2:visible').slideToggle('fast');
				$(this).toggleText('Revelar','Esconder')
				.siblings('a').next('.tgl2:visible').prev()
				.toggleText('Revelar','Esconder')
			});
		})
	</script>
	<style>
		#wrapbr {border-radius: 5px; background-color: #fff; -moz-box-shadow: 4px 4px 4px #888; -webkit-box-shadow: 4px 4px 4px #888; box-shadow: 4px 4px 4px #888;}
		#dnit {border-radius: 5px; background-color: #fff; -moz-box-shadow: 4px 4px 4px #888; -webkit-box-shadow: 4px 4px 4px #888; box-shadow: 4px 4px 4px #888;}
		#infobr {padding:10px;}
		#outrasinfobr {padding-right:20px;}
		#grafbr {height: auto;}
		h1,h4,h5,h6	{font-weight: 200; color: #666;	line-height: 1.2em;	font-family: 'Patua One'; text-align: left;}
		h2	{font-size: 1.7em; letter-spacing: -1px;}
		h2.br	{color: #FF9933; font-size: 1.3em !important; line-height: 1.2em; width: auto; margin: 5px; border-bottom: #FF9933 4px solid; margin-bottom: 15px;}
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
		div.capacete{background:url(images/capacete.jpg) top right no-repeat;}
		div.morte{background:url(images/morte.jpg) top right no-repeat;}
		div.embriaguez{background:url(images/embriaguez.jpg) top right no-repeat;}
		div.cinto{background:url(images/cinto.jpg) top right no-repeat;}
	</style>
	
		<div class="container">
			<header><h2>BR-<?php echo $brEscolhida; ?></h2></header>
			<div id="wrapbr">
				<h2 class="br">Estat&iacute;sticas</h2>
					<div class="row flush">
						<div id="infobr" class="3u">
							<h3 class="chamada icon-map-marker">Dia da Semana mais perigoso:</h3>
								<p class="results"><?php $consultaBr->acidDiaSemana($brEscolhida); echo $consultaBr->getAcdDia() . ": " . $consultaBr->getQtdAcdDia(); ?></p>
							<h3 class="chamada icon-eye-open">Trecho mais perigoso:</h3>
								<p class="results"><?php $consultaBr->trechoMaisPerigoso($brEscolhida); echo "Km: " . $consultaBr->getTrecho() . " - Qtd: " . $consultaBr->getQtdTrecho(); ?></p>
							<h3 class="chamada icon-exclamation-sign">Hora mais perigosa:</h3>
								<p class="results"><?php $consultaBr->OcoPorHora($brEscolhida); ?></p>
							<h3 class="chamada icon-ambulance">Acidentes com n&atilde;o-habilitados: </h3>
								<p class="results"><?php $consultaBr->condNaoHabil($brEscolhida); ?></p>
						</div>
						<div id="grafbr" class="6u"></div>
						<div id="outrasinfobr" class="3u">
							<p class="recado">Todas as informa&ccedil;&otilde;es obtidas nas bases de dados abertos da PRF/MJ. 
							Somat&oacute;rio do Per&iacute;odo 2007-2013 (do ano de 2013 consta apenas o 1&ordm; semestre)</p>
							<div class="capacete">
								<h3 class="chamada">Condutor sem capacete</h3>
                                <p class="results"><?php $consultaBr->pesSemCapacete($brEscolhida); ?></p>
                            </div>
                            <div  class="morte">
                              	<h3 class="chamada">Acidentes com morte</h3>
                                <p class="results"> <?php $consultaBr->acidComMorte($brEscolhida); ?></p>
                            </div>
                            <div class="embriaguez">
                              	<h3 class="chamada">Acidentes por embriaguez</h3>
                            	<p class="results"> <?php $consultaBr->pesAlcoolizada($brEscolhida); ?></p>
                            </div>
                            <div class="cinto">
                              	<h3 class="chamada">Envolvidos sem o cinto</h3>
                            	<p class="results"> <?php $consultaBr->semCinto($brEscolhida); ?></p>
                            </div>                     
                        </div>
					</div>

				<div id="box-toggle2">
					<div class="tgl2">
					<!-- AQUI VAI ENTRAR AS INFORMAÇÕES DO DNIT SOBRE A BR EM QUESTÃO -->
                	<h2 class="br">Condi&ccedil;&otilde;es da via por trecho</h2>
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
                           </div><!-- fechando a div dnit -->
                        </div><!-- fechando a div row flush -->
                    </div>
                 </div>
              </div><!-- fechando a div wrapbr -->
         </div><!-- fechando a div container -->
            </div>
