<?php


function getPagina(){
	$url = $_SERVER['REQUEST_URI'];
	$url = explode("?",$url);
	$url = $url[0];
	$metodo = $_SERVER['REQUEST_METHOD'];

	if($metodo == "GET"){
		switch($url){
			case "/":
					include("NUPIA/home.html");
					break;
				
			case "/home":
					include("NUPIA/home.html");
					break;
			
			case "/contato":
				include("NUPIA/contato.html");
				break;

			case "/lista":
				include("NUPIA/lista.html");
				break;
			
				
			case "/login":
				include("NUPIA/login.html");
				break;
				
				
			case "/mapa":
				include("NUPIA/mapa.html");
				break;	
			
				
			default:
				include("NUPIA/home.html");
				break;
						
				
		}

	}	

}

function getUltimaEdicao($idsubproj){
	$conexao = getConexao();
	$select ="select edicao.horario FROM subprojetos 
inner join edicao on subprojetos.idsubproj=edicao.subprojetos_idsubproj 
where subprojetos_idsubproj='".$idsubproj."'";
	$result = pg_query($conexao, $select);
	$edicao = pg_fetch_all($result);
	return $edicao;

} 

function getAllSubprojEixoproj($idproj, $ideixo){
	$conexao = getConexao();
	$select ="select * FROM subprojetos
INNER JOIN eixoproj on subprojetos.idsubproj = eixoproj.projetos_idproj
where eixoproj.projetos_idproj = '".$idproj."' and eixoproj.eixo_ideixo = '".$ideixo."';
";
	$result = pg_query($conexao, $select);
	$subprojetos = pg_fetch_all($result);
	return $subprojetos;
}


function getAllEdicoesSubproj($idsubproj){
	$conexao = getConexao();
	$select ="select contas.nome, edicao.adicionareditar, edicao.horario from edicao
inner join subprojetos on edicao.subprojetos_idsubproj = subprojetos.idsubproj
inner join contas on edicao.contas_idcontas = contas.idcontas
where subprojetos.idsubproj = '".$idsubproj."'; 
";
	$result = pg_query($conexao, $select);
	$edicao = pg_fetch_all($result);
	return $edicao;
}


function getArquivo($diretorio, $idproposta){
	$conexao = getConexao();
	$select ="select lo_export(proposta.arquivo,'".$diretorio."')
FROM proposta
where idproposta='".$idproposta."';; 
";
	$result = pg_query($conexao, $select);
	$arquivo = pg_fetch_all($result);
	return $arquivo;
}

function getAllSubproj(){
	$conexao = getConexao();
	$select ="select * from projetos; 
";
	$result = pg_query($conexao, $select);
	$subprojetos = pg_fetch_all($result);
	return $subprojetos;
}
function getAllSubprojAndamento(){
	$conexao = getConexao();
	$select ="select * from subprojetos
where datafinal is NULL  
";
	$result = pg_query($conexao, $select);
	$subprojetos = pg_fetch_all($result);
	return $subprojetos;
}

function getAllSubprojEncerrados(){
	$conexao = getConexao();
	$select ="select * from subprojetos
where datafinal is NOT NULL 
 
";
	$result = pg_query($conexao, $select);
	$subprojetos = pg_fetch_all($result);
	return $subprojetos;
}


function getLogin($email, $senha){
	$conexao = getConexao();
	$select ="select email, senha from contas
where email = '".$email."' and senha='".$senha."' 
 
";
	$result = pg_query($conexao, $select);
	$login = pg_fetch_all($result);
	return $login;
}

function getIdConta($email){
	$conexao = getConexao();
	$select ="select idcontas from contas
where email = '".$email."'
";
	$result = pg_query($conexao, $select);
	$conta = pg_fetch_all($result);
	return $conta;
}

function getConta($idcontas){
	$conexao = getConexao();
	$select ="select * from contas
where idcontas = '".$idcontas."'
";
	$result = pg_query($conexao, $select);
	$conta = pg_fetch_all($result);
	return $conta;
}

function addArquivo($arquivo){
	$conexao = getConexao();
	$insert ="insert into proposta (arquivo)
values (lo_import('".$arquivo."'))
";
	$result = pg_query($conexao, $insert);
}

function addContas($nome, $senha, $email, $tipoconta){
	$conexao = getConexao();
	$insert ="insert into contas(nome, senha, email, tipoconta)
values ('".$nome."', '".$senha."', '".$email."', '".$tipoconta."')
";
	$result = pg_query($conexao, $insert);
}

function addIntegrantes($idsubproj, $idcontas){
	$conexao = getConexao();
	$insert ="insert into integrantes(projetos_idproj, contas_idcontas)
values ('".$idsubproj."', '".$idcontas."')
";
	$result = pg_query($conexao, $insert);
}

function addSubprojetos($idproj, $curso, $diciplinas, $conteudo, $datainicial, $datafinal, $prevfinal){
	$conexao = getConexao();
	$insert ="insert into subprojetos (projetos_idproj, curso, diciplinas, conteudo, datainicial, datafinal, prevfinal)
values ('".$idproj."', '".$curso."', '".$diciplinas."', '".$conteudo."', '".$datainicial."', '".$datafinal."', '".$prevfinal."')";
	$result = pg_query($conexao, $insert);
}
function addprojetos($nomeproj, $codproj){
	$conexao = getConexao();
	$insert ="insert into projetos (nomeproj, codproj)
  values ('".$nomeproj."', '".$codproj."')
";
	$result = pg_query($conexao, $insert);
}

function setProposta($idproj, $arquivo){
	$conexao = getConexao();
	$update ="update proposta
set arquivo = lo_import('".$arquivo."')
where idproposta = '".$idproj."'
";
	$result = pg_query($conexao, $update);
}


function setProjetoCurso($idsubproj, $curso){
	$conexao = getConexao();
	$update ="update subprojetos
set curso = '".$curso."'
where idsubproj = '".$idsubproj."'
";
	$result = pg_query($conexao, $update);
}

function setProjetoDiciplinas($idsubproj, $diciplinas){
	$conexao = getConexao();
	$update ="update subprojetos
set diciplinas = '".$diciplinas."'
where idsubproj = '".$idsubproj."'
";
	$result = pg_query($conexao, $update);
}

function setProjetoConteudo($idsubproj, $conteudo){
	$conexao = getConexao();
	$update ="update subprojetos
set conteudo = '".$conteudo."'
where idsubproj = '".$idsubproj."'
";
	$result = pg_query($conexao, $update);
}

function setProjetoDatafinal($idsubproj, $datafinal){
	$conexao = getConexao();
	$update ="update subprojetos
set datafinal = '".$datafinal."'
where idsubproj = '".$idsubproj."'
";
	$result = pg_query($conexao, $update);
}

function setProjetoPrevfinal($idsubproj, $prevfinal){
	$conexao = getConexao();
	$update ="update subprojetos
set prevfinal = '".$prevfinal."'
where idsubproj = '".$idsubproj."'
";
	$result = pg_query($conexao, $update);
}

function getImgAcao($idacao, $link){
	$conexao = getConexao();
	$select = "select lo_export(acao.fotosacao, '".$link."') from acao
where idacao = '".$idacao."'";
	$result =  pg_query($conexao, $select);
}
function setImgAcao($idacao, $link){
	$conexao = getConexao();
	$update = "update acao
set fotosacao = lo_import('".$link."')
where idacao = '".$idacao."'";
$result =  pg_query($conexao, $update);
}

function getImgAtor($idacao, $link){
	$conexao = getConexao();
	$select = "select lo_export(acao.fotosacao, '".$link."') from acao
where idacao = '".$idacao."'";
	$result =  pg_query($conexao, $select);
}
function setImgAtor($idacao, $link){
	$conexao = getConexao();
	$update = "update acao
set fotosacao = lo_import('".$link."')
where idacao = '".$idacao."'";
$result =  pg_query($conexao, $update);
}

function addAcao($subproj_idsubproj) {
	$conexao = getConexao();
	$insert = "insert into acao (".$subproj_idsubproj.") values (subproj_idsubproj)
	"
}

?>