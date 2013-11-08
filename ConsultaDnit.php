<?php
//inclui o script de conexão com o banco
require_once ("ConexaoSingleton.php");

class ConsultaDnit{
	
	private static $consulta = array();
	
	public function selecionaDados($br){
		
		$mysql = ConexaoSingleton::getInstancia();

       	$result = $mysql->sql_query("SELECT UF, Trecho, Km, Trafego, Condicao FROM condicoesbr WHERE BR = $br"); 
		
		if($result){
			$i = 0;
			$objeto = new ArrayObject();
			while($row = mysql_fetch_assoc($result)){
				$objeto['uf'. $i]       = $row['UF'];
				$objeto['trecho'. $i]   = $row['Trecho'];
				$objeto['km'. $i]       = $row['Km'];
				$objeto['trafego'. $i]       = $row['Trafego'];
				$objeto['condicao'. $i] = $row['Condicao'];		
				$i++;
			}
			return (object) $objeto;
		}else{
			return false;
		}	
		
		
	}
    
     
}
?>