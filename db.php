<?php

function getConexao(){

	try{

	$conexao=pg_connect ("host=localhost dbname=NUPIA port=5432 user=postgres password=postgres");
	}catch(Exception $e){
	    throw new Exception("Erro de conexão");

	}


	 return $conexao;
}
?>
