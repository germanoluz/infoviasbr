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
<html lang="pt-br">
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
		<link href="js/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
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
		<script src="js/jqvmap/jquery.vmap.js"></script>
		<script src="js/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="js/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
		<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		<script>
		$(document).ready(function() {
			$('form').live('submit', function(e){ // catch the form's submit event
				e.preventDefault();
				$.ajax({ // create an AJAX call...
					data: $(this).serialize(), // get the form data
					type: $(this).attr('method'), // GET or POST
					url: $(this).attr('action'), // the file to call
					async: true,
					dataType: "html",
					beforeSend: function(){
						$('#loading').css({display:"block"});
						},
					success: function(response) { // on success..
					$('#contentbr').html(response); // update the DIV
					$('#loading').css({display:"none"});
						$('html, body').animate({
						scrollTop: $("#contentbr").offset().top
						}, 800);
					},
					
				});
			});
			return false; // cancel original event to prevent form submitting
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
		<script>
			$(document).ready(function() {
			jQuery('#vmap').vectorMap(
			{
				map: 'world_en',
				backgroundColor: '#dadada',
				borderColor: '#818181',
				borderOpacity: 0.25,
				borderWidth: 1,
				color: '#f4f3f0',
				enableZoom: true,
				hoverColor: '#c9dfaf',
				hoverOpacity: null,
				normalizeFunction: 'linear',
				scaleColors: ['#b6d6ff', '#005ace'],
				selectedColor: '#c9dfaf',
				selectedRegion: null,
				showTooltip: true,
				onRegionClick: function(element, code, region)
				{
					var message = 'You clicked "'
						+ region 
						+ '" which has the code: '
						+ code.toUpperCase();
						 
					alert(message);
				}
			});
		});
		</script>
		<script type="text/javascript"> 
			jQuery.fn.toggleText = function(a,b) {
			return   this.html(this.html().replace(new RegExp("("+a+"|"+b+")"),function(x){return(x==a)?b:a;}));
			}
			$(document).ready(function(){
				$('.tgl').before('<a class="btrevelar">Revelar conteúdo</a>');
				$('.tgl').css('display', 'none')
				$('a', '#box-toggle').click(function() {
					$(this).next().slideToggle('slow')
					.siblings('.tgl:visible').slideToggle('fast');
				
					$(this).toggleText('Revelar','Esconder')
					.siblings('a').next('.tgl:visible').prev()
					.toggleText('Revelar','Esconder')
				});
			})
		</script>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-45496252-1']);
		  _gaq.push(['_setDomainName', 'infoviasbr.com.br']);
		  _gaq.push(['_setAllowLinker', true]);
		  _gaq.push(['_trackPageview']);
		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
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
						<img src="images/pic08.png" alt="Sobre InfoviasBR" class="image featured"/>
						<p>InfoviasBR é uma aplicação web que condensa dados oficiais sobre as ocorrências em rodovias federais (BRs), entre 2007 e 2013,
						obtidas na base de dados da Polícia Rodoviária Federal e Ministério da Justiça!</p> 
                        <div id="box-toggle">
							<div class="tgl">
								<p>Esses dados foram disponibilizados como consequencia da política de <a href="http://dados.gov.br/">dados abertos</a> do governo federal, que torna públicas informações interessantes à população. InfoviasBR é fruto do <a href="http://www.w3c.br/Home/ConcursoAplicativos">II Concurso de Aplicativos abertos MJ/W3C</a>, promovido pelas instituições mencionadas, com o apoio técnico do W3C, consórcio que desenvolve os padrões da internet. <br>
                                Muitas são as possibilidades, mas nos concentramos em 3 nichos:</p>
									<ul class="defaults">
										<li><span>Dados da BR: estatísticas sobre uma BR específica</span></li>
										<li><span>Mapas: as 10 BRs mais perigosas, localização das delegacias da PRF no país</span></li>
										<li><span>Gráficos gerais: gráficos interativos sobre o panorama geral do trânsito em BR</span></li>
									</ul>
                                <p>Utilize InfoviasBR como auxílio na escolha da rodovia por onde irá trafegar em sua próxima viagem e divirta-se!</p>
                            </div>
                        </div>
							<ul class="plataformas">
								<li><span>Esperamos que aproveitem, seja no </span></li>
								<li><img src="images/sm_ar.png" alt="Smartphone" title="Smartphone" /><span> ,</span></li>
   								<li><img src="images/dt_ar.png" alt="Desktop" title="Desktop" /></li>
                                <li><span>ou</span></li>
   								<li><img src="images/tb_ar.png" alt="Tablet" title="Tablet"/><span> !</span></li>
                                <li><span>Boa viagem :)</span></li>
							</ul>
				</div>
			</section>
            
            <!-- Busca BR -->
			<section id="top" class="one">
				<div class="container">
					<header>
						<h2>Busca de BR</h2>
					</header>
					<footer>
						<form id="envia" action="br.php" method="get" data-remote="auto-ajax" data-update="#resultado">
							<div class="row flush">
								<div class="-2u 4u"><input type="text" class="text" name="br_escolhida" placeholder="Digite o número da BR" onkeypress="return numeros(event.keyCode, event.which);" maxlength="3"/></div>
								<div class="4u"><input type="submit" id="btn" class="button submit" value="Pesquisar"></div>
							</div>
						</form>
					</footer>
				</div>
			</section>
            
			<!-- Tela de resultados da BR - irá aparecer aqui via ajax -->
			<section id="contentbr" class="two">
				<div id="loading" style="display: none;">
					<p>Carregando resultados</p>
					<img src="images/ajax-loader.gif" alt="" style="margin:0 auto;">
				</div>
			</section>
            
			<!--section id="mundo" class="five">
				<div class="container">
					<header>
						<h2>Trânsito no mundo</h2>
					</header>
				</div>
				<div id="vmap" style="width: 90%; margin:0 auto; height: 400px; border-radius:5px; background: #ccc; padding:0;"></div>
			</section-->			
            <!-- Contato -->
					<!--section id="contact" class="four">
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
					</section-->
			
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