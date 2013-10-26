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
		<title>InfoviasBR</title>
		<meta charset="utf-8">
		<meta name="robots" content="all" />
		<meta name="description" content="InfoviasBR é um site de informações e dados sobre trânsito em rodovias federais, trata-se de uma aplicação que faz uso da base oficial de ocorrências em BRs, do Ministério da Justiça e Polícia Rodoviária Federal e condensa essas informações em gráficos interativos" />
		<meta name="keywords" content="Trânsito, BR, BRs, Ocorrência em BR, dados abertos, acidentes, causas de acidentes em BR, rodovias federais, gráficos interativos, infovias, infoviasbr, concurso de aplicativos abertos, tráfego, rodovias federais" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico" />
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/estilo.css" />
			<!--link href="css/fontello.css" type="text/css" rel="stylesheet"-->
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="js/auto_ajax.js"></script>
		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
		<!-- Add fancyBox -->
		<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".various").fancybox({
					maxWidth	: 1024,
					maxHeight	: 768,
					fitToView	: false,
					width		: '90%',
					height		: '90%',
					autoSize	: false,
					closeClick	: false,
					openEffect	: 'none',
					closeEffect	: 'none'
				});
			});
		</script>
        <!-- Script para acompanhamento do Google Analytics -->
        <script>
  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  			ga('create', 'UA-45177448-1', 'infoviasbr.com.br');
  			ga('send', 'pageview');
		</script>
        	
		<script>
			$(function(){
				jQuery("#enviabr").submit(function(){
					jQuery.ajax({
						beforeSend: function(){
							$('#loading').css({display:"block"});
						},
						complete: function(msg){
							$('#loading').css({display:"none"});
							$('html, body').animate({
							scrollTop: $("#contentbr").offset().top
							}, 1000);
						}
					});
					
				});
			});
		</script>
		<script>
            // Valida se é só numeros            
            function numeros(ie, ff) {
                if (ie) {
                    tecla = ie;
                } else {
                    tecla = ff;
                }
				if ((tecla >= 48 && tecla <= 57) || (tecla == 8) || (tecla == 13) || (tecla == 9) || (tecla == 46)) {
            		return true;
            	}
            	else {
            		alert('Digite somente números');
					return false;
            	}
            }
		</script>
      
      </head>
	<body>
		<!-- Menus -->
		<div id="header" class="skel-panels-fixed">
			<div class="top">
				<!-- Logo -->
				<div id="logo">
					<a href="#sobre" id="top-link" class="skel-panels-ignoreHref"><img src="images/logo.png" alt=""></a>
					<span class="byline">[dados.ocorrências.trânsito]</span>
				</div>
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="#top" id="top-link" class="skel-panels-ignoreHref"><span class="icon icon-search">Busca de BR</span></a></li>
						<!--li><a href="#contentbr" id="estats-link" class="skel-panels-ignoreHref"><span class="icon icon-truck">Estatísticas</span></a></li-->
						<li><a class="various" data-fancybox-type="iframe" href="graficos.php" id="grafs-link" class="skel-panels-ignoreHref"><span class="icon icon-bar-chart">Gráficos</span></a></li>
						<li><a class="various" data-fancybox-type="iframe" href="gerais.php" id="mapss-link" class="skel-panels-ignoreHref"><span class="icon icon-map-marker">Mapas</span></a></li>
						<li><a href="#sobre" id="about-link" class="skel-panels-ignoreHref"><span class="icon icon-info-sign">Sobre InfoviasBR</span></a></li>
						<!--li><a href="#contact" id="contact-link" class="skel-panels-ignoreHref"><span class="icon icon-envelope">Contate-nos</span></a></li-->
					</ul>
				</nav>
			</div>
			<div class="bottom">
				<!-- Redes Sociais -->
				<ul class="icons">
					<li><a href="https://www.facebook.com/pages/Infovias-BR/1407523856146480?ref=ts&fref=ts" class="icon icon-facebook"><span>Facebook</span></a></li>
					<li><a href="https://github.com/germanoluz/infoviasbr" class="icon icon-github"><span>Github</span></a></li>
				</ul>
			</div>
		</div>
	<!-- Main -->
		<div id="main">
			
            <!-- Sobre -->
			<section id="sobre" class="three">
				<div class="container">
					<header>
						<h2>Sobre o InfoviasBR</h2>
					</header>
						<img src="images/pic08.png" alt="Sobre InfoviasBR" class="image featured"/></a>
						<p>Aplicação web que condensa dados oficiais sobre as ocorrências em rodovias federais (BRs), entre 2007 e 2013,
						obtidas na base de dados da Polícia Rodoviária Federal e Ministério da Justiça, disponibilizados como consequencia da política 
						de <a href="http://dados.gov.br/">dados abertos</a> do governo federal, que torna públicas informações interessantes à população. 
						InfoviasBR é fruto do <a href="http://www.w3c.br/Home/ConcursoAplicativos">II Concurso de Aplicativos 
						abertos MJ/W3C</a>, promovido pelas instituições mencionadas, com o apoio técnico do W3C, consórcio que desenvolve os padrões da 
						internet. Muitas são as possibilidades, mas nos concentramos em 3 nichos:</p>
							<ul class="defaults">
								<li><span>Dados da BR: estatísticas sobre uma BR específica</span></li>
								<li><span>Mapas: as 10 BRs mais perigosas, localização das delegacias da PRF no país</span></li>
								<li><span>Gráficos gerais: gráficos interativos sobre o panorama geral do trânsito em BR</span></li>
							</ul>
						<p>Esperamos que aproveitem, seja no desktop, smartphone ou tablet!</p>
				</div>
			</section>
            
            <!-- Busca BR -->
			<section id="top" class="one">
				<div class="container">
					<header>
						<h2>Busca de BR</h2>
					</header>
					<footer>
						<form id="enviabr" method="post" data-remote="auto-ajax" data-update="#contentbr" action="br.php" >
							<div class="row">
								<div class="8u"><input type="text" class="text" name="br_escolhida" placeholder="Digite o número da BR" onkeypress="return numeros(event.keyCode, event.which);" maxlength="3"/></div>
								<div class="4u"><input type="submit" id="btn" class="button submit" value="Pesquisar"></div>
							</div>
						</form>
					</footer>
				</div>
			</section>
            
			<!-- Tela de resultados da BR - irá aparecer aqui via ajax -->
			<section id="contentbr" class="two">
				<div id="loading" style="display: none;">Carregando resultados  <img src="images/ajax-loader.gif" alt=""></div>
			</section>
            
            <!-- Contato -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Contate-nos</h2>
							</header>

							<form method="post" action="#">
								<div class="row half">
									<div class="6u"><input type="text" class="text" name="name" placeholder="Name" /></div>
									<div class="6u"><input type="text" class="text" name="email" placeholder="Email" /></div>
								</div>
								<div class="row half">
									<div class="12u">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="12u">
										<a href="#" class="button submit">Enviar</a>
									</div>
								</div>
							</form>

						</div>
					</section>
			
		</div>
		<!-- Footer -->
		<div id="footer">
			<!-- Copyright -->
			<div class="copyright">
				<ul class="menu">
					<li>Aplicação desenvolvida pela Equipe Infovias BR</li>
					<li>II Concurso de aplicativos Abertos do MJ/W3C</li>
				</ul>
				<ul class="menu">
					<li>Licença: <a class="various" data-fancybox-type="iframe" href="licenca.html"><img src="images/agplv3.png" alt="GNU AGPLV3" class="lic"></a></li>
				</ul>
				<ul class="menu">
					<li>Veja também : </li>
					<li><a href="http://dados.gov.br/">dadosabertos.gov.br</a></li>
					<li><a href="http://www.justica.gov.br/">MJ</a></li>
					<li><a href="http://www.dprf.gov.br/">PRF</a></li>
					<li><a href="http://www.w3c.br/">W3C</a></li>
				</ul>
			</div>
		</div>
		
	</body>
	
</html>