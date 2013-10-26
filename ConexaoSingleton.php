<?php
class ConexaoSingleton {

// Nas linhas abaixo você poderá colocar as informações do Banco de Dados.
	
	//host  do servidor
    private $host = "localhost";
	
	//usuario do servidor
    private $user = "infovias_sa";
	
	//senha do servidor
    private $senha = "@@infovias@@";
	
	//nome do banco de dados	
    private $dbase = "infovias_bd";
	
	//variaveis utilizada no script
    private $link;
    private $resultado;
    static private $instancia = false;

          //Construtor Private - Não é possível utilizar new em outras classes
		  private function __construct() {
        	$this->link = @mysql_connect($this->host,$this->user,$this->senha);
			
			if(!$this->link){

		     	 	// Caso ocorra um erro fecha a conexão e exibe uma mensagem com o erro

					die("Não foi possível conectar: " . mysql_error()."<br><br>");
		     	 
				}elseif(!mysql_select_db($this->dbase,$this->link)){ // Seleciona o banco após a conexão

					die("Ocorreu um Erro em selecionar o Banco: " . "<b>" . mysql_error() . "</b>");
				}
			}

//Metodo para recuperar instancia

	public static function getInstancia() {
		if (!ConexaoSingleton::$instancia) {
			ConexaoSingleton::$instancia = new ConexaoSingleton;
		}
		return ConexaoSingleton::$instancia;
	}

//cria a função para executar a query no Banco de Dados

	public function sql_query($query){

		//chama a conexão com o banco
		$this->getInstancia();

		$this->query = $query;

		// executa a query no MySQL

		if($this->resultado = mysql_query($this->query)){

			return $this->resultado;
		}else{
		// Caso ocorra um erro na execução da query exibe uma mensagem com o erro

			die("Ocorreu um erro ao executar a Query MySQL: <b>$query</b>" . "<br>" . mysql_error());
		}        
	}
}
?>
