<!DOCTYPE HTML>
<!--
	InfoviasBR - Dados abertos sobre tr�nsito em rodovias federais
	Copyright 2013 Equipe InfoviasBR (II Concurso de Aplicativos Abertos do MJ/W3C)
		| Germano Luz: germanoluz@hotmail.com
		| F�bio Fran�oso: fabio.francoso@outlook.com
		| Hala�s Nobre: hs.nobre@gmail.com
		| C�ssia Sousa: cassinhasousa@gmail.com
	InfoviasBR � um software livre; voc� pode redistribui-lo e/ou modifica-lo dentro dos termos da Licen�a P�blica Geral GNU como publicada pela Funda��o do Software Livre (FSF); na vers�o AGPL v.3.
    InfoviasBR � distribuido na esperan�a que possa ser  util, mas SEM NENHUMA GARANTIA; sem uma garantia implicita de ADEQUA��O a qualquer MERCADO ou APLICA��O EM PARTICULAR.
    Veja a Licen�a P�blica Geral GNU para maiores detalhes.
    Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral GNU junto com este programa, se n�o, visite: http://www.infoviasbr.com.br/licenca
	Para obter uma c�pia integral do c�digo-fonte visite: http://github.com/germanoluz/infoviasbr
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
	
    <title>InfoviasBR</title>
	</head>
	<body>
		
		<!-- Main -->
		<div id="main">
			
			<!-- Gr�ficos -->
			<section id="portfolio" class="two">
				<div class="container">
					<header>
                    	 <img src="images/logoGr.png" />
						<h2>Condi��es da Rodovia</h2>
                        <p>Fonte: Dnit (www.dnit.gov.br)</strong></p>
					</header>
                	<!-- DIVS DOS GR�FICOS -->
                  	<div id="CondVia" class="graf">
                    <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
                      <caption>
                        Condi��es da Rodovia pesquisada
                      </caption>
                      <tr>
                        <th scope="col">UF</th>
                        <th scope="col">Trecho</th>
                        <th scope="col">KM</th>
                        <th scope="col">Tr&aacute;fego</th>
                        <th scope="col">Condi&ccedil;&atilde;o</th>
                      </tr>
                      <tr>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                      </tr>
                    </table>
<!-- inserir a tabela do Dnit com as condi��es da rodovia consultada -->
                    
                    </div>
									
			  </div>
			</section>
		
		</div>
		
		
	</body>
		
</html>