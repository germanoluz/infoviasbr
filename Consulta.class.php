<?php
//inclui o script de conexão com o banco
require ("ConexaoSingleton.class.php");

class Consulta{

//variaveis para quantidade

	private $qtdOco;
	private $qtdCausa;
	private $qtdHora;
	private $qtdVeiculo;
	private $qtdEnvolvido;
	private $qtdAlcoolizada;
	private $qtdTrecho;
	private $qtdDiaSemana;
	private $qtdMasculino;
	private $qtdFeminino;
	private $qtdCapacete;
	private $qtdMortes;

//variaveis para outros valores do banco

	private $ano;
	private $causa;
	private $hora;
	private $tipoVeiculo;
	private $tipoEnvolvido;
	private $alcoolizada;
	private $trecho;
	private $diaSemana;
	private $masculino;
	private $feminino;
	
//getters retornando os valores de quantidades
	
	
	public function getQtdOco(){
		return $this->qtdOco;
	}
	
	public function getQtdCausa(){
		return $this->qtdCausa;
	}
	
	public function getQtdHora(){
		return $this->qtdHora;
	}

	public function getQtdVeiculo(){
		return $this->qtdVeiculo;
	}

	public function getQtdEnvolvido(){
		return $this->qtdEnvolvido;
	}

	public function getQtdAlcoolizada(){
		return $this->qtdAlcoolizada;
	}
	
	public function getQtdTrecho(){
		return $this->qtdTrecho;
	}

	public function getQtdDiaSemana(){
		return $this->qtdDiaSemana;
	}

	public function getQtdMasculino(){
		return $this->qtdMasculino;
	}

	public function getQtdFeminino(){
		return $this->qtdFeminino;
	}
	
	public function getQtdCapacete(){
		return $this->qtdCapacete;
	}
	
	public function getQtdMortes(){
		return $this->qtdMortes;
	}

//getters retornado os outros valores do banco

	public function getAno(){
		return $this->ano;
	}

	public function getCausa(){
		return $this->causa;
	}

	public function getHora(){
		return $this->hora;
	}

	public function getTipoVeiculo(){
		return $this->tipoVeiculo;
	}

	public function getTipoEnvolvido(){
		return $this->tipoEnvolvido;
	}
	
	public function getAlcoolizada(){
		return $this->alcoolizada;
	}
	
	public function getTrecho(){
		$trechoFormatado = $this->trecho / 10;
		return $trechoFormatado;
	}

	public function getDiaSemana(){
		switch($this->diaSemana){
			case 0:
				echo "Segunda";
				break;
			case 1:
				echo "Terça";
				break;
			case 2:
				echo "Quarta";
				break;
			case 3:
				echo "Quinta";
				break;
			case 4:
				echo "Sexta";
				break;
			case 5:
				echo "Sábado";
				break;
			case 6:
				echo "Domingo";
				break;
		}
	}

	public function getMasculino(){
		return $this->masculino;
	}

	public function getFeminino(){
		return $this->feminino;
	}

//functions utilizadas no sistema

//consulta quantidade de ocorrencias por ano
  
    function OcoPorAno(){

		$mysql = ConexaoSingleton::getInstancia();
		
        	// Executamos abaixo uma query (nela estamos selecionando as tabelas necessárias para nossa consulta e passando o ano que queremos). 
        	$result = $mysql->sql_query("SELECT o.ocoano as ANO, COUNT(o.ocoid) AS QTD FROM
			ocorrencia o WHERE o.ocoano in (2013,2012,2011,2010,2009,2008,2007) GROUP BY ANO"); 
    
        // Abaixo vamos executar um while com os resultados obtidos na query acima e mostrar os resultados em forma de tabela 
        if($result){ 
            $qtdOco = array(); 
            $ano = array();
              
            while($row = mysql_fetch_assoc($result)){ 
                $qtdOco[] = $row["QTD"]; 
                $ano[] = $row["ANO"];
            } 
              
        $qtdOco_string = join(", ", $qtdOco); 
        $ano_string =join(", ", $ano); 
        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
        $this->qtdOco = $qtdOco_string; 
        $this->ano = $ano_string; 
    }
	
//consulta causas de ocorrencias 
  
    function causasDeOco($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT Causa, QTD FROM tmp_causa_aci WHERE BR = $br ORDER BY QTD desc"); 
    
        if($result){ 
            $qtdCausa = array(); 
            $causa = array(); 

            if ($row = mysql_fetch_assoc($result)){ 
                $qtdCausa[] = $row["QTD"]; 
                $causa[] = $row["Causa"];
            } 
              
        $qtdCausa_string = join($qtdCausa); 
        $causa_string =join($causa);
        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
        $this->qtdCausa = $qtdCausa_string;
        $this->causa = $causa_string; 
    }

//consulta quantidade de ocorencias por hora
  
    function OcoPorHora($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocohora AS Hora, COUNT( o.ocohora ) AS QTD FROM localbr l, ocorrencia o
		WHERE l.lbrbr = $br AND o.ocolocal = l.lbrid GROUP BY o.ocohora ORDER BY QTD desc");
			    
        if($result){ 
            $qtdHora = array(); 
            $hora = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdHora[] = $row["QTD"]; 
                $hora[] = $row["Hora"];
            } 
              
        $qtdHora_string = join($qtdHora); 
        $hora_string = join($hora); 

        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
        $this->qtdHora = $qtdHora_string; 
        $this->hora = $hora_string; 
    }

//consulta tipo de veículos envolvidos em ocorrencias por ano, não está rodando 05/10
  
    function tipoVeicEnv($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT Tipo_Veiculo, QTD FROM tmp_tpvei_br WHERE BR = $br
			ORDER BY QTD desc"); 
    
        if($result){ 
            $qtdVeiculo = array(); 
            $tipoVeiculo = array(); 

            if ($row = mysql_fetch_assoc($result)){ 
                $qtdVeiculo[] = $row["QTD"]; 
                $tipoVeiculo[] = $row["Tipo_Veiculo"];
            }
              
        $qtdVeiculo_string = join($qtdVeiculo); 
        $tipoVeiculo_string =join($tipoVeiculo);

        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
        $this->qtdVeiculo = $qtdVeiculo_string; 
        $this->tipoVeiculo = $tipoVeiculo_string; 
    }

//consulta tipo de envolvidos em ocorrencias por ano
  
    function tipoDeEnvolvido($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT op.opetpenvdesc as tipo_envolvido, count(op.opeid) as
			QTD from ocorrenciapessoa op inner join ocorrencia o on o.ocoid = op.opeocoid inner join
			localbr l on l.lbrid = o.ocolocal where l.lbrbr = $br GROUP BY op.opetpenvdesc order by
			QTD");
    
        if($result){ 
            $qtdEnvolvido = array(); 
            $tipoEnvolvido = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdEnvolvido[] = $row["QTD"]; 
                $tipoEnvolvido[] = $row["tipo_envolvido"];
            } 
              
        $qtdEnvolvido_string = join($qtdEnvolvido); 
        $tipoEnvolvido_string = join($tipoEnvolvido); 

        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
        $this->qtdEnvolvido = $qtdEnvolvido_string; 
        $this->tipoEnvolvido = $tipoEnvolvido_string; 
    }
	
//qtd condutores alcoolizados e não alcoolizados por ano  

    function pesAlcoolizada($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT p.pesalcool AS Alcoolizada, COUNT( p.pesid ) AS
			total_pessoas FROM pessoa p, ocorrenciapessoa op, ocorrencia o, localbr l WHERE
			p.pesteccodigo = 2 and p.pesalcool = 'S' AND l.lbrbr = $br AND o.ocolocal = l.lbrid AND
			o.ocoid = op.opeocoid AND p.pesid = op.opepesid GROUP BY p.pesalcool");
    
        if($result){ 
            $qtdAlcoolizada = array(); 
            $alcoolizada = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdAlcoolizada[] = $row["total_pessoas"]; 
                $alcoolizada[] = $row["Alcoolizada"];
            } 
              
        $qtdAlcoolizada_string = join($qtdAlcoolizada); 
        $alcoolizada_string = join($alcoolizada); 

        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
        $this->qtdAlcoolizada = $qtdAlcoolizada_string; 
        $this->alcoolizada = $alcoolizada_string; 
    }
	
//trecho mais perigoso  

    function trechoMaisPerigoso($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT l.lbrkm AS Trecho, COUNT( o.ocoid ) AS QTD FROM
			localbr l, ocorrencia o WHERE l.lbrbr = $br AND l.lbrid = o.ocolocal GROUP BY l.lbrkm
			ORDER BY qtd DESC LIMIT 0 , 2");
    
        if($result){ 
            $qtdTrecho = array(); 
            $trecho = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdTrecho[] = $row["QTD"]; 
                $trecho[] = $row["Trecho"];
            } 
              
        $qtdTrecho_string = join($qtdTrecho); 
        $trecho_string =join($trecho); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdTrecho = $qtdTrecho_string; 
        $this->trecho = $trecho_string; 
	}
	
//QTD de ocorrencia por dia da semana trecho mais perigoso  

    function acidDiaDaSemana($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocodiasemana AS diasemana, COUNT(o.ocodiasemana) AS QTD FROM localbr l,
			ocorrencia o WHERE l.lbrbr = $br AND o.ocolocal = l.lbrid GROUP BY o.ocodiasemana ORDER BY QTD desc");
    
        if($result){ 
            $qtdDiaSemana = array(); 
            $diaSemana = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdDiaSemana[] = $row["QTD"]; 
                $diaSemana[] = $row["diasemana"];
            } 
              
        $qtdDiaSemana_string = join($qtdDiaSemana); 
        $diaSemana_string =join($diaSemana); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdDiaSemana = $qtdDiaSemana_string; 
        $this->diaSemana = $diaSemana_string; 
	}
	
//QTD de acidentes por idade separado pelo sexo masculino  

    function acidIdadeMasculino($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT p.pesidade, COUNT( p.pesid ) AS QTD FROM localbr l, ocorrencia o, pessoa p,
			ocorrenciapessoa op WHERE p.pessexo =  'M' AND p.pesteccodigo =2 AND l.lbrbr = $br AND o.ocolocal = l.lbrid
			AND o.ocoano IN ( 2013, 2012, 2011, 2010, 2009, 2008, 2007 ) AND op.opepesid = p.pesid AND o.ocoid = op.opeocoid
			GROUP BY p.pesidade");
    
        if($result){ 
            $qtdMasculino = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdMasculino[] = $row["QTD"]; 
            } 
              
        $qtdMasculino_string = join($qtdMasculino); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdMasculino = $qtdMasculino_string; 
	}
	
//QTD de acidentes por idade separado pelo sexo masculino  

    function acidIdadeFeminino($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT p.pesidade, COUNT( p.pesid ) AS QTD FROM localbr l, ocorrencia o, pessoa p,
			ocorrenciapessoa op WHERE p.pessexo =  'F' AND p.pesteccodigo =2 AND l.lbrbr = $br AND o.ocolocal = l.lbrid
			AND o.ocoano IN ( 2013, 2012, 2011, 2010, 2009, 2008, 2007 ) AND op.opepesid = p.pesid AND o.ocoid = op.opeocoid
			GROUP BY p.pesidade");
    
        if($result){ 
            $qtdFeminino = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdFeminino[] = $row["QTD"]; 
            } 
              
        $qtdFeminino_string = join($qtdFeminino); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdFeminino = $qtdFeminino_string; 
	}
		
//pessoas sem capacete envolvidas em acidentes

    function pesSemCapacete($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT COUNT( p.pesid ) AS QTD FROM localbr l, ocorrencia o, pessoa p,
			ocorrenciapessoa op, veiculo v WHERE v.veitvvcodigo IN ( 2, 3, 4, 5, 6 ) AND p.pescapacete =  'N' AND p.pesveiid =
			v.veiid AND l.lbrbr = $br AND op.opepesid = p.pesid AND o.ocoid = op.opeocoid AND l.lbrid = o.ocolocal");
    
        if($result){ 
            $qtdCapacete = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdCapacete[] = $row["QTD"]; 
            }
			
			$qtdCapacete_string = join($qtdCapacete); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdCapacete = $qtdCapacete_string; 
	}
	
//Qtd de mortes por br

    function mortesPorBr($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT p.pesestadofisico, COUNT( p.pesid ) AS QTD FROM localbr l, ocorrencia o, pessoa
			p, ocorrenciapessoa op WHERE p.pesestadofisico =4 AND l.lbrbr =  $br AND l.lbrid = o.ocolocal AND o.ocoid =
			op.opeocoid AND op.opepesid = p.pesid");
    
        if($result){ 
            $qtdMortes = array(); 

            if($row = mysql_fetch_assoc($result)){ 
                $qtdMortes[] = $row["QTD"]; 
            }
			
			$qtdMortes_string = join($qtdMortes); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdMortes = $qtdMortes_string; 
	}
}
?>