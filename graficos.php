<?php
	require ("Consulta.php");
	$novaConsulta = new Consulta;
	$novaConsulta->ocoPorAno();
	$novaConsulta->condAlcoolAno();
	$novaConsulta->dezBrMaisPerigosas();
	$novaConsulta->tipoVeicEnv();
?>
<!DOCTYPE HTML>
<!--
	InfoviasBR - Dados abertos sobre trânsito em rodovias federais
	Copyright 2013 Equipe InfoviasBR (II Concurso de Aplicativos Abertos do MJ/W3C)
		| Germano Luz: germanoluz@hotmail.com
		| Fábio Françoso: fabio.francoso@outlook.com
		| Halaés Nobre: hs.nobre@gmail.com
		| Cássia Sousa: cassinhasousa@gmail.com
	InfoviasBR é um software livre; você pode redistribui-lo e/ou modifica-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF); na versão AGPL v.3.
    InfoviasBR é distribuido na esperança que possa ser  util, mas SEM NENHUMA GARANTIA; sem uma garantia implicita de ADEQUAÇÂO a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR.
    Veja a Licença Pública Geral GNU para maiores detalhes.
    Você deve ter recebido uma cópia da Licença Pública Geral GNU junto com este programa, se não, visite: http://www.infoviasbr.com.br/licenca
	Para obter uma cópia integral do código-fonte visite: http://github.com/germanoluz/infoviasbr
-->
<html>
	<head>
    <meta charset="iso-8859-1">
    <style>
		body {background-color:#ccc; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; color:#FFFFFF;}
		div.graf {backgound-color: #fff; border-radius: 5px; margin:20px auto; width: 95%; -moz-box-shadow: 4px 4px 4px #888;
		-webkit-box-shadow: 4px 4px 4px #888; box-shadow: 4px 4px 4px #888;}
		h2 {color:#CC6600; font-size:2.0em; margin:10px 0; width:95%;}
		p {color: #FFF;}
		p strong{font-size:0.6em; color:#999;}
		img{position:relative; top:15px; float:right; margin-right:20px;}
	</style>
		<script src="js/jquery.min.js"></script>
		<script src="js/highcharts/highcharts.js"></script>
		<script src="js/highcharts/modules/exporting.js"></script>
        <!-- GRÁFICO QTD DE ACIDENTES POR ANO -->
	<script>
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: 'QtdDeAcidentesPorAno',
            type: 'column'
        },
        title: {
            text: 'Quantidade de acidentes por ano'
        },
		 xAxis: {
                
			 tooltip: {
                pointFormat: 'BR: <b>{point.x:.1f} </b>',
            },
				categories: [<?php echo $novaConsulta->getOcoAno(); ?>],
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
                data: [<?php echo $novaConsulta->getQtdOcoAno(); ?>],
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
	   <!-- GRÁFICO QTD DE ACIDENTES POR ALCOOLISMO POR ANO -->
	<script>
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: 'QtdDeAcidentesPorAlcAno',
            type: 'column'
        },
        title: {
            text: 'Acidentes por alcoolismo/ano'
        },
		 xAxis: {
                
			 tooltip: {
                pointFormat: 'BR: <b>{point.x:.1f} </b>',
            },
				categories: [<?php echo $novaConsulta->getCondAlcAno(); ?>],
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
                data: [<?php echo $novaConsulta->getQtdCondAlcAno(); ?>],
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
	<!-- GRÁFICO 10 BRS + PERIGOSAS -->
	<script type="text/javascript">
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: '10maisPerigosas',
            type: 'bar'
        },
        title: {
            text: 'As 10 BRs mais perigosas'
        },
        xAxis: {
            categories: [<?php echo $novaConsulta->getDezBr(); ?>]
        },
        yAxis: {
            title: {
                text: 'Quantidade de ocorrências'
            }
        },
        series: [{
			name: 'Número de Ocorrências',
			data: [<?php echo $novaConsulta->getQtdDezBr(); ?>]
			},
			],
		});
	});
	</script>	
    <!-- OCORRÊNCIAS POR MÊS -->
    <script>
	$(function () {
        $('#QtdDeOcoMes').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Ocorrências por mês nos últimos anos'
            },
            
            xAxis: {
                categories: [
                    'Jan',
                    'Fev',
                    'Mar',
                    'Abr',
                    'Mai',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Set',
                    'Out',
                    'Nov',
                    'Dez'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Qtd de Ocorrências'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '2007',
                data: [<?php $novaConsulta->ocoPorMes(2007); echo $novaConsulta->getQtdOcoMes(); ?>]
    
            }, {
                name: '2008',
                data: [<?php $novaConsulta->ocoPorMes(2008); echo $novaConsulta->getQtdOcoMes(); ?>]
    
            }, {
                name: '2009',
                data: [<?php $novaConsulta->ocoPorMes(2009); echo $novaConsulta->getQtdOcoMes(); ?>]
    
            }, {
                name: '2010',
                data: [<?php $novaConsulta->ocoPorMes(2010); echo $novaConsulta->getQtdOcoMes(); ?>]
			}, {
                name: '2011',
                data: [<?php $novaConsulta->ocoPorMes(2011); echo $novaConsulta->getQtdOcoMes(); ?>]
				}, {
                name: '2012',
                data: [<?php $novaConsulta->ocoPorMes(2012); echo $novaConsulta->getQtdOcoMes(); ?>]
				}, {
                name: '2013',
                data: [<?php $novaConsulta->ocoPorMes(2013); echo $novaConsulta->getQtdOcoMes(); ?>]
    
            }]
        });
    });
	</script>
    <!-- QIDE OCORRÊNCIAS POR DIA DA SEMANA -->
    <script>
	$(function () {
        $('#QtdDeOcoDiaSemana').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Ocorrências por dia da semana nos últimos anos'
            },
            
            xAxis: {
                categories: [
                    'Seg',
                    'Ter',
                    'Qua',
                    'Qui',
                    'Sex',
                    'Sáb',
                    'Dom'
                  ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Qtd de Ocorrências'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '2007',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2007); echo $novaConsulta->getQtdDiaSemana(); ?>]
    
            }, {
                name: '2008',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2008); echo $novaConsulta->getQtdDiaSemana(); ?>]
    
            }, {
                name: '2009',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2009); echo $novaConsulta->getQtdDiaSemana(); ?>]
    
            }, {
                name: '2010',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2010); echo $novaConsulta->getQtdDiaSemana(); ?>]
			}, {
                name: '2011',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2011); echo $novaConsulta->getQtdDiaSemana(); ?>]
				}, {
                name: '2012',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2012); echo $novaConsulta->getQtdDiaSemana(); ?>]
				}, {
                name: '2013',
                data: [<?php $novaConsulta->ocoDiaDaSemana(2013); echo $novaConsulta->getQtdDiaSemana(); ?>]
    
            }]
        });
    });
	</script>
    <!-- OCORRÊNCIA POR SEXO POR ANO -->
    <script>
	$(function () {
    var chart,
        categories = ['2007', '2008', '2009', '2010', '2011', '2012', '2013'];
    $(document).ready(function() {
        $('#OcoPorSexo').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Ocorrências por sexo do condutor'
            },
            subtitle: {
                text: ''
            },
            xAxis: [{
                categories: categories,
                reversed: false
            }, { // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function(){
                        return (Math.abs(this.value) / 1000) + 'K';
                    }
                },
                min: -8000,
                max: 8000
            },
    
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
    
            tooltip: {
                formatter: function(){
                    return '<b>'+ this.series.name +', '+ this.point.category +'</b><br/>'+
                        'Qtd de ocorrências: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },
    
            series: [{
                name: 'Masculino',
                data: [<?php $novaConsulta->ocoPorSexoMasc(); echo $novaConsulta->getQtdMasc(); ?>]
            }, {
                name: 'Feminino',
                data: [<?php $novaConsulta->ocoPorSexoFem(); echo $novaConsulta->getQtdFem(); ?>],color:'#FF99CC'
            }]
        });
    });
    
});
	</script>
    <!-- GRÁFICO QTD DE VEICULOS ENVOLVIDOS POR TIPO E ANO -->
	<script>
	$(document).ready(function() {
	var chart = new Highcharts.Chart({
	    chart: {
			renderTo: 'QtdVeiculosEnvolvidos',
            type: 'column'
        },
        title: {
            text: 'Quantidade de acidentes por tipo de veículo'
        },
		 xAxis: {
                
			 tooltip: {
                pointFormat: 'BR: <b>{point.x:.1f} </b>',
            },
				categories: [<?php echo $novaConsulta->getVeiculo(); ?>],
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
                data: [<?php echo $novaConsulta->getQtdVeiculo(); ?>],
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
    <title>InfoviasBR</title>
	</head>
	<body>
		
		<!-- Main -->
		<div id="main">
			
			<!-- Gráficos -->
			<section id="portfolio" class="two">
				<div class="container">
					<header>
                    	 <img src="images/logoGr.png" />
						<h2>Gr&aacute;ficos</h2>
                        <p>Dados referentes ao período 2007-2013<strong> (No ano de 2013, dados apenas do primeiro semestre)</strong></p>
					</header>
                	<!-- DIVS DOS GRÁFICOS -->
                  	<div id="QtdDeAcidentesPorAno" class="graf"></div>
					<div id="QtdDeAcidentesPorAlcAno" class="graf"></div>
                    <div id="10maisPerigosas" class="graf"></div>
                    <div id="QtdDeOcoMes" class="graf"></div>
                    <div id="QtdDeOcoDiaSemana" class="graf"></div>
                    <div id="OcoPorSexo" class="graf"></div>
                    <div id="QtdVeiculosEnvolvidos" class="graf"></div>					
				</div>
			</section>
		
		</div>
		
		
	</body>
		
</html>