<?php
require ("Consulta.php");
	$consultaBr = new Consulta;
	
	$consultaBr->ocoPorUf(116); 
	echo $consultaBr->getUf();
	echo $consultaBr->getQtdUf();
?>