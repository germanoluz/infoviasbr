<!DOCTYPE html>
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
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<style>
		body {background-color:#ccc; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
		div.graf {backgound-color: #fff; border-radius: 5px; margin:20px auto; width: 90%; -moz-box-shadow: 4px 4px 4px #888;
		-webkit-box-shadow: 4px 4px 4px #888; box-shadow: 4px 4px 4px #888; height:500px;}
		h2 {color:#CC6600; font-size:2.0em; margin:10px 0; width:95%;}
		h3 {color:#666; font-size:1.2em; margin:10px 30px; width:95%;}
		span.text {color: #FFF;}
		span.text strong{font-size:0.6em; color:#999;}
		img{position:relative; top:15px; float:right; margin-right:20px;}
	</style>
	<title>InfoviasBR</title>
	<body>
	<!-- Mapas Gerais-->
		<header>
			<img src="images/logoGr.png" />
			<h2>Mapas</h2>
            <span class="text">Dados referentes ao período 2007-2013<strong> (No ano de 2013, dados apenas do primeiro semestre)</strong></span>
		</header>
        <!-- DIVS DOS MAPAS: MAPA DE DELEGACIAS DA PRF NO BRASIL -->
        <h3>Delegacias da PRF no Brasil</h3>
		<div id="mapa" class="graf"></div>
		
	<!-- Jquery -->
	<script src="js/jquery.min.js"></script>
	<!-- Maps API Javascript -->
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <!-- Caixa de informação -->
    <script src="js/infobox.js"></script>
	<!-- Agrupamento dos marcadores -->
	<script src="js/markerclusterer.js"></script>
    <!-- Arquivo de inicialização do mapa de delegacias -->
	<script src="js/mapa.js"></script>
	<!-- Arquivo de inicialização do mapa 2 -->
	<!--script src="js/brmapa.js"></script-->
	</body>
</html>
