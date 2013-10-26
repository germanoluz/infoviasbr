<?php
//inclui o script de conexão com o banco
require ("ConexaoSingleton.class.php");

class Consulta{

//variaveis para quantidade

	private $qtdOcoAno;
	private $qtdHora;
	private $qtdEnvolvido;
	private $qtdAlcoolizada;
	private $qtdTrecho;
	private $qtdDiaSemana;
	private $qtdOcoSex;
	private $qtdCondAlcAno;
	private $qtdOcoMes;
	private $qtdDezBr;
	private $qtdMasc;
	private $qtdFem;

//variaveis para outros valores do banco

	private $ocoAno;
	private $hora;
	private $tipoEnvolvido;
	private $trecho;
	private $diaSemana;
	private $ocoSex;
	private $condAlcAno;
	private $ocoSexAno;
	private $ocoMes;
	private $ocoMesAno;
	private $dezBr;
	
//getters retornando os valores de quantidades
	
	
	public function getQtdOcoAno(){
		return $this->qtdOcoAno;
	}
	
	public function getQtdHora(){
		return $this->qtdHora;
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
	
	public function getQtdOcoSex(){
		return $this->qtdOcoSex;
	}
	
	public function getQtdCondAlcAno(){
		return $this->qtdCondAlcAno;
	}
	
	public function getQtdOcoMes(){
		return $this->qtdOcoMes;
	}
	
	public function getQtdDezBr(){
		return $this->qtdDezBr;
	}
	
	public function getQtdMasc(){
		return $this->qtdMasc;
	}
	
	public function getQtdFem(){
		return $this->qtdFem;
	}

//getters retornado os outros valores do banco

	public function getOcoAno(){
		return $this->ocoAno;
	}

	public function getHora(){
		return $this->hora;
	}

	public function getTipoEnvolvido(){
		return $this->tipoEnvolvido;
	}
	
	public function getTrecho(){
		$trechoFormatado = $this->trecho / 10;
		return $trechoFormatado;
	}

	public function getDiaSemana(){
		switch($this->diaSemana){
			case 0:
				echo "'Segunda', ";
			case 1:
				echo "'Terça', ";
			case 2:
				echo "'Quarta', ";
			case 3:
				echo "'Quinta', ";
			case 4:
				echo "'Sexta', ";
			case 5:
				echo "'Sábado', ";
			case 6:
				echo "'Domingo'";
		}
	}
	
	public function getOcoSex(){
		return $this->ocoSex;
	}
	
	public function getOcoSexAno(){
		return $this->ocoSexAno;
	}
	
	public function getCondAlcAno(){
		return $this->condAlcAno;
	}
	
	public function getOcoMes(){
		switch($this->ocoMes){
			case 1:
				echo "'Jan', ";
			case 2:
				echo "'Fev', ";
			case 3:
				echo "'Mar', ";
			case 4:
				echo "'Abr', ";
			case 5:
				echo "'Maio', ";
			case 6:
				echo "'Jun', ";
			case 7:
				echo "'Jul', ";
			case 8:
				echo "'Ago', ";
			case 9:
				echo "'Set', ";
			case 10:
				echo "'Out', ";
			case 11:
				echo "'Nov', ";
			case 12:
				echo "'Dez'";
				
		}
	}
	
	public function getOcoMesAno(){
		return $this->ocoMesAno;
	}
	public function getDezBr(){
		return $this->dezBr;
	}

//functions para a tela principal

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
        echo $qtdCapacete_string; 
	}
	
	//consulta causas de ocorrencias 
  
    function causasDeOco($br){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT (sum(QTD) / t.factor) * 100 AS pct, Causa FROM tmp_causa_aci JOIN (SELECT
			sum(QTD) AS factor FROM tmp_causa_aci WHERE BR = $br) AS t WHERE BR = $br GROUP BY Causa"); 
    
        if($result){ 
            $pctCausa = array(); 
            $causa = array(); 

            while ($row = mysql_fetch_assoc($result)){ 
                $pctCausa[] = $row["pct"]; 
                $causa[] = $row["Causa"];
            } 
              
        $causa_string = array_combine($causa, $pctCausa);
		
        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        }
		
		foreach ($causa_string as $key => $value) {
			echo "['$key', $value]";
		}
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

            while($row = mysql_fetch_assoc($result)){ 
                $qtdAlcoolizada[] = $row["total_pessoas"]; 
            } 
              
        $qtdAlcoolizada_string = join($qtdAlcoolizada);
		
        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
		echo $qtdAlcoolizada_string; 
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
        echo $qtdMortes_string; 
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
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdEnvolvido = $qtdEnvolvido_string; 
        $this->tipoEnvolvido = $tipoEnvolvido_string; 
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
        echo $tipoVeiculo_string .": ". $qtdVeiculo_string; 
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


//functions usadas na tela secundaria

	//consulta quantidade de ocorrencias por ano
  
    function ocoPorAno(){

		$mysql = ConexaoSingleton::getInstancia();
		
        	$result = $mysql->sql_query("SELECT o.ocoano as ANO, COUNT(o.ocoid) AS QTD FROM
			ocorrencia o WHERE o.ocoano in (2013,2012,2011,2010,2009,2008,2007) GROUP BY ANO"); 
    
        if($result){ 
            $qtdOcoAno = array(); 
            $ocoAno = array();
              
            while($row = mysql_fetch_assoc($result)){ 
                $qtdOcoAno[] = $row["QTD"]; 
                $ocoAno[] = $row["ANO"];
            } 
              
			$qtdOcoAno_string = join(", ", $qtdOcoAno); 
			$ocoAno_string =join(", ", $ocoAno); 
		}else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
		} 
		$this->qtdOcoAno = $qtdOcoAno_string; 
		$this->ocoAno = $ocoAno_string; 
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
		
		$hora_string = array_combine($hora, $qtdHora); 

        }else{ 
            print('MySQL query failed with error: ' . mysql_error()); 
        } 
		
		foreach($hora_string as $chave => $valor){
			echo "$chave: $valor";
		}
    }
	
	//QTD de ocorrencia por dia da semana trecho mais perigoso  

    function ocoDiaDaSemana($argAno){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocodiasemana AS diasemana, COUNT( o.ocodiasemana ) AS QTD
			FROM ocorrencia o
WHERE o.ocoano = $argAno
GROUP BY o.ocodiasemana");
    
        if($result){ 
            $qtdDiaSemana = array(); 
            $diaSemana = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdDiaSemana[] = $row["QTD"]; 
                $diaSemana[] = $row["diasemana"];
            } 
              
        $qtdDiaSemana_string = join(", ", $qtdDiaSemana); 
        $diaSemana_string = join(", ", $diaSemana);
		
        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        }
        $this->qtdDiaSemana = $qtdDiaSemana_string; 
        $this->diaSemana = $diaSemana_string; 
	}
	
	//QTD de acidentes por idade separado pelo sexo masculino  

    function ocoPorSexoMasc(){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocoano as ano, COUNT( p.pesid ) AS QTD
FROM ocorrencia o, pessoa p, ocorrenciapessoa op
WHERE p.pesteccodigo =2
AND p.pessexo IN ('M')
AND o.ocoano IN ( 2013, 2012, 2011, 2010, 2009, 2008, 2007 )
AND op.opepesid = p.pesid
AND o.ocoid = op.opeocoid
GROUP BY o.ocoano");
    
        if($result){ 
            $qtdMasc = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdMasc[] = $row["QTD"]; 
            } 
              
        $qtdMasc_string = "-" . join(", -", $qtdMasc); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdMasc = $qtdMasc_string; 
	}
	
	//QTD de acidentes por idade separado pelo sexo masculino  

    function ocoPorSexoFem(){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocoano as ano, COUNT( p.pesid ) AS QTD
FROM ocorrencia o, pessoa p, ocorrenciapessoa op
WHERE p.pesteccodigo =2
AND p.pessexo IN ('F')
AND o.ocoano IN ( 2013, 2012, 2011, 2010, 2009, 2008, 2007 )
AND op.opepesid = p.pesid
AND o.ocoid = op.opeocoid
GROUP BY o.ocoano");
    
        if($result){ 
            $qtdFem = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdFem[] = $row["QTD"]; 
            } 
              
        $qtdFem_string =join(", ", $qtdFem); 

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdFem = $qtdFem_string; 
	}
	
	//consulta das 10 brs mais perigosas 
  
    function dezBrMaisPerigosas(){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT convert(trecho, char) as BR, QTD FROM ocobr order by qtd desc limit 0,10"); 
    
        if($result){ 
            $qtdDezBr = array(); 
            $dezBr = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdDezBr[] = $row["QTD"]; 
                $dezBr[] = $row["BR"];
            } 
              
        	$qtdDezBr_string = join(", ", $qtdDezBr); 
        	$dezBr_string = join(", ", $dezBr);

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        }
        $this->qtdDezBr = $qtdDezBr_string; 
        $this->dezBr = $dezBr_string;
    }
	
	//ocorrencias por sexo do condutor
	
    function ocoPorSexoCondutor(){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocoano as ano, p.pessexo as Sexo, COUNT( p.pesid ) AS QTD FROM ocorrencia o, 
			pessoa p, ocorrenciapessoa op WHERE p.pesteccodigo = 2 AND o.ocoano IN ( 2013, 2012, 2011, 2010, 2009, 2008, 2007)
			AND op.opepesid = p.pesid AND o.ocoid = op.opeocoid GROUP BY o.ocoano, p.pessexo");
    
        if($result){ 
            $qtdOcoSex = array();
			$ocoSexAno = array(); 
            $ocoSex = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdOcoSex[] = $row["QTD"];
				$ocoSexAno[] = $row["ano"]; 
                $ocoSex[] = $row["Sexo"];
            } 
              
        $qtdOcoSex_string = join(", ", $qtdOcoSex);
		$ocoSexAno_string =join(", ", $ocoSexAno); 
        $ocoSex_string =join(", ", $ocoSex);

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        } 
        $this->qtdOcoSex = $qtdOcoSex_string;
        $this->ocoSexAno = $ocoSexAno_string; 
        $this->ocoSex = $ocoSex_string; 
	}
	
	//QTD de condutores alcoolizados por ano
	
    function condAlcoolAno(){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocoano AS ANO, COUNT( p.pesid ) AS total_pessoas FROM ocorrencia o, pessoa p,
			ocorrenciapessoa op WHERE p.pesteccodigo =2 AND p.pesalcool =  'S' AND o.ocoano IN ( 2013, 2012, 2011, 2010, 2009, 
			2008, 2007) AND o.ocoid = op.opeocoid AND p.pesid = op.opepesid GROUP BY o.ocoano");
    
        if($result){ 
            $qtdCondAlcAno = array(); 
            $condAlcAno = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdCondAlcAno[] = $row["total_pessoas"]; 
                $condAlcAno[] = $row["ANO"];
            } 
			$qtdCondAlcAno_string = join(", ", $qtdCondAlcAno); 
        	$condAlcAno_string = join(", ", $condAlcAno);

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        }
        $this->qtdCondAlcAno = $qtdCondAlcAno_string; 
        $this->condAlcAno = $condAlcAno_string;
	}
	
	//QTD de ocorrencias por mes
	
    function ocoPorMes($argAno){ 

		$mysql = ConexaoSingleton::getInstancia();

        	$result = $mysql->sql_query("SELECT o.ocoano as ANO, MONTH( o.ocodataocorrencia ) as Mes, COUNT( o.ocoid ) AS QTD
FROM ocorrencia o
WHERE o.ocoano = $argAno 
GROUP BY o.ocoano, MONTH( o.ocodataocorrencia )");
    
        if($result){ 
            $qtdOcoMes = array(); 
            $ocoMes = array(); 

            while($row = mysql_fetch_assoc($result)){ 
                $qtdOcoMes[] = $row["QTD"]; 
                $ocoMes[] = $row["Mes"];
            }
			
        	$qtdOcoMes_string = join(", ", $qtdOcoMes); 
        	$ocoMes_string = join(", ", $ocoMes);

        }else{ 
            echo ('Erro ao executar a query: ' . mysql_error()); 
        }
        $this->qtdOcoMes = $qtdOcoMes_string; 
        $this->ocoMes = $ocoMes_string;
	}
}
?>